<?php

namespace App\src\Alunos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlunosController
{
    protected $service;

    public function __construct(AlunosService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            return response()->json($this->service->getAll());
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao listar alunos',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function show($cpf)
    {
        try {
            $aluno = $this->service->getById($cpf);
            if (!$aluno) {
                return response()->json(['message' => 'Registro não encontrado'], 404);
            }
            return response()->json($aluno);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao buscar aluno',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $aluno = $this->service->criarAluno($request);
            return response()->json([
                'message' => 'Aluno criado com sucesso!',
                'data' => $aluno
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao criar aluno',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $aluno = $this->service->update($id, $request->all());

        if (!$aluno) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        return response()->json($aluno);
    }

    // public function inativarStatus($id)
    // {
    //     if ($this->service->delete($id)) {
    //         return response()->json(['message' => 'Cadastro inativado com sucesso'], 200);
    //     }
    //     return response()->json(['message' => 'Registro não encontrado'], 404);
    // }

    public function inativarStatus($id)
{
    // Ativa log das queries apenas nesta requisição
    \Illuminate\Support\Facades\DB::listen(function ($query) {
        \Illuminate\Support\Facades\Log::info('Query executada durante inativarStatus', [
            'sql' => $query->sql,
            'bindings' => $query->bindings,
            'time_ms' => $query->time,
        ]);
    });

    // Chama o serviço para inativar o registro
    if ($this->service->delete($id)) {
        return response()->json([
            'message' => 'Cadastro inativado com sucesso',
            'info_log' => 'Verifique storage/logs/laravel.log para detalhes da query'
        ], 200);
    }

    return response()->json(['message' => 'Registro não encontrado'], 404);
}


    public function ativarStatus($id)
    {
        if ($this->service->ativar($id)) {
            return response()->json(['message' => 'Cadastro ativado com sucesso'], 200);
        }
        return response()->json(['message' => 'Registro não encontrado'], 404);
    }
}
