<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'contact_ref',
        'owner_type',
        'owner_id',
        'contact_no',
        'is_primary',
        'is_active',
        'location_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_active' => 'boolean',
    ];

    public static function getContacts()
    {
        return Contact::select('contacts.id', 'contacts.contact_ref', 'contacts.owner_type', 'contacts.owner_id', 'contacts.contact_no',
            'contacts.is_primary', 'contacts.is_active', 'contacts.location_id', 'locations.name as location_name', 'contacts.created_at',
            'contacts.created_by', 'contacts.updated_at', 'contacts.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = contacts.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = contacts.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'contacts.location_id')
            ->where('contacts.is_active', 1)
            ->get();
    }

    public static function getContact(array $filters)
    {
        return Contact::select('contacts.id', 'contacts.contact_ref', 'contacts.owner_type', 'contacts.owner_id', 'contacts.contact_no',
            'contacts.is_primary', 'contacts.is_active', 'contacts.location_id', 'locations.name as location_name', 'contacts.created_at',
            'contacts.created_by', 'contacts.updated_at', 'contacts.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = contacts.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = contacts.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'contacts.location_id')
            ->where($filters)
            ->first();
    }

}
