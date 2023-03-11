<?php

namespace App\Http\Controllers;

use App\Http\Requests\{LoginRequest, RegistrationRequest};
use App\Services\User\JwtAuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        private  JwtAuthService $jwtAuthService,
    ) {
        $this->jwtAuthService = $jwtAuthService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        return $this->jwtAuthService->signIn($request->validated());
    }

    public function register(RegistrationRequest $request): JsonResponse
    {
        return $this->jwtAuthService->signUp($request->validated());
    }

    public function logout(): JsonResponse
    {
        return $this->jwtAuthService->signOut();
    }
}
