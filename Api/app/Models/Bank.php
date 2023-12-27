<?php

namespace App\Models;

use App\Services\HelperService;
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

    public static function getBanksByPage($request)
    {
        $page_no = $request['page_no'];
        $page_size = $request['page_size'];
        $start_no = ($page_no - 1) * $page_size;

        $query = Bank::select('banks.id', 'banks.bank_ref', 'banks.name', 'banks.description', 'banks.is_active', 'banks.location_id',
            'locations.name as location_name', 'banks.created_at', 'banks.created_by', 'banks.updated_at', 'banks.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'banks.location_id');

        if($request['is_active'] === 0){
            $query->where('banks.is_active',0);
        }else if($request['is_active'] === 1){
            $query->where('banks.is_active',1);
        }

        if ($request['keyword'] != '') {
            $query->where(function ($query) use ($request) {
                $query->Where('banks.name', 'LIKE', '%'. $request['keyword'] .'%');
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
            $query->whereBetween('banks.created_at',[$date_filter['from'],$date_filter['to']]);
        }

        return [
            'total' => $query->count(),
            'data' =>  $query->orderBy('banks.created_at', 'desc')
                ->when($page_size > 0, function ($query) use ($page_size, $start_no) {
                    return $query->offset($start_no)->limit($page_size);
                })->get(),
        ];
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
