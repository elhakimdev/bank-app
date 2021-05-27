<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Carbon\Carbon;
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
        activity('Login')->performedOn($user)->withProperties([
            'email'         => $user->email,
            'token-auth'    => $token
        ])->log('An User Logged In');
        return ApiResponser::success([
            'user'                  => $user,
            'authentication_info'   => [
                'access_token'  => $token,
                'token_type'    => 'bearer'
            ]
        ], 'Login Successfully', 200);
    }
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        activity('Logout')->performedOn($user)->withProperties([
            'user_email'            => $user->email,
            'occurs_time'           => Carbon::now()
        ])->log('An User Was Log Out');
        return ApiResponser::success($user, 'Logout Successfully', 200);
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
