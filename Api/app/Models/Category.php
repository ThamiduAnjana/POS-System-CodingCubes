<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'category_ref',
        'name',
        'parent_id',
        'short_code',
        'full_code',
        'description',
        'is_active',
        'location_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getCategories()
    {
        return Category::select('categories.id', 'categories.category_ref', 'categories.name', 'categories.parent_id', 'categories.short_code',
            'categories.full_code', 'categories.description', 'categories.is_active', 'categories.location_id',
            'locations.name as location_name', 'categories.created_at', 'categories.created_by', 'categories.updated_at', 'categories.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = categories.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = categories.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'categories.location_id')
            ->where('categories.is_active', 1)
            ->get();
    }

    public static function getCategory(array $filters)
    {
        return Category::select('categories.id', 'categories.category_ref', 'categories.name', 'categories.parent_id', 'categories.short_code',
            'categories.full_code', 'categories.description', 'categories.is_active', 'categories.location_id',
            'locations.name as location_name', 'categories.created_at', 'categories.created_by', 'categories.updated_at', 'categories.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = categories.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = categories.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'categories.location_id')
            ->where($filters)
            ->first();
    }
}
