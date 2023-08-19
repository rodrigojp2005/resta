<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Autorizacao;


class AutorizacoesController extends Controller
{
    //
    public function index()
    //public function index($id)
    {
      // Obtenha o ID do usuário logado
      $userId = Auth::id();
      // Busque apenas as autorizações do usuário logado
      // $autorizacoes = Autorizacao::where('Autorizador_id', $userId)->get();
      $autorizacoes = Autorizacao::where('Autorizador_id', $userId)->get();
      //dd($autorizacoes,$userId);
    //$autorizacoes = Autorizacao::where('Autorizador_id', $userId)->pluck('Autorizado_id');
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
       // dd($separatedValues,$userId);
      return redirect()->route('dashboard'); // Redirecionar para onde você desejar após salvar
    }

    public function enviarSolicitacao(Request $request){
      $userId = Auth::id(); 
      //$valores=$request->all();
      $valores = $request->input('id');
      Autorizacao::create([
        'autorizador_id' => $userId,
        'autorizado_id' => $valores,
        // 'autorizador_id' => $valores,
        // 'autorizado_id' => $userId,
        'status' => 'pendente'
      ]);
      return redirect()->route('dashboard');
      //dd('Meu Id: '.$userId,' Id Solicitado: '.$valores);
    }

    // public function amigos(){
    //   return view('ver_amigos');
    // }

    public function destroy(Request $request, $id)
    {
        //dd($id);
        $autorizacao = Autorizacao::findOrFail($id);
       // dd($autorizacao);
        // Realizar qualquer verificação adicional, se necessário

        $autorizacao->delete();

        // Retornar uma resposta adequada, como redirecionar para uma página ou retornar uma resposta JSON
    }

    public function update(Request $request, $id){
    //$autorizacao = Autorizacao::findOrFail($id);
    //$autorizacao->status = null; // Atualiza o campo "status" para null
   // $autorizacao->fill(['status' => null]); // Atualiza o campo "status" para null
    //$autorizacao->save();
    //$autorizacao->update($request->all());
    Autorizacao::where('id', $id)->update(['status' => 'null']);

    }

}
