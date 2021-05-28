<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Services\Authentication\AuthenticatedToken;

class AuthTokenController extends Controller
{
    use ApiResponser;
    public $authService;
    /**
     * Constructor for auth services
     *
     * @param AuthenticatedToken $authService
     */
    public function __construct(AuthenticatedToken $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Log in auth service
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->authService->store($request);
    }

    /**
     * Log out auth service
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        return $this->authService->destroy($request);
    }
    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|unique:users|min:8',
            'email'     => 'required',
            'password'  => 'required'
        ]);
        $newUser = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);
        activity('Register')->performedOn($newUser)->withProperties([
            'name'          => $newUser->name,
            'email'         => $newUser->email,
            'occurs_time'   => Carbon::now()
        ])->log('A New User Was Succesfully Registered');
        return ApiResponser::success($newUser, 'Register Successfully', 200);
    }
}
