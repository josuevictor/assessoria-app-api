<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Rota de registro
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
        'role' => 'required|in:aluno,assessor',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Usuário registrado com sucesso!',
        'user' => $user,
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
});

//Rota de login
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user,
    ]);
});

//Alunos
Route::prefix('alunos')->group(function () {
    Route::get('/', [App\src\Alunos\AlunosController::class, 'index']);
    Route::get('/{cpf}', [App\src\Alunos\AlunosController::class, 'show']);
    Route::post('/', [App\src\Alunos\AlunosController::class, 'store']);
    Route::put('/{id}', [App\src\Alunos\AlunosController::class, 'update']);
    Route::patch('inativar/{id}', [App\src\Alunos\AlunosController::class, 'inativarStatus']);
    Route::patch('ativar/{id}', [App\src\Alunos\AlunosController::class, 'ativarStatus']);
});


//Atividades Strava
Route::prefix('atividades-strava')->group(function () {
    Route::get('/', [App\src\AtividadeStrava\AtividadeStravaController::class, 'index']);
    Route::get('/{id}', [App\src\AtividadeStrava\AtividadeStravaController::class, 'show']);
    Route::post('/', [App\src\AtividadeStrava\AtividadeStravaController::class, 'store']);
    Route::put('/{id}', [App\src\AtividadeStrava\AtividadeStravaController::class, 'update']);
    Route::delete('/{id}', [App\src\AtividadeStrava\AtividadeStravaController::class, 'destroy']);
});

//Avaliações Físicas
Route::prefix('avaliacoes-fisicas')->group(function () {
    Route::get('/', [App\src\AvaliacaoFisica\AvaliacaoFisicaController::class, 'index']);
    Route::get('/{cpf}', [App\src\AvaliacaoFisica\AvaliacaoFisicaController::class, 'showByCpf']);
    Route::post('/', [App\src\AvaliacaoFisica\AvaliacaoFisicaController::class, 'store']);
    Route::put('/{id}', [App\src\AvaliacaoFisica\AvaliacaoFisicaController::class, 'update']);
});


//Eventos
Route::prefix('eventos-corrida')->group(function () {
    Route::get('/', [App\src\EventoCorrida\EventoCorridaController::class, 'index']);
    Route::get('/{id}', [App\src\EventoCorrida\EventoCorridaController::class, 'show']);
    Route::post('/', [App\src\EventoCorrida\EventoCorridaController::class, 'store']);
    Route::put('/{id}', [App\src\EventoCorrida\EventoCorridaController::class, 'update']);
    Route::delete('/{id}', [App\src\EventoCorrida\EventoCorridaController::class, 'destroy']);
});

//Exercícios
Route::prefix('exercicios')->group(function () {
    Route::get('/', [App\src\Exercicio\ExercicioController::class, 'index']);
    Route::get('/{id}', [App\src\Exercicio\ExercicioController::class, 'show']);
    Route::post('/', [App\src\Exercicio\ExercicioController::class, 'store']);
    Route::put('/{id}', [App\src\Exercicio\ExercicioController::class, 'update']);
    Route::delete('/{id}', [App\src\Exercicio\ExercicioController::class, 'destroy']);
});

//Planilhas
Route::prefix('planilhas')->group(function () {
    Route::get('/', [App\src\Planilha\PlanilhaController::class, 'index']);
    Route::get('/{id}', [App\src\Planilha\PlanilhaController::class, 'show']);
    Route::post('/', [App\src\Planilha\PlanilhaController::class, 'store']);
    Route::put('/{id}', [App\src\Planilha\PlanilhaController::class, 'update']);
    Route::delete('/{id}', [App\src\Planilha\PlanilhaController::class, 'destroy']);
});

//Ranking
Route::prefix('ranking')->group(function () {
    Route::get('/', [App\src\Ranking\RankingController::class, 'index']);
    Route::get('/{id}', [App\src\Ranking\RankingController::class, 'show']);
    Route::post('/', [App\src\Ranking\RankingController::class, 'store']);
    Route::put('/{id}', [App\src\Ranking\RankingController::class, 'update']);
    Route::delete('/{id}', [App\src\Ranking\RankingController::class, 'destroy']);
});

//treino
Route::prefix('treino')->group(function () {
    Route::get('/', [App\src\Treino\TreinoController::class, 'index']);
    Route::get('/{planilha_id}', [App\src\Treino\TreinoController::class, 'show']);
    Route::post('/', [App\src\Treino\TreinoController::class, 'store']);
    Route::put('/{id}', [App\src\Treino\TreinoController::class, 'update']);
    Route::delete('/{id}', [App\src\Treino\TreinoController::class, 'destroy']);
});

//treino realizado
Route::prefix('treino-realizado')->group(function () {
    Route::get('/', [App\src\TreinoRealizado\TreinoRealizadoController::class, 'index']);
    Route::get('/{id}', [App\src\TreinoRealizado\TreinoRealizadoController::class, 'show']);
    Route::post('/', [App\src\TreinoRealizado\TreinoRealizadoController::class, 'store']);
    Route::put('/{id}', [App\src\TreinoRealizado\TreinoRealizadoController::class, 'update']);
    Route::delete('/{id}', [App\src\TreinoRealizado\TreinoRealizadoController::class, 'destroy']);
});
