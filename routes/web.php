<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TextoController;
use App\Http\Controllers\AutorizacoesController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
   // return view('welcome');
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    //EXEMPLO DE ROTA::Solicitações HTTP:GET, POST, PUT, DELETE('Endereço na URL', [nomeDoController::class, 'metodo'])->nomeDaRota ou apelido
    //ROTAS PARA O USUÁRIO
    Route::get('/search', [UserController::class, 'search'])->name('search');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('show'); 
    // ROTAS PARA O TEXTO
    Route::get('/dashboard', [TextoController::class, 'listarTitulos'])->name('dashboard');
    Route::get('/ver_titulos/{id}', [TextoController::class, 'verTitulos'])->name('titulos');
    Route::get('/ver_textos/{id}', [TextoController::class, 'verTextos'])->name('textos');
    Route::get('/escrever_carta', [TextoController::class, 'escreverCarta'])->name('escrever_carta');
    Route::post('/salvar', [TextoController::class, 'salvarTexto'])->name('salvar_texto');
    Route::get('/texto/{id}', [TextoController::class, 'deletarTexto'])->name('deletar_texto');
    Route::get('/texto/{id}/editar', [TextoController::class, 'editarTexto'])->name('editar_texto');
    Route::put('/texto/{id}/atualizar', [TextoController::class, 'atualizarTexto'])->name('atualizar_texto');
    //ROTAS PARA AUTORIZAÇÕES
    Route::get('/autorizacoes', [AutorizacoesController::class, 'index'])->name('autorizacoes');
    Route::get('/autorizacoes', [AutorizacoesController::class, 'checkbox_autorizacoes'])->name('checkbox_autorizacoes');
    Route::post('/salvar-autorizacoes', [AutorizacoesController::class, 'salvarAutorizacoes'])->name('salvar_autorizacoes');
    Route::post('/enviar-solicitacao', [AutorizacoesController::class, 'enviarSolicitacao'])->name('enviar_solicitacao');
    Route::post('/enviar-solicitacao-dashboard', [AutorizacoesController::class, 'enviarSolicitacaoDashboard'])->name('enviar_solicitacao_dashboard');
    Route::delete('/autorizacoes/{id}', [AutorizacoesController::class, 'destroy']);//->name('autorizacoes.destroy'); //não está em uso pq retirei a página que usaria essa fnção do ajax
    Route::post('/autorizacoes/{id}', [AutorizacoesController::class, 'update']);//->name('autorizacoes.destroy');//não está em uso pq retirei a página que usaria essa fnção do ajax
    // ROTAS PARA AMIGOS
    Route::get('/ver_amigos', [UserController::class, 'ver_amigos'])->name('amigos');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
