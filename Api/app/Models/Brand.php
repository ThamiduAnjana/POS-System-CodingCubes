<?php

namespace App\Models;

use App\Services\HelperService;
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

    public static function getBrandsByPage($request)
    {
        $page_no = $request['page_no'];
        $page_size = $request['page_size'];
        $start_no = ($page_no - 1) * $page_size;

        $query = Brand::select('brands.id', 'brands.brand_ref', 'brands.name', 'brands.description', 'brands.is_active', 'brands.location_id',
            'locations.name as location_name', 'brands.created_at', 'brands.created_by', 'brands.updated_at', 'brands.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = brands.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = brands.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'brands.location_id');

        if($request['is_active'] === 0){
            $query->where('brands.is_active',0);
        }else if($request['is_active'] === 1){
            $query->where('brands.is_active',1);
        }

        if ($request['keyword'] != '') {
            $query->where(function ($query) use ($request) {
                $query->Where('brands.name', 'LIKE', '%'. $request['keyword'] .'%');
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
            $query->whereBetween('brands.created_at',[$date_filter['from'],$date_filter['to']]);
        }

        return [
            'total' => $query->count(),
            'data' =>  $query->orderBy('brands.created_at', 'desc')
                ->when($page_size > 0, function ($query) use ($page_size, $start_no) {
                    return $query->offset($start_no)->limit($page_size);
                })->get(),
        ];
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
