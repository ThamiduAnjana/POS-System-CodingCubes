<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_ref',
        'name',
        'description',
        'is_active',
        'location_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getBanks()
    {
        return Bank::select('banks.id', 'banks.bank_ref', 'banks.name', 'banks.description', 'banks.is_active', 'banks.location_id',
                'locations.name as location_name', 'banks.created_at', 'banks.created_by', 'banks.updated_at', 'banks.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'banks.location_id')
            ->where('banks.is_active', 1)
            ->get();
    }

    public static function getBank(array $filters)
    {
        return Bank::table('banks')
            ->select('banks.id', 'banks.bank_ref', 'banks.name', 'banks.description', 'banks.is_active', 'banks.location_id',
                'locations.name as location_name', 'banks.created_at', 'banks.created_by', 'banks.updated_at', 'banks.updated_by',
                DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.created_by) as created_by_name'),
                DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'banks.location_id')
            ->where($filters)
            ->first();
    }
}
