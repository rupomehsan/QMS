<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        try {

            $data = $request->validated();
            $user = User::where('email', $data['email'])->first();
            if (!$user) {
                return response([
                    'status' => 'error',
                    'message' => "Incorrect Email Address...",
                ], 401);
            }
            if (!Hash::check($data['password'], $user->password)) {
                return response([
                    'status' => 'error',
                    'message' => "Password doesn't matched...",
                ], 401);
            }

            if (!auth()->attempt($request->validated())) {
                return response([
                    'status' => 'error',
                    'message' => "Creadential doesn't matched...",
                ], 401);
            }

            $accessToken = auth()->user()->createToken('authToken');
            return response([
                "status" => "success",
                "message" => "You Are Successfully Log In",
                'data' => [
                    'token' => 'Bearer ' . $accessToken->plainTextToken,
                    'user' => $user,
                ],
            ]);
        } catch (\Exception $e) {
            return response([
                "status" => "server_error",
                "message" => $e->getMessage()
            ]);
        }
    }

    public function register(AuthRequest $request)
    {
        try {
            if (User::query()->create($request->validated())) {
                return response([
                    "status" => "success",
                    "message" => "Registration successfully complete"
                ], 200);
            }
        } catch (\Exception $e) {
            return response([
                "status" => "server_error",
                "message" => $e->getMessage()
            ]);
        }
    }
}
