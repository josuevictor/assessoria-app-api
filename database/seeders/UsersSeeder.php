<?php

namespace Database\Seeders;

use Faker\Guesser\Name;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'assessorTeste',
                'email' => 'user@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('secret123'),
                'role' => 'assessor',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ana Silva',
                'email' => 'ana.silva@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('teste123'),
                'role' => 'aluno',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bruno Oliveira',
                'email' => 'bruno.oliveira@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('teste123'),
                'role' => 'aluno',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carla Mendes',
                'email' => 'carla.mendes@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('teste123'),
                'role' => 'aluno',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Diego Souza',
                'email' => 'diego.souza@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('teste123'),
                'role' => 'aluno',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Eduarda Lima',
                'email' => 'eduarda.lima@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('teste123'),
                'role' => 'aluno',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Felipe Rocha',
                'email' => 'felipe.rocha@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('teste123'),
                'role' => 'aluno',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gabriela Santos',
                'email' => 'gabriela.santos@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('teste123'),
                'role' => 'aluno',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Henrique Castro',
                'email' => 'henrique.castro@example.com',
                'email_verified_at' => null,
                'password' => Hash::make('teste123'),
                'role' => 'aluno',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            
        ]);
    }
}
