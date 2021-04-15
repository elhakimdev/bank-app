<?php

namespace App\Traits;

/**
 * Trait to send response as json 
 */
trait ApiResponser
{
       protected function success($data, $message = null, $code = null)
       {
              return response()->json([
                     "Status"      => "Success",
                     "Message"     => $message,
                     "data"        => $data
              ], $code);
       }
       protected function error($message = null, $code)
       {
              return response()->json([
                     "Status"      => "An error Occurs",
                     "Message"     => $message,
              ], $code);
       }
}
