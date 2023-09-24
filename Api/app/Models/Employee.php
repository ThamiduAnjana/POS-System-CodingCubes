<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Employee extends Authenticatable implements JWTSubject
{
    use HasFactory;

    public function saveEmployee(array $data)
    {
        return DB::table('employees')
            ->insertGetId($data);
    }

    public static function getUser(mixed $data)
    {
        return DB::table('employees')
            ->select('users.*')
            ->where('users.id', '=', $data)
            ->first();
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
