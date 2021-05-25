<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class isNotExistException extends Exception
{
    /**
     * Get the erros message 
     *
     * @param Request $request
     * @return array
     */
    public function errors(Request $request): array
    {
        return [
            'profile_id' => 'the given profile_id : ' . $request->profile_id . ' already exist'
        ];
    }
}
