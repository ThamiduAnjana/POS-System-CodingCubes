<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Employee extends Authenticatable implements JWTSubject
{
    use HasFactory;

    public function getEmployee()
    {
        return DB::table('employees')
            ->get();
    }

    public function getEmployeeByWhere(array $filters)
    {
        return DB::table('employees')
            ->where($filters)
            ->first();
    }

    public function saveEmployee(array $data)
    {
        return DB::table('employees')
            ->insertGetId($data);
    }

    public function updateEmployee(array $data, array $filters)
    {
        return DB::table('employees')
            ->where($filters)
            ->update($data);
    }

    public function deleteEmployee(array $filters)
    {
        return DB::table('employees')
            ->where($filters)
            ->delete();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
