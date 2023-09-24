<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt([
            'email' => $request->validated('email'),
            'password' => $request->validated('email')
        ])) {
            $user = Auth::user();
            $user?->tokens()->delete();
            $token = $user?->createToken('authToken')->plainTextToken;

            return response()->json(compact('user', 'token'));
        }

        return response()->json([
            'message' => __('auth.failed')
        ], Response::HTTP_UNAUTHORIZED);
    }

    /** TODO: Posso logar mas não consigo me cadastrar validar se deve implementar cadastro */
}
