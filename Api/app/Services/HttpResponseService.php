<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;

class HttpResponseService
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
