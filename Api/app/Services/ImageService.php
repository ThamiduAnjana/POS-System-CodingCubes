<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

class ImageService
{
    public $date;
    public $imageModel;
    public $settingModel;

    public function __construct()
    {
        $this->date = date('Y-m-d H:i:s');
        $this->imageModel = new Image();
        $this->settingModel = new Settings();
    }

    public function uploadImage($image,$folder)
    {
        $setting = $this->settingModel->getSettingWhere(['key' => 'subdomain']);

        $rand_name = md5(uniqid(rand(), true)).time().mt_rand();
        $name = $rand_name.'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/'.$setting->value.'/'.$folder.'/');
        $image->move($destinationPath, $name);
        $file_type = $_FILES['file']['type'];

        $data = array(
            'name' => $name,
            'url' => asset('uploads/'.$setting->value.'/'.$folder.'/'.$name),
            'type' => $file_type,
        );

        return $data;
    }

    public function saveImage(array $data)
    {
        $uploaded_data = $this->uploadImage($data['image'],$data['folder']);

        $image = array(
            'owner_type' => $data['owner_type'],
            'owner_id' => $data['owner_id'],
            'name' => $uploaded_data['name'],
            'url' => $uploaded_data['url'],
            'type' => $uploaded_data['type'],
            'folder' => $data['folder'],
            'status' => 1,
            'created_at' => $this->date,
            'created_by' => Auth::user()->id,
        );

        $image_id = $this->imageModel->saveImage($image);

        return $image_id;
    }

    public function deleteImage(array $data)
    {
        if($data['ref']){
            $image = $this->imageModel->getImageWhere(['ref' => $data['ref']]);
            if(file_exists($image->url)){
                unlink($image->url);
                $this->imageModel->deleteImage($data['ref']);
                return true;
            }else{
                return false;
            }
        }
        return false;
    }
}
