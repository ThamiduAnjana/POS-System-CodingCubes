<?php

namespace App\Models;

use App\Services\HelperService;
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

    public static function getCategoriesByPage($request)
    {
        $page_no = $request['page_no'];
        $page_size = $request['page_size'];
        $start_no = ($page_no - 1) * $page_size;

        $query = Category::select('categories.id', 'categories.category_ref', 'categories.name', 'categories.parent_id', 'categories.short_code',
            'categories.full_code', 'categories.description', 'categories.is_active', 'categories.location_id',
            'locations.name as location_name', 'categories.created_at', 'categories.created_by', 'categories.updated_at', 'categories.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = categories.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = categories.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'categories.location_id');

        if($request['is_active'] === 0){
            $query->where('categories.is_active',0);
        }else if($request['is_active'] === 1){
            $query->where('categories.is_active',1);
        }

        if ($request['keyword'] != '') {
            $query->where(function ($query) use ($request) {
                $query->Where('categories.name', 'LIKE', '%'. $request['keyword'] .'%')
                    ->orWhere('categories.short_code', 'LIKE', '%'. $request['keyword'] .'%');
            });
        }

        if($request['date'] != [] && $request['created_at'] != 'all'){
            $date =  $request['date'];
            $date_filter['from'] = date('Y-m-d 00:00:00', strtotime(HelperService::dateToString($date['from'])));
            if($date['to'] !== null || isset($date['to'])){
                $date_filter['to'] = date('Y-m-d 23:59:59', strtotime(HelperService::dateToString($date['to'])));
            } else {
                $date_filter['to'] = date('Y-m-d 23:59:59', strtotime(HelperService::dateToString($date['from'])));
            }
        }

        if(isset($date_filter['from']) && isset($date_filter['to'])){
            $query->whereBetween('categories.created_at',[$date_filter['from'],$date_filter['to']]);
        }

        return [
            'total' => $query->count(),
            'data' =>  $query->orderBy('categories.created_at', 'desc')
                ->when($page_size > 0, function ($query) use ($page_size, $start_no) {
                    return $query->offset($start_no)->limit($page_size);
                })->get(),
        ];
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
