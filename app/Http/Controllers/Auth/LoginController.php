<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Traits\ApiTrait;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiTrait;

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $user = User::where('email', $request->login)
                ->orWhere('login', $request->login)
                ->first();

            if ($user and Hash::check($request->password, $user->password)) {
                $token = $user->createToken('session')->plainTextToken;
                return $this->fullResponse(__('auth.login'), ['token' => $token]);
            }
            return $this->messageResponse(__('auth.badAttempt'), 401);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();
            return $this->messageResponse(__('auth.logout'));
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
}
