<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{
    public $date;
    public $contactModel;

    public function __construct()
    {
        $this->date = date('Y-m-d H:i:s');
        $this->contactModel = new Contact();
    }

    public function saveContact(array $data)
    {
        $contact = $data['contact'];
        $contact_id = null;

        if($data['ref']){
            $patch_data = array(
                'contact' => $contact['contact'],
                'is_primary' => $contact['is_primary'],
                'status' => $contact['status'],
                'updated_at' => $this->date,
                'updated_by' => Auth::user()->id,
            );

            $this->contactModel->updateContact($patch_data);
            $contact_id = $this->contactModel->getContactByRef($data['ref']);

        }else{
            $patch_data = array(
                'who_is' => $data['who_is'],
                'who_id' => $data['who_id'],
                'contact' => $contact['contact'],
                'is_primary' => $contact['is_primary'],
                'status' => 1,
                'created_at' => $this->date,
                'created_by' => Auth::user()->id,
            );

            $contact_id = $this->contactModel->saveContact($patch_data);
        }
        return $contact_id;
    }
}
