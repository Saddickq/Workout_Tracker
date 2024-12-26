<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $requset)
    {
        $fields = $requset->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($fields);
        $token = $user->createToken($requset->email);

        return response()->json(['user' => $user, 'token' => $token->plainTextToken], 201);
    }


    public function login(Request $requset)
    {
        $requset->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $requset->email)->first();

        if (!$user || !Hash::check($requset->password, $user->password)) {
            return response()->json(['message' => 'Invalid Authentication credentials'], 401);
        }
        $token = $user->createToken($user->email);

        return response()->json(['user' => $user, 'token' => $token->plainTextToken], 201);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out'], 201);    }
}
