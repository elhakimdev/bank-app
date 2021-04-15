<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

/**
 * Trait to send response as json 
 */
trait ApiResponser
{
       /**
        * Undocumented function
        *
        * @param [type] $data
        * @param string $message
        * @param integer $code
        * @return \Illuminate\Http\JsonResponse
        */
       protected function success($data, string $message = null, int $code = null): JsonResponse
       {
              return response()->json([
                     "Status"      => "Success",
                     "Message"     => $message,
                     "data"        => $data
              ], $code);
       }
       /**
        * get error response as JSON object
        *
        * @param string $message
        * @param integer $code
        * @return JsonResponse
        */
       protected function error(string $message = null, int $code): JsonResponse
       {
              return response()->json([
                     "Status"      => "An error Occurs",
                     "Message"     => $message,
              ], $code);
       }
}
