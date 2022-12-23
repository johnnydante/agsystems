<?php

namespace Database\Seeders;

use App\Constants\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'email' => 'root@test.pl',
            'login' => 'root',
            'password' => Hash::make('root'),
            'role' => Role::ADMIN
        ]);
        for ($i = 0; $i < 10; $i++) {
            User::factory()->create([
                'role' => Role::USER
            ]);
        }
    }
}
