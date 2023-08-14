<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TextoController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/redigir_texto', [MessageController::class, 'redigirTexto'])->name('redigir_texto');
    Route::post('/salvar', [MessageController::class, 'salvar'])->name('salvar');
    Route::get('/dashboard', [TextoController::class, 'listarTitulos'])->name('dashboard');
    // Nova rota de pesquisa
    Route::get('/search', [UserController::class, 'search'])->name('search');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('show'); 
    // escrever carta
    Route::get('/escrever_carta', [TextoController::class, 'escreverCarta'])->name('escrever_carta');
    Route::post('/salvar', [TextoController::class, 'salvar'])->name('salvar');
    Route::get('/texto/{id}', [TextoController::class, 'deletarTexto'])->name('deletar_texto');
    Route::get('/texto/{id}/editar', [TextoController::class, 'editarTexto'])->name('editar_texto');
    Route::put('/texto/{id}/atualizar', [TextoController::class, 'atualizarTexto'])->name('atualizar_texto');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
