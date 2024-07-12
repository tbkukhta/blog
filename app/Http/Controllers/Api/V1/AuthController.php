<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        return User::create($request->all());
    }

    public function login(UserRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'message' => 'Wrong email or password.'
            ], 401);
        }

        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json([
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'token' => $user->createToken("Token of the user: {$user->name}")->plainTextToken
            ]
        ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Token removed.'
        ]);
    }
}
