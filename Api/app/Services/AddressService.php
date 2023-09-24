<?php

namespace App\Services;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressService
{
    public $date;
    public $addressModel;

    public function __construct()
    {
        $this->date = date('Y-m-d H:i:s');
        $this->addressModel = new Address();
    }

    public function saveAddress(array $data)
    {
        $address = $data['address'];
        $address_id = null;

        if($address['ref']){
            $patch_data = array(
                'house' => $address['house'],
                'street' => $address['street'],
                'village' => $address['village'],
                'city' => $address['city'],
                'postal_code' => $address['postal_code'],
                'district' => $address['district'],
                'province' => $address['province'],
                'country' => $address['country'],
                'is_primary' => $address['is_primary'],
                'status' => $address['status'],
                'updated_at' => $this->date,
                'updated_by' => Auth::user()->id,
            );

            $this->addressModel->updateAddress($data['ref'],$patch_data);
            $address_id = $this->addressModel->getAddressByRef($data['ref']);

        }else{
            $patch_data = array(
                'owner_type' => $data['owner_type'],
                'owner_id' => $data['owner_id'],
                'house' => $address['house'],
                'street' => $address['street'],
                'village' => $address['village'],
                'city' => $address['city'],
                'postal_code' => $address['postal_code'],
                'district' => $address['district'],
                'province' => $address['province'],
                'country' => $address['country'],
                'is_primary' => $address['is_primary'],
                'status' => 1,
                'created_at' => $this->date,
                'created_by' => Auth::user()->id,
            );

            $address_id = $this->addressModel->saveAddress($patch_data);
        }
        return $address_id;
    }
}
