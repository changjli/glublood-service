<?php

namespace App\Classes;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResponseTemplate
{
    public static function sendResponseError($e = null, $message = "Something went wrong! Process not completed", $code = 400)
    {
        if ($e) {
            Log::info($e);
        }
        $response = [
            'status' => $code,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public static function sendResponseSuccess($message, $result = null, $code = 200, $additional = [])
    {
        $response = [
            'status' => $code,
            'message' => $message,
        ];
        if ($result != null) {
            $response['data'] = $result;
        }
        if (count($additional) > 1) {
            foreach ($additional as $key => $value) {
                $response[$key] = $value;
            }
        }
        return response()->json($response, 200);
    }

    public static function sendResponseErrorWithRollback($e = null, $message = "Something went wrong! Process not completed", $code = 400)
    {
        DB::rollBack();
        return self::sendResponseError($e, $message, $code);
    }

    public static function sendResponseSuccessWithCommit($message, $result = null, $code = 200)
    {
        DB::commit();
        return self::sendResponseSuccess($message, $result, $code);
    }
}
