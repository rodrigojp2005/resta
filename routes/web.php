<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TextoController;
use App\Http\Controllers\AutorizacoesController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    //EXEMPLO DE ROTA::Solicitações HTTP:GET, POST, PUT, DELETE('Endereço na URL', [nomeDoController::class, 'metodo'])->nomeDaRota ou apelido
    //ROTAS PARA O USUÁRIO
    Route::get('/search', [UserController::class, 'search'])->name('search');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('show'); 
    // ROTAS PARA O TEXTO
    Route::get('/dashboard', [TextoController::class, 'listarTitulos'])->name('dashboard');
    Route::get('/escrever_carta', [TextoController::class, 'escreverCarta'])->name('escrever_carta');
    Route::post('/salvar', [TextoController::class, 'salvarTexto'])->name('salvar_texto');
    Route::get('/texto/{id}', [TextoController::class, 'deletarTexto'])->name('deletar_texto');
    Route::get('/texto/{id}/editar', [TextoController::class, 'editarTexto'])->name('editar_texto');
    Route::put('/texto/{id}/atualizar', [TextoController::class, 'atualizarTexto'])->name('atualizar_texto');
    //ROTAS PARA AUTORIZAÇÕES
    // Route::get('/autorizacoes', [UserController::class, 'listarAutorizacoes'])->name('autorizacoes');
    Route::get('/autorizacoes', [AutorizacoesController::class, 'index'])->name('autorizacoes');
    Route::post('/salvar-autorizacoes', [AutorizacoesController::class, 'salvarAutorizacoes'])->name('salvar_autorizacoes');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
