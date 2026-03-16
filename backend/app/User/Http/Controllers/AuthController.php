<?php

namespace App\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\User\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function login(LoginRequest $request): ApiResponse{
        $credentials = $request->validated();
        if (!auth()->attempt($credentials)) {
            return new ApiResponse(data: ['message' => 'Invalid credentials'], httpCode: 401);
        }
        $token = auth()->user()->createToken('authToken')->plainTextToken;
        $cookie = Cookie::make(
            'app_auth',
            $token,
            30 * 24 * 60, // 1 Month
            '/',
            null,
            config('app.env') !== 'local',
            true                 
        );
        return (new ApiResponse(data: ['token' => $token]))->withCookie(cookie: $cookie);
    }

    public function profile(): ApiResponse{
        return new ApiResponse(data: ['user' => auth()->user()]);
    }

    public function logout(): ApiResponse{
        auth('web')->logout();
        $cookie = Cookie::forget('app_auth', '/', null);
        return (new ApiResponse(data: ['success' => true]))->withCookie(cookie: $cookie);
    }
}
