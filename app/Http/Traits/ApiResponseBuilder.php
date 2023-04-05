<?php

namespace App\Http\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiResponseBuilder
{
    protected function success($message, $data = [], $code = 200)
    {
        $response = ['success' => true, 'message' => $message];
        if (! empty($data)) {
            $response['data'] = $data;
        }
        throw new HttpResponseException(response()->json($response, $code));
    }

    protected function failure($message, $data = [], $code = 401)
    {
        $response = ['success' => false, 'message' => $message];
        if (! empty($data)) {
            $response['data'] = $data;
        }
        throw new HttpResponseException(response()->json($response, $code));
    }
}
