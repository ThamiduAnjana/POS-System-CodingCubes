<?php

namespace App\Models;

use App\Services\HelperService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'customer_ref',
        'title',
        'initials',
        'first_name',
        'middle_name',
        'last_name',
        'sex',
        'nic',
        'passport',
        'driving_license',
        'dob',
        'customer_group_id',
        'payment_term',
        'payment_term_type',
        'credit_limit',
        'deposit',
        'loyalty_card_no',
        'points',
        'balance',
        'custom_field_1',
        'custom_field_2',
        'custom_field_3',
        'custom_field_4',
        'is_active',
        'location_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getCustomers()
    {
        return Customer::select('customers.id', 'customers.customer_ref', 'customers.title', 'customers.initials', 'customers.first_name',
            'customers.middle_name', 'customers.last_name', 'customers.sex', 'customers.nic', 'customers.passport', 'customers.driving_license',
            'customers.dob', 'customers.customer_group_id', 'customers.payment_term', 'customers.payment_term_type', 'customers.credit_limit',
            'customers.deposit', 'customers.loyalty_card_no', 'customers.points', 'customers.balance', 'customers.custom_field_1',
            'customers.custom_field_2', 'customers.custom_field_3', 'customers.custom_field_4', 'media.url', 'customers.customer_group_id',
            'customer_groups.name as customer_groups_name', 'customers.is_active', 'customers.location_id', 'locations.name as location_name',
            'customers.created_at', 'customers.created_by', 'customers.updated_at', 'customers.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = contacts.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = contacts.updated_by) as updated_by_name'))
            ->leftJoin('customer_groups', 'customer_groups.id', '=', 'customers.customer_group_id')
            ->leftJoin('locations', 'locations.id', '=', 'customers.location_id')
            ->leftJoin('media', 'media.id', '=', 'customers.media_id')
            ->where('customers.is_active', 1)
            ->get();
    }

    public static function getCustomersByPage($request)
    {
        $page_no = $request['page_no'];
        $page_size = $request['page_size'];
        $start_no = ($page_no - 1) * $page_size;

        $query = Customer::select('customers.id', 'customers.customer_ref', 'customers.title', 'customers.initials', 'customers.first_name',
            'customers.middle_name', 'customers.last_name', 'customers.sex', 'customers.nic', 'customers.passport', 'customers.driving_license',
            'customers.dob', 'customers.customer_group_id', 'customers.payment_term', 'customers.payment_term_type', 'customers.credit_limit',
            'customers.deposit', 'customers.loyalty_card_no', 'customers.points', 'customers.balance', 'customers.custom_field_1',
            'customers.custom_field_2', 'customers.custom_field_3', 'customers.custom_field_4', 'media.url', 'customers.customer_group_id',
            'customer_groups.name as customer_groups_name', 'customers.is_active', 'customers.location_id', 'locations.name as location_name',
            'customers.created_at', 'customers.created_by', 'customers.updated_at', 'customers.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = contacts.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = contacts.updated_by) as updated_by_name'))
            ->leftJoin('customer_groups', 'customer_groups.id', '=', 'customers.customer_group_id')
            ->leftJoin('locations', 'locations.id', '=', 'customers.location_id')
            ->leftJoin('media', 'media.id', '=', 'customers.media_id');

        if($request['is_active'] === 0){
            $query->where('customers.is_active',0);
        }else if($request['is_active'] === 1){
            $query->where('customers.is_active',1);
        }

        if ($request['keyword'] != '') {
            $query->where(function ($query) use ($request) {
                $query->Where('customers.first_name', 'LIKE', '%'. $request['keyword'] .'%')
                    ->orWhere('customers.middle_name', 'LIKE', '%'. $request['keyword'] .'%')
                    ->orWhere('customers.last_name', 'LIKE', '%'. $request['keyword'] .'%')
                    ->orWhere('locations.location_name', 'LIKE', '%'. $request['keyword'] .'%')
                    ->orWhere('locations.code', '=', $request['keyword'])
                    ->orWhere('customers.custom_field_1', 'LIKE', '%'. $request['keyword'] .'%')
                    ->orWhere('customers.custom_field_2', 'LIKE', '%'. $request['keyword'] .'%')
                    ->orWhere('customers.custom_field_3', 'LIKE', '%'. $request['keyword'] .'%')
                    ->orWhere('customers.custom_field_4', 'LIKE', '%'. $request['keyword'] .'%');
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
            $query->whereBetween('customers.created_at',[$date_filter['from'],$date_filter['to']]);
        }

        return [
            'total' => $query->count(),
            'data' =>  $query->orderBy('customers.created_at', 'desc')
                ->when($page_size > 0, function ($query) use ($page_size, $start_no) {
                    return $query->offset($start_no)->limit($page_size);
                })->get(),
        ];
    }

    public static function getCustomer(array $filters)
    {
        return Customer::select('customers.id', 'customers.customer_ref', 'customers.title', 'customers.initials', 'customers.first_name',
            'customers.middle_name', 'customers.last_name', 'customers.sex', 'customers.nic', 'customers.passport', 'customers.driving_license',
            'customers.dob', 'customers.customer_group_id', 'customers.payment_term', 'customers.payment_term_type', 'customers.credit_limit',
            'customers.deposit', 'customers.loyalty_card_no', 'customers.points', 'customers.balance', 'customers.custom_field_1',
            'customers.custom_field_2', 'customers.custom_field_3', 'customers.custom_field_4', 'media.url', 'customers.customer_group_id',
            'customer_groups.name as customer_groups_name', 'customers.is_active', 'customers.location_id', 'locations.name as location_name',
            'customers.created_at', 'customers.created_by', 'customers.updated_at', 'customers.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = contacts.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = contacts.updated_by) as updated_by_name'))
            ->leftJoin('customer_groups', 'customer_groups.id', '=', 'customers.customer_group_id')
            ->leftJoin('locations', 'locations.id', '=', 'customers.location_id')
            ->leftJoin('media', 'media.id', '=', 'customers.media_id')
            ->where($filters)
            ->first();
    }
}
