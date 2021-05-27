<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthTokenController extends Controller
{
    use ApiResponser;
    public function login(Request $request)
    {
        $request->validate([
            'email'      => 'required|email',
            'password'     => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [
                    'The Credentials is incorrect'
                ]
            ]);
        }
        $token = $user->createToken('token-auth')->plainTextToken;
        return ApiResponser::success([
            'access_token'  => $token,
            'token_type'    => 'bearer'
        ], 'Login Successfully', 200);
    }
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return ApiResponser::success($user, 'Logout Successfully', 200);
    }
}
