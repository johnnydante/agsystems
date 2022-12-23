<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function getAll(): Collection
    {
        return User::all();
    }
}
