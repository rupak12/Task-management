<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
     // User Registration
     public function register(Request $request)
     {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
 
         $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
         ]);
 
         $token = $user->createToken('API Token')->plainTextToken;
 
         return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'token' => $token,
            'user' => $user,
            'redirect_url' => route('taskList'),
        ], 201);
     }
 
     // User Login
     public function login(Request $request)
     {
         $request->validate([
             'email' => 'required|string|email',
             'password' => 'required|string',
         ]);
 
         $user = User::where('email', $request->email)->first();
 
         if (!$user || !Hash::check($request->password, $user->password)) {
             throw ValidationException::withMessages([
                 'email' => ['The provided credentials are incorrect.'],
             ]);
         }
 
         $token = $user->createToken('API Token')->plainTextToken;
 
         return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
            'redirect_url' => route('taskList'),
        ]);
     }
 
     // User Logout
     public function logout(Request $request)
     {
        $isSuccess = $request->user()->currentAccessToken()->delete();
        if($isSuccess){
            return response()->json([
                'status' => true,
                'message' => 'Logged out successfully',
                'redirect_url' => route('login'),
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function fetchAuthUser(Request $request)
     {
        $user = $request->user();

        if ($user) {
            return response()->json([
                'status' => true,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'You are not authorized, please check.',
                'redirect_url' => route('login'),
            ]);
        }
    }
}
