<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Autorizacao;


class AutorizacoesController extends Controller
{
    //
    public function index()
    {
      // Obtenha o ID do usuário logado
      $userId = Auth::id();
      // Busque apenas as autorizações do usuário logado
      $autorizacoes = Autorizacao::where('Autorizador_id', $userId)->get();
      return view('lista_solicitacoes_autorizacoes', compact('autorizacoes'));

    }

}
