<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mail extends Model
{
    use HasFactory;

    public function getMail()
    {
        return DB::table('mails')
            ->select('id','ref','who_is','who_id','mail','is_primary','status')
            ->get();
    }

    public function getMailByRef(string $ref)
    {
        return DB::table('mails')
            ->select('id','ref','who_is','who_id','mail','is_primary','status')
            ->where('ref',$ref)
            ->first();
    }

    public function getMailByPage(int $start_no,int $page_size,array $filters, bool $is_get_total = false)
    {
        $sql = DB::table('mails')
            ->select('id','ref','who_is','who_id','mail','is_primary','status');

        if($filters['keyword'] != ''){
            $sql->where(function ($q) use ($filters) {
                $q->where('mail', 'LIKE', '%' . $filters['keyword'] . '%');
            });
        }

        if($filters['is_primary'] === 0){
            $sql->where('is_primary',0);
        }else if($filters['is_primary'] === 1){
            $sql->where('is_primary',1);
        } else {
            $sql->whereIn('is_primary',[0,1]);
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

    public function getMailWhere(array $data)
    {
        return DB::table('mails')
            ->select('id','ref','who_is','who_id','mail','is_primary','status')
            ->where($data)
            ->get();
    }

    public function saveMail(array $data)
    {
        return DB::table('mails')
            ->insertGetId($data);
    }

    public function updateMail(string $ref,array $data)
    {
        return DB::table('mails')
            ->where('ref',$ref)
            ->update($data);
    }
}
