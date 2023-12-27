<?php

namespace App\Models;

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
