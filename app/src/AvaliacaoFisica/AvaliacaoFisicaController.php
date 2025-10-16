<?php

namespace App\src\AvaliacaoFisica;

use Illuminate\Http\Request;

class AvaliacaoFisicaController
{
    protected $service;

    public function __construct(AvaliacaoFisicaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            return response()->json($this->service->getAll());
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao listar avaliações físicas',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function showByCpf($cpf)
    {
        try {
            $avaliacoes = $this->service->getByCpf($cpf);
            if ($avaliacoes->isEmpty()) {
                return response()->json(['message' => 'Registro não encontrado'], 404);
            }

            return response()->json($avaliacoes);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao buscar avaliação física',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $avaliacao = $this->service->create($request->all());
            return response()->json($avaliacao, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao criar avaliação física',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $avaliacao = $this->service->update($id, $request->all());
            if (!$avaliacao) {
                return response()->json(['message' => 'Registro não encontrado'], 404);
            }

            return response()->json($avaliacao);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao atualizar avaliação física',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
