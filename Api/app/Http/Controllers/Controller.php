<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    public static function success($data, $message= 'Successful!', $status_code =  Response::HTTP_OK)
    {
        return response()->json(
            [
                'data' => $data,
                'message' => $message,
                'status' => $status_code
            ],
            $status_code
        );
    }


    public static function error($data, $message = 'Unsuccessful!', $status_code =  Response::HTTP_BAD_REQUEST)
    {
        return response()->json(
            [
                'data' => $data,
                'message' => $message,
                'status' => $status_code
            ],
            $status_code
        );
    }
}
