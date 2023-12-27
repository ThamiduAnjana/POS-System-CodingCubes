<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BasicSalary extends Model
{
    use HasFactory;

    protected $table = 'basic_salaries';

    protected $fillable = [
        'basic_salary_ref',
        'employee_id',
        'salary_type',
        'amount',
        'start_at',
        'end_at',
        'is_active',
        'location_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getBasicSalaries()
    {
        return BasicSalary::select('basic_salaries.id', 'basic_salaries.basic_salary_ref', 'basic_salaries.employee_id', 'basic_salaries.salary_type',
            'basic_salaries.amount', 'basic_salaries.start_at', 'basic_salaries.end_at', 'basic_salaries.is_active', 'basic_salaries.location_id',
            'locations.name as location_name', 'basic_salaries.created_at', 'basic_salaries.created_by', 'basic_salaries.updated_at', 'basic_salaries.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = basic_salaries.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = basic_salaries.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'access_policies.location_id')
            ->where('basic_salaries.is_active', 1)
            ->get();
    }

    public static function getBasicSalary(array $filters)
    {
        return BasicSalary::select('basic_salaries.id', 'basic_salaries.basic_salary_ref', 'basic_salaries.employee_id', 'basic_salaries.salary_type',
            'basic_salaries.amount', 'basic_salaries.start_at', 'basic_salaries.end_at', 'basic_salaries.is_active', 'basic_salaries.location_id',
            'locations.name as location_name', 'basic_salaries.created_at', 'basic_salaries.created_by', 'basic_salaries.updated_at', 'basic_salaries.updated_by',
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = basic_salaries.created_by) as created_by_name'),
            DB::raw('(SELECT users.first_name FROM users WHERE users.id = basic_salaries.updated_by) as updated_by_name'))
            ->leftJoin('locations', 'locations.id', '=', 'access_policies.location_id')
            ->where($filters)
            ->first();
    }
}
