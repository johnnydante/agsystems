<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Http\Traits\ApiTrait;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use ApiTrait;

    protected UserService $UserService;

    public function __construct()
    {
        $this->UserService = new UserService();
    }

    public function index(): JsonResponse
    {
        try {
            $users = $this->UserService->getAll();
            return $this->fullResponse(__('user.getAll'), $users->toArray());
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
}
