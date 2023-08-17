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

    public function salvarAutorizacoes(Request $request)
    {
      $valores= $request->all();
      
      
      dd($valores);
      
        // foreach ($checkboxValues as $value) {
        //     $userId = $value['userId'];
        //     $status = $value['value'];
        // //  var_dump($userId,$status);
        //     // Salvar no banco de dados
        //     Autorizacao::updateOrCreate(
        //         ['autorizado_id' => $userId],
        //         ['status' => $status]
        //     );
        // }

        return redirect()->route('autorizacoes'); // Redirecionar para onde você desejar após salvar
    }

}
