<?php

namespace App\Services;

use App\Models\Document;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

class DocumentService
{
    public $date;
    public $documentModel;
    public $settingModel;

    public function __construct()
    {
        $this->date = date('Y-m-d H:i:s');
        $this->documentModel = new Document();
        $this->settingModel = new Settings();
    }

    public function uploadDocument($document,$folder)
    {
        $setting = $this->settingModel->getSettingWhere(['key' => 'subdomain']);

        $rand_name = md5(uniqid(rand(), true)).time().mt_rand();
        $name = $rand_name.'.'.$document->getClientOriginalExtension();
        $destinationPath = public_path('uploads/'.$setting->value.'/'.$folder.'/');
        $document->move($destinationPath, $name);
        $file_type = $_FILES['file']['type'];

        $data = array(
            'name' => $name,
            'url' => asset('uploads/'.$setting->value.'/'.$folder.'/'.$name),
            'type' => $file_type,
        );

        return $data;
    }

    public function saveDocument(array $data)
    {
        $uploaded_data = $this->uploadDocument($data['document'],$data['folder']);

        $document = array(
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

        $document_id = $this->documentModel->saveDocument($document);

        return $document_id;
    }

    public function deleteDocument(array $data)
    {
        if($data['ref']){
            $document = $this->documentModel->getDocumentWhere(['ref' => $data['ref']]);
            if(file_exists($document->url)){
                unlink($document->url);
                $this->documentModel->deleteDocument($data['ref']);
                return true;
            }else{
                return false;
            }
        }
        return false;
    }
}
