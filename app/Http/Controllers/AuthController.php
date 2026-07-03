<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Register a New User

    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $token = $user->createToken('library-api')->plainTextToken;

        return response()->json([
            'message' => 'User Registered Successfully',
            'token' => $token,
            'user' => $user
        ], 201);
    }

    //Login as a New User
    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if(!$user || !Hash::check($validated['password'], $user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        $token = $user->createToken('library-api')->plainTextToken;

        return response()->json([
            'message' => 'Login Successful',
            'token' => $token,
            'user' => $user
        ]);
    }

    //Logout user
    public function logout(): JsonResponse{
        request()->user()->currentAccessToken()->delete(); //Each method returns an object that allows the next method to be called.

        return response()->json([
            'message' => 'Logged out Successfully'
        ]);
    }

    //Authenticated user profile
    public function profile(): JsonResponse
    {
        return response()->json([
            'user' => request()->user()
        ]);
    }
}
