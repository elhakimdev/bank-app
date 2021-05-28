<?php

namespace App\Services\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth as ApiAuthenticate;

class Auth
{

       use ApiResponser;

       /**
        * Authenticate request
        *
        * @param Request $request
        * @return void
        */
       public function authenticate(Request $request)
       {
              $this->ensureIsNotRateLimited($request);
              if (!ApiAuthenticate::attempt($request->only('email', 'password'))) {
                     RateLimiter::hit($this->throttleKey($request));
                     throw ValidationException::withMessages([
                            'email' => ('auth.failed'),
                     ]);
              }
              RateLimiter::clear($this->throttleKey($request));
       }

       /**
        * Ensure request is not limited
        *
        * @param Request $request
        * @return void
        */
       public function ensureIsNotRateLimited(Request $request): void
       {
              if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
                     return;
              }
              event(new Lockout($request));
              $seconds = RateLimiter::availableIn($this->throttleKey($request));
              throw ValidationException::withMessages([
                     'email' => trans('auth.throttle' . [
                            'seconds' => $seconds,
                            'minutes' => ceil($seconds / 60),
                     ])
              ]);
       }

       /**
        * Signing out user
        *
        * @param Request $request
        * @return void
        */
       public function signingOut(Request $request): void
       {
              $this->refreshAuthToken($request);
       }

       /**
        * Generate new token from request
        *
        * @param Request $request
        * @return string
        */
       public function generateAuthToken(Request $request): string
       {
              $user  = $this->getUser($request);
              $token = $user->createToken('token-auth')->plainTextToken;
              $this->setLoginLog($user, $token);
              return $token;
       }

       /**
        * Refresh token when user was loging out
        *
        * @param Request $request
        * @return void
        */
       public function refreshAuthToken(Request $request): void
       {
              $user  = $this->getUser($request);
              $user->tokens()->delete();
              $this->setLogoutLog($user);
       }

       /**
        * get user model
        *
        * @param Request $request
        * @return object
        */
       public function getUser(Request $request): object
       {
              return User::where('email', $request->email)->first();
       }

       /**
        * get throttle key
        *
        * @param Request $request
        * @return string
        */
       public function throttleKey(Request $request): string
       {
              return Str::lower($request->email) . '|' . $request->ip();
       }

       public function setLoginLog($user, $token = null, bool $isLogin = null)
       {
              activity('Login')->performedOn($user)->withProperties([
                     'email'         => $user->email,
                     'token-auth'    => $token
              ])->log('An User Was Logged In');
       }

       public function setLogoutLog($user)
       {
              activity('Logout')->performedOn($user)->withProperties([
                     'user_email'            => $user->email,
                     'occurs_time'           => Carbon::now()
              ])->log('An User Was Log Out');
       }

       /**
        * Set The Json Response
        *
        * @param Request $request
        * @param string $method
        * @return JsonResponse
        */
       public function setResponse(Request $request, string $method): JsonResponse
       {
              switch ($method) {
                     case 'login':
                            return ApiResponser::success([
                                   'user'                  => $this->getUser($request),
                                   'authentication_info'   => [
                                          'access_token'  => $this->generateAuthToken($request),
                                          'token_type'    => 'bearer'
                                   ]
                            ], 'Login Successfully', 200);
                            break;
                     case 'logout':
                            return ApiResponser::success($request->user(), 'Logout Successfully', 200);
                            break;
                     default:
                            return ApiResponser::success('No Response Returned', 'NO Action', 200);
                            break;
              }
       }
}
