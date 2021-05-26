<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponser;
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return ApiResponser::error('Authentication Failed', 'Login Failed/Please check again Your Email or Password !', 401);
        }

        $user = User::where('email', $request->email)->first();
        if (!Hash::check($request->password, $user->password)) {
            throw new Exception('Your Password Doesnt Match');
        }

        $token = $user->createToken('token-auth')->plainTextToken;
        return ApiResponser::success([
            'access_token'  => $token,
            'token_type'    => 'bearer'
        ], 'Login Successfully', 200);
    }
    public function register(RegisterRequest $request)
    {
    }
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return ApiResponser::success('', 'Logout SUccessfully', 200);
    }
}
