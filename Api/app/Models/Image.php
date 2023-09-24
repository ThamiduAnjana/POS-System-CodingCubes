<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    use HasFactory;

    public function getImage()
    {
        return DB::table('images')
            ->select('id','ref','who_is','who_id','name','url', 'type','status')
            ->get();
    }

    public function getImageByRef(string $ref)
    {
        return DB::table('images')
            ->select('id','ref','who_is','who_id','name','url', 'type','status')
            ->where('ref',$ref)
            ->first();
    }

    public function getImageByPage(int $start_no,int $page_size,array $filters, bool $is_get_total = false)
    {
        $sql = DB::table('images')
            ->select('id','ref','who_is','who_id','name','url', 'type','status');

        if($filters['keyword'] != ''){
            $sql->where(function ($q) use ($filters) {
                $q->where('name', 'LIKE', '%' . $filters['keyword'] . '%');
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

    public function getImageWhere(array $data)
    {
        return DB::table('images')
            ->select('id','ref','who_is','who_id','name','url', 'type','status')
            ->where($data)
            ->get();
    }

    public function saveImage(array $data)
    {
        return DB::table('images')
            ->insertGetId($data);
    }

    public function deleteImage(string $ref)
    {
        return DB::table('images')
            ->where('ref',$ref)
            ->delete();
    }

}
