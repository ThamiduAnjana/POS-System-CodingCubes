<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Settings extends Model
{
    use HasFactory;

    public function getSettings($where)
    {
        return DB::table('settings')
            ->get();
    }

    public function getSettingsByWhere($where)
    {
        return DB::table('settings')
            ->where($where)
            ->get();
    }

    public function getSettingByWhere($where)
    {
        return DB::table('settings')
            ->where($where)
            ->first();
    }
}
