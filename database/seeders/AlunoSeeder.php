<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlunoSeeder extends Seeder
{
    public function run()
    {
        // Recupera os usuários-alunos (role = 'aluno')
        $alunosUsers = DB::table('users')->where('role', 'aluno')->get();

        foreach ($alunosUsers as $index => $user) {
            DB::table('alunos')->insert([
                'user_id' => $user->id,
                'matricula' => 'A' . str_pad($index + 1, 3, '0', STR_PAD_LEFT), // A001, A002...
                'cpf' => '000.000.000-' . str_pad($index + 1, 2, '0', STR_PAD_LEFT),
                'data_nascimento' => now()->subYears(20 + $index), // exemplo: 20,21,22 anos
                //'sexo' => $index % 2 == 0 ? 'masculino' : 'feminino',
                'telefone' => '829900000' . $index,
                'cep' => '57035-00' . $index,
                'endereco' => 'Rua Exemplo ' . ($index + 1),
                'cidade' => 'Maceió',
                'estado' => 'AL',
            ]);
        }
    }
}
