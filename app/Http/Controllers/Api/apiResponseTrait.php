<?php

namespace App\Http\Controllers\Api;


trait apiResponseTrait
{
    public function apiResponseTrait($data = null, $message = null, $status = null)
    {
        $array = [
            'data' => $data,
            'message' => $message,
            'status' => $status,
        ];
        return response($array);
    }
}
;
