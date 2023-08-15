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
     // dd($userId);

    // Busque apenas as autorizações do usuário logado
      $autorizacoes = Autorizacao::where('Autorizador_id', $userId)->get();

    //    // dd("Autorizações");
    //    //$autorizacoes = Autorizacao::with(['autorizador', 'autorizado'])->get();
    // //   dd($autorizacoes);
    //     $autorizacoes = Autorizacao::all();
    //  //  dd($autorizacoes);
    //     // $autorizacao = Autorizacao::find(1);
    //      // $autorizador = $autorizacao->autorizador;
    //     // $autorizado = $autorizacao->autorizado;

    //  //   dd($autorizacoes);
    //     // return view('autorizacoes.index', compact('autorizacoes'));
        return view('lista_solicitacoes_autorizacoes', compact('autorizacoes'));

    }

}
