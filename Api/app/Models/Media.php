<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Media extends Model
{
    use HasFactory;

    public function getMedia()
    {
        return DB::table('media')
            ->select('id','media_ref','who_is','who_id','name','url','extension','media_type','folder','is_active')
            ->get();
    }

    public function getMediaByRef(string $media_ref)
    {
        return DB::table('media')
            ->select('id','media_ref','who_is','who_id','name','url','extension','media_type','folder','is_active')
            ->where('ref',$media_ref)
            ->first();
    }

    public function getMediaByPage(int $start_no,int $page_size,array $filters, bool $is_get_total = false)
    {
        $sql = DB::table('media')
            ->select('id','media_ref','who_is','who_id','name','url','extension','media_type','folder','is_active');

        if($filters['keyword'] != ''){
            $sql->where(function ($q) use ($filters) {
                $q->where('name', 'LIKE', '%' . $filters['keyword'] . '%');
            });
        }

        if($filters['is_active'] === 0){
            $sql->where('is_active',0);
        }else if($filters['is_active'] === 1){
            $sql->where('is_active',1);
        } else {
            $sql->whereIn('is_active',[0,1]);
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

    public function getMediaWhere(array $data)
    {
        return DB::table('media')
            ->select('id','media_ref','who_is','who_id','name','url','extension','media_type','folder','is_active')
            ->where($data)
            ->get();
    }

    public function saveMedia(array $data)
    {
        return DB::table('media')
            ->insertGetId($data);
    }

    public function deleteMedia(string $media_ref)
    {
        return DB::table('media')
            ->where('media_ref',$media_ref)
            ->delete();
    }
}
