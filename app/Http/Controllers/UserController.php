<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Autorizacao;
use Auth;

class UserController extends Controller
{
    // public function search(Request $request)
    // {
    //     $name = $request->input('name');
    //     //dd($name);
    //     // $name = $request->input('name');
    //     // $results = User::where('name', 'LIKE', '%' . $name . '%')
    //     //             ->select('id', 'name')
    //     //             ->get();
        
    //     // // dd($results->all());
    //     // return view('dashboard', ['results' => $results]);
    //     $userId=Auth::id();
    //     $results = User::join('autorizacoes', 'users.id', '=', 'autorizacoes.autorizado_id')
    //     ->where('users.name', 'LIKE', '%' . $name . '%')
    //     ->select('users.id', 'users.name', 'autorizacoes.status')
    //     ->get();

    //     // dd($results);
    //     return view('dashboard', ['results' => $results]);
    // }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $userId = Auth::id();
        $results = User::leftJoin('autorizacoes', function($join) use ($userId) {
            $join->on('users.id', '=', 'autorizacoes.autorizador_id')
                ->where('autorizacoes.autorizado_id', '=', $userId);
            })
            ->where('users.name', 'LIKE', '%' . $name . '%')
            ->select('users.name', 'users.id','autorizacoes.status', 'autorizacoes.autorizador_id', 'autorizacoes.autorizado_id')
            ->get();
        return view('dashboard', ['results' => $results]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        // Retornar uma view que exiba os detalhes do usuário
        return view('show', ['user' => $user]);
    }

    public function listarAutorizacoes(){
        return view('lista_solicitacoes_autorizacoes');
    }
    
    public function ver_amigos()
    {
        $userId = Auth::id();
        $aprovados = User::leftJoin('autorizacoes', function($join) use ($userId) {
            $join->on('users.id', '=', 'autorizacoes.autorizado_id')
                ->where('autorizacoes.autorizador_id', '=', $userId);
        })
        ->where('autorizacoes.status', '=', 'aprovado')
        ->select('users.name', 'users.id')
        ->get();
        return view('ver_amigos', ['results' => $aprovados]);
    }

}
