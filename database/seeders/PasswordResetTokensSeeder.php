<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetTokensSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('password_reset_tokens')->insert([
            [
                'email' => 'user@example.com',
                'token' => Str::random(64),
                'created_at' => now(),
            ],
            [
                'email' => 'admin@example.com',
                'token' => Str::random(64),
                'created_at' => now(),
            ],
        ]);
    }
}
