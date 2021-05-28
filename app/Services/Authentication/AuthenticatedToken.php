<?php

namespace App\Services\Authentication;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticatedToken extends Auth implements AuthenticatedTokenInterface
{
       /**
        * Authenticating request and storing token
        *
        * @param Request $request
        * @return JsonResponse
        */
       public function store(Request $request): JsonResponse
       {
              $this->authenticate($request);
              return $this->setResponse($request, 'login');
       }

       /**
        * Destroying token then sign out userb matching request credentials
        *
        * @param Request $request
        * @return JsonResponse
        */
       public function destroy(Request $request): JsonResponse
       {
              $this->signingOut($request);
              return $this->setResponse($request, 'logout');
       }
}
