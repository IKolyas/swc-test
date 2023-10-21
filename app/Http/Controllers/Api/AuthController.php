<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use App\Traits\SendResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use SendResponse;

    public function register(RegisterRequest $request): JsonResponse
    {

        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);;
        $token = $user->createToken('token')->plainTextToken;

        return $this->successResponse(['token' => $token], 201);
    }

    // User login
    public function login(LoginRequest $request): JsonResponse
    {

        $validated = $request->validated();

        if (Auth::attempt(['login' => $validated['login'], 'password' => $validated['password']])) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;

            return $this->successResponse(['token' => $token]);
        }

        return $this->failedResponse('Auth filed!', 401);
    }

    public function logout(): JsonResponse
    {

        if (!Auth::check()) {
            return $this->failedResponse('Auth filed!', 401);
        }

        auth()->user()->tokens()->delete();

        return $this->successResponse(['message' => 'Successfully logged out']);
    }
}