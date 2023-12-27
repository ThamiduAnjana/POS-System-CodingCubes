<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccessPolicy extends Model
{
    use HasFactory;

    protected $table = 'access_policies';

    protected $fillable = [
        'access_policy_ref',
        'name',
        'description',
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

    public static function getAccessPolicies()
    {
        return AccessPolicy::select('access_policies.id', 'access_policies.access_policy_ref', 'access_policies.name', 'access_policies.description',
            'access_policies.is_active', 'access_policies.location_id', 'locations.name as location_name', 'access_policies.created_at',
            'access_policies.created_by', 'access_policies.updated_at', 'access_policies.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'access_policies.location_id')
            ->where('access_policies.is_active', 1)
            ->get();
    }

    public static function getAccessPolicy(array $filters)
    {
        return AccessPolicy::select('access_policies.id', 'access_policies.access_policy_ref', 'access_policies.name', 'access_policies.description',
            'access_policies.is_active', 'access_policies.location_id', 'locations.name as location_name', 'access_policies.created_at',
            'access_policies.created_by', 'access_policies.updated_at', 'access_policies.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'access_policies.location_id')
            ->where($filters)
            ->first();
    }

}
