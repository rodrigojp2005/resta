<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Autorizacao;
use App\Models\User;


class AutorizacoesController extends Controller
{
    //
    public function index()
    {
      // Obtenha o ID do usuário logado
      $autorizador = Auth::id();
      $autorizacoes = Autorizacao::join('users', 'autorizacoes.autorizado_id', '=', 'users.id')
      ->where('autorizacoes.autorizador_id', $autorizador)
      ->select('users.name as autorizado_name', 'users.id as autorizado_id')
      ->get();
      return view('lista_solicitacoes_autorizacoes', compact('autorizacoes'));

    }

    public function checkbox_autorizacoes()
    {
      // Obtenha o ID do usuário logado
      $autorizador = Auth::id();
      $autorizacoes = Autorizacao::join('users', 'autorizacoes.autorizado_id', '=', 'users.id')
      ->where('autorizacoes.autorizador_id', $autorizador)
      ->select('users.name as autorizado_name', 'users.id as autorizado_id', 'autorizacoes.status')
      ->get();
      return view('lista_solicitacoes_autorizacoes', compact('autorizacoes'));
    }

    public function salvarAutorizacoes(Request $request)
    {
      $userId = Auth::id(); // Obter o ID do usuário logado
      $valores = $request->input('valoresCheckbox'); // Obter o valor da chave 'valoresCheckbox'
      $valoresArray = json_decode($valores, true);

      $separatedValues = [];
      foreach ($valoresArray as $value) {
          $parts = explode("-", $value);
          $separatedValues[] = [
              'status' => $parts[0], // Parte antes do hífen
              'id' => $parts[1],     // Parte depois do hífen
          ];
      }
  
      foreach ($separatedValues as $value) {
        Autorizacao::where('autorizador_id', $userId)
        ->where('autorizado_id', $value['id'])
        ->update(['status' => $value['status']]);
        }
      return redirect()->route('dashboard'); // Redirecionar para onde você desejar após salvar
    }

    public function enviarSolicitacao(Request $request){
      $userId = Auth::id(); 
      $autorizador = $request->input('id');
      Autorizacao::create([
        'autorizador_id' => $autorizador,
        'autorizado_id' => $userId,
        'status' => 'pendente'
      ]);
      return redirect()->route('dashboard');
    }


    public function enviarSolicitacaoDashboard(Request $request){
      $autorizado = Auth::id(); 
      $autorizador = $request->input('id');
      Autorizacao::create([
        'autorizador_id' => $autorizador,
        'autorizado_id' => $autorizado,
        'status' => 'pendente'
      ]);
      return redirect()->route('dashboard');
    }

    public function destroy(Request $request, $id)
    {
        $autorizacao = Autorizacao::findOrFail($id);
        $autorizacao->delete();
    }

    public function update(Request $request, $id){
    Autorizacao::where('id', $id)->update(['status' => 'null']);
    }

}
