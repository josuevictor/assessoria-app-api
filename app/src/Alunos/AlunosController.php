<?php

namespace App\src\Alunos;

use Illuminate\Http\Request;

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
            return response()->json(['message' => 'Erro ao listar alunos', 'error' => $th->getMessage()], 500);
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
            return response()->json(['message' => 'Erro ao buscar aluno', 'error' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            //Validação dos dados recebidos (sem matricula)
            $validated = $request->validate([
                'user_email' => 'required|email|exists:users,email',
                'cpf' => 'nullable|string|max:14',
                'data_nascimento' => 'nullable|date',
                'sexo' => 'nullable|string|max:10',
                'telefone' => 'nullable|string|max:15',
                'cep' => 'nullable|string|max:9',
                'endereco' => 'nullable|string|max:255',
                'cidade' => 'nullable|string|max:100',
                'estado' => 'nullable|string|max:2',
            ]);

            //Pega o usuário pelo email
            $user = \App\Models\User::where('email', $validated['user_email'])->first();
            $validated['user_id'] = $user->id;
            unset($validated['user_email']);

            //Gera matrícula automática (A001, A002, etc.)
            $lastAluno = \App\src\Alunos\Alunos::latest('id')->first();
            $nextNumber = $lastAluno ? $lastAluno->id + 1 : 1;
            $validated['matricula'] = 'A' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            //Cria o registro via Service
            $aluno = $this->service->create($validated);

            //Retorna o JSON com o aluno criado
            return response()->json([
                'message' => 'Aluno criado com sucesso!',
                'data' => $aluno
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Erro ao criar aluno', 'error' => $th->getMessage()], 500);
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


    public function inativarStatus($id)
    {
        if ($this->service->delete($id)) {
            return response()->json(['message' => 'Cadastro inativado com sucesso'], 200);
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