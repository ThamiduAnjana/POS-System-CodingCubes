<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'address_ref',
        'owner_type',
        'owner_id',
        'house',
        'street',
        'village',
        'city',
        'postal_code',
        'district',
        'province',
        'country',
        'is_primary',
        'is_active',
        'location_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getAddresses()
    {
        return Address::select('addresses.id', 'addresses.address_ref', 'addresses.owner_type', 'addresses.owner_id', 'addresses.house', 'addresses.street',
            'addresses.village', 'addresses.city', 'addresses.postal_code', 'addresses.district', 'addresses.province', 'addresses.country',
            'addresses.is_primary', 'addresses.is_active', 'addresses.location_id', 'locations.name as location_name', 'addresses.created_at',
            'addresses.created_by', 'addresses.updated_at', 'addresses.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'addresses.location_id')
            ->where('addresses.is_active', 1)
            ->get();
    }

    public static function getAddress(array $filters)
    {
        return Address::select('addresses.id', 'addresses.address_ref', 'addresses.owner_type', 'addresses.owner_id', 'addresses.house', 'addresses.street',
            'addresses.village', 'addresses.city', 'addresses.postal_code', 'addresses.district', 'addresses.province', 'addresses.country',
            'addresses.is_primary', 'addresses.is_active', 'addresses.location_id', 'locations.name as location_name', 'addresses.created_at',
            'addresses.created_by', 'addresses.updated_at', 'addresses.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'addresses.location_id')
            ->where($filters)
            ->first();
    }

}
