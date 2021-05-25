<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

/**
 * Trait to make response format and send as json 
 */
trait ApiResponser
{
       /**
        * Retrive and make JSON response when status is "Succes"
        *
        * @param [type] $data
        * @param string $message
        * @param integer $code
        * @return \Illuminate\Http\JsonResponse
        */
       public static  function success($data, string $message = null, int $code = null): JsonResponse
       {
              return response()->json([
                     "Status"      => "Success",
                     "Message"     => $message,
                     "data"        => $data
              ], $code);
       }
       /**
        * Retrive and make JSON response when status is "Errors"
        *
        * @param string $message
        * @param integer $code
        * @return  \Illuminate\Http\JsonResponse
        */
       protected function error(string $status, string $message = null, int $code, &$errors = null): JsonResponse
       {
              return response()->json(["Status"      => $status,
                     "Message"     => $message,
                     "Errors"      => $errors
              ], $code);
       }

       /**
        * Get the string message when json api response method was instantiated
        *
        * @param string $methodType
        * @param string $resourceType
        * @return string
        */
       protected function message(string $methodType, string $resourceType): string
       {
              switch ($methodType) {
                     case 'index':
                            # code...
                            return 'List Of All ' . $resourceType;
                            break;
                     case 'show':
                            # code...
                            return 'List Of Specified ' . $resourceType . ' By Its ID';
                            break;
                     case 'store':
                            # code...
                            return 'The new ' . $resourceType . ' was successfully saved';
                            break;
                     case 'update':
                            # code...
                            return 'successfully updating specified ' . $resourceType;
                            break;
                     case 'destroy':
                            # code...
                            return 'successfully deleting specified ' . $resourceType . ' By Its ID';
                            break;
                     default:
                            # code...
                            return 'please set method type and resource type';
                            break;
              }
       }
}
