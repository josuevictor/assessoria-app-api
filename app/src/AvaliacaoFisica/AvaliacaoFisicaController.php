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
            return response()->json(['message' => 'Erro ao listar avaliações físicas', 'error' => $th->getMessage()], 500);
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
            return response()->json(['message' => 'Erro ao buscar avaliação física', 'error' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'cpf' => 'required|string|size:14',
                'data_avaliacao' => 'required|date',
                'peso' => 'required|numeric|min:0|max:500',
                'percentual_gordura' => 'nullable|numeric|min:0|max:100',
                'vo2max' => 'nullable|numeric|min:0|max:100',
                'massa_magra' => 'nullable|numeric|min:0|max:300',
                'massa_gorda' => 'nullable|numeric|min:0|max:300',
                'imc' => 'nullable|numeric|min:0|max:100',
                'frequencia_cardiaca_repouso' => 'nullable|integer|min:20|max:200',
                'circunferencia_abdomen' => 'nullable|numeric|min:0|max:300',
                'observacoes' => 'nullable|string|max:500',
            ]);

            $cpf = $validated['cpf'];
            unset($validated['cpf']);

            // pega user_id do aluno pelo cpf
            $aluno = \App\src\Alunos\Alunos::where('cpf', $cpf)->first();
            $user_id = $aluno['user_id'] ?? null;
            if (!$user_id) {
                return response()->json(['message' => 'Aluno com CPF informado não encontrado'], 404);
            }

            $validated['user_id'] = $user_id;
            unset($validated['cpf']);

            // cria avaliação física
            $atividade = $this->service->create($validated);
            return response()->json($atividade, 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao criar avaliação física', 'error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $atividade = $this->service->update($id, $request->all());
            if (!$atividade) {
                return response()->json(['message' => 'Registro não encontrado'], 404);
            }
        return response()->json($atividade);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao atualizar avaliação física', 'error' => $th->getMessage()], 500);
        }
    }
}