<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    use HasFactory;

    public function getAddress()
    {
        return DB::table('addresses')
            ->select('id','ref','who_is','who_id','house','street','village','city','postal_code','district','province','country','status')
            ->get();
    }

    public function getAddressByRef(string $ref)
    {
        return DB::table('addresses')
            ->select('id','ref','who_is','who_id','house','street','village','city','postal_code','district','province','country','status')
            ->where('ref',$ref)
            ->first();
    }

    public function getAddressByPage(int $start_no,int $page_size,array $filters, bool $is_get_total = false)
    {
        $sql = DB::table('addresses')
            ->select('id','ref','who_is','who_id','house','street','village','city','postal_code','district','province','country','status');

        if($filters['keyword'] != ''){
            $sql->where(function ($q) use ($filters) {
                $q->where('house', 'LIKE', '%' . $filters['keyword'] . '%');
                $q->where('street', 'LIKE', '%' . $filters['keyword'] . '%');
                $q->where('village', 'LIKE', '%' . $filters['keyword'] . '%');
                $q->where('city', 'LIKE', '%' . $filters['keyword'] . '%');
                $q->where('postal_code', 'LIKE', '%' . $filters['keyword'] . '%');
                $q->where('district', 'LIKE', '%' . $filters['keyword'] . '%');
                $q->where('province', 'LIKE', '%' . $filters['keyword'] . '%');
                $q->where('country', 'LIKE', '%' . $filters['keyword'] . '%');
            });
        }

        if($filters['status'] === 0){
            $sql->where('status',0);
        }else if($filters['status'] === 1){
            $sql->where('status',1);
        } else {
            $sql->whereIn('status',[0,1]);
        }

        if($is_get_total){
            return $sql->count();
        } else {
            return  $sql->orderBy('id','DESC')
                ->skip($start_no)
                ->take($page_size)
                ->get();
        }
    }

    public function getAddressWhere(array $where)
    {
        return DB::table('addresses')
            ->select('id','ref','who_is','who_id','house','street','village','city','postal_code','district','province','country','status')
            ->where($where)
            ->get();
    }

    public function saveAddress(array $data)
    {
        return DB::table('addresses')
            ->insertGetId($data);
    }

    public function updateAddress(string $ref, array $data)
    {
        return DB::table('addresses')
            ->where('ref',$ref)
            ->update($data);
    }
}
