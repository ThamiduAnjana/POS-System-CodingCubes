<?php

namespace App\Services;

class HttpResponseService
{
    public function successReturn($data, $message = 'Data Return Successfully', $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $status
        ]);
    }

    public function errorReturn($data, $message = 'Data Return Unsuccessfully', $status = 401): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $status
        ]);
    }
}
