<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'name' =>  'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',

            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors(),
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors(),
                ], 401);
            }


            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => "Credentials don't match with our records",
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully',
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            /** @disregard P1013  */
            Auth::user()->tokens()->delete();
            return response()->json(["message" => "logged out"]);
        } else {
            return response()->json(["error" => "User not authenticated"], 401);
        }
    }
}
