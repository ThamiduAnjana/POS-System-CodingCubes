<?php

namespace App\Models;

use App\Services\HelperService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BankAccount extends Model
{
    use HasFactory;

    protected $table = 'bank_accounts';

    protected $fillable = [
        'bank_id',
        'account_name',
        'account_number',
        'is_active',
        'location_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getBankAccounts()
    {
        return BankAccount::select('bank_accounts.id', 'bank_accounts.bank_id', 'banks.name as bank_name', 'bank_accounts.account_no',
            'banks.location_id', 'locations.name as location_name', 'bank_accounts.branch_name', 'bank_accounts.is_active',
            'bank_accounts.created_at', 'bank_accounts.created_by', 'bank_accounts.updated_at', 'bank_accounts.updated_by',
            DB::raw("CONCAT(bank_accounts.title, ' ', bank_accounts.initials, bank_accounts.first_name, bank_accounts.middle_name,
            bank_accounts.last_name) as holder_name"),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.updated_by) as updated_by_name'))
            ->leftJoin('banks', 'banks.id', '=', 'bank_accounts.bank_id')
            ->leftJoin('locations', 'locations.id', '=', 'banks.location_id')
            ->where('bank_accounts.is_active', 1)
            ->get();
    }

    public static function getBankAccountsByPage($request)
    {
        $page_no = $request['page_no'];
        $page_size = $request['page_size'];
        $start_no = ($page_no - 1) * $page_size;

        $query = BankAccount::select('bank_accounts.id', 'bank_accounts.bank_id', 'banks.name as bank_name', 'bank_accounts.account_no',
            'banks.location_id', 'locations.name as location_name', 'bank_accounts.branch_name', 'bank_accounts.is_active',
            'bank_accounts.created_at', 'bank_accounts.created_by', 'bank_accounts.updated_at', 'bank_accounts.updated_by',
            DB::raw("CONCAT(bank_accounts.title, ' ', bank_accounts.initials, bank_accounts.first_name, bank_accounts.middle_name,
            bank_accounts.last_name) as holder_name"),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.updated_by) as updated_by_name'))
            ->leftJoin('banks', 'banks.id', '=', 'bank_accounts.bank_id')
            ->leftJoin('locations', 'locations.id', '=', 'banks.location_id');

        if($request['is_active'] === 0){
            $query->where('bank_accounts.is_active',0);
        }else if($request['is_active'] === 1){
            $query->where('bank_accounts.is_active',1);
        }

        if ($request['keyword'] != '') {
            $query->where(function ($query) use ($request) {
                $query->Where('banks.name', 'LIKE', '%'. $request['keyword'] .'%')
                    ->orWhere('bank_accounts.branch_name', 'LIKE', '%'. $request['keyword'] .'%')
                    ->orWhere('bank_accounts.account_no', '=', $request['keyword']);
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
            $query->whereBetween('bank_accounts.created_at',[$date_filter['from'],$date_filter['to']]);
        }

        return [
            'total' => $query->count(),
            'data' =>  $query->orderBy('bank_accounts.created_at', 'desc')
                ->when($page_size > 0, function ($query) use ($page_size, $start_no) {
                    return $query->offset($start_no)->limit($page_size);
                })->get(),
        ];
    }

    public static function getBankAccount(array $filters)
    {
        return BankAccount::select('bank_accounts.id', 'bank_accounts.bank_id', 'banks.name as bank_name', 'bank_accounts.account_no',
            'banks.location_id', 'locations.name as location_name', 'bank_accounts.branch_name', 'bank_accounts.is_active',
            'bank_accounts.created_at', 'bank_accounts.created_by', 'bank_accounts.updated_at', 'bank_accounts.updated_by',
            DB::raw("CONCAT(bank_accounts.title, ' ', bank_accounts.initials, bank_accounts.first_name, bank_accounts.middle_name,
            bank_accounts.last_name) as holder_name"),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = access_policies.updated_by) as updated_by_name'))
            ->leftJoin('banks', 'banks.id', '=', 'bank_accounts.bank_id')
            ->leftJoin('locations', 'locations.id', '=', 'banks.location_id')
            ->where($filters)
            ->first();
    }
}
