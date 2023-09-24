<?php

namespace App\Services;

use App\Models\Mail;
use Illuminate\Support\Facades\Auth;

class MailService
{
    public $date;
    public $mailModel;

    public function __construct()
    {
        $this->date = date('Y-m-d H:i:s');
        $this->mailModel = new Mail();
    }

    public function saveMail(array $data)
    {
        $mail = $data['mail'];
        $mail_id = null;

        if($data['ref']){
            $patch_data = array(
                'mail' => $mail['mail'],
                'is_primary' => $mail['is_primary'],
                'status' => $mail['status'],
                'updated_at' => $this->date,
                'updated_by' => Auth::user()->id,
            );

            $this->mailModel->updateMail($data['ref'],$patch_data);
            $mail_id = $this->mailModel->getMailByRef($data['ref']);

        }else{
            $patch_data = array(
                'owner_type' => $data['owner_type'],
                'owner_id' => $data['owner_id'],
                'mail' => $mail['mail'],
                'is_primary' => $mail['is_primary'],
                'status' => 1,
                'created_at' => $this->date,
                'created_by' => Auth::user()->id,
            );

            $mail_id = $this->mailModel->saveMail($patch_data);
        }
        return $mail_id;
    }
}
