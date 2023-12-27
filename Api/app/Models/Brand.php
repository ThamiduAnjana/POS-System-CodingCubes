<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = [
        'brand_ref',
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

    public static function getBrands()
    {
        return Brand::select('brands.id', 'brands.brand_ref', 'brands.name', 'brands.description', 'brands.is_active', 'brands.location_id',
            'locations.name as location_name', 'brands.created_at', 'brands.created_by', 'brands.updated_at', 'brands.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = brands.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = brands.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'brands.location_id')
            ->where('brands.is_active', 1)
            ->get();
    }

    public static function getBrand(array $filters)
    {
        return Brand::select('brands.id', 'brands.brand_ref', 'brands.name', 'brands.description', 'brands.is_active', 'brands.location_id',
            'locations.name as location_name', 'brands.created_at', 'brands.created_by', 'brands.updated_at', 'brands.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = brands.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = brands.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'brands.location_id')
            ->where($filters)
            ->first();
    }
}
