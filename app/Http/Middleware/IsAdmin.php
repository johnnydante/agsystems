<?php

namespace App\Http\Middleware;

use App\Constants\Role;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() and Auth::user()->role == Role::ADMIN) return $next($request);
        return new JsonResponse('Brak uprawnień do danego zasobu', 403);
    }
}
