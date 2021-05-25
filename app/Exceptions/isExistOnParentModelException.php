<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class isExistOnParentModelException extends Exception
{
       public function errros(Request $request)
       {
              return [
                     'profile_id'            => $request->profile_id,
                     'errrors_detail'        => 'can not add or update in child rows whit this profile_id : ' . $request->profile_id,
                     'caused'                => 'This profile_id : ' . $request->profile_id . ' is not already exist'
              ];
       }
}
