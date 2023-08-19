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
                $join->on('users.id', '=', 'autorizacoes.autorizado_id')
                    ->where('autorizacoes.autorizador_id', '=', $userId);
            })
            ->where('users.name', 'LIKE', '%' . $name . '%')
            ->select('users.name', 'users.id', 'autorizacoes.status', 'autorizacoes.autorizador_id', 'autorizacoes.autorizado_id')
            ->get();
        //dd($results);

        return view('dashboard', ['results' => $results]);
    }

    public function show($id)
    {
        // Recuperar o usuário com base no ID
        $user = User::findOrFail($id);

        // Retornar uma view que exiba os detalhes do usuário
        return view('show', ['user' => $user]);
    }

    public function listarAutorizacoes(){
        // consulta tabela de autorizações:
        return view('lista_solicitacoes_autorizacoes');
    }

    // public function ver_amigos(Request $request)
    public function ver_amigos()
    {
        //dd($request->all());
        //$name = $request->input('name');
        $userId = Auth::id();

        // $results = User::leftJoin('autorizacoes', function($join) use ($userId) {
        //         $join->on('users.id', '=', 'autorizacoes.autorizado_id')
        //             ->where('autorizacoes.autorizador_id', '=', $userId);
        //     })
        //     ->where('users.name', 'LIKE', '%' . $name . '%')
        //     ->select('users.name', 'users.id', 'autorizacoes.status', 'autorizacoes.autorizador_id', 'autorizacoes.autorizado_id')
        //     ->get();
        //dd($results);
        // $aprovados = User::leftJoin('autorizacoes', function($join) use ($userId) {
        //          $join->on('users.id', '=', 'autorizacoes.autorizado_id')
        //              ->where('autorizacoes.autorizador_id', '=', $userId);
        //      })
        //      ->select('users.name', 'users.id', 'autorizacoes.status', 'autorizacoes.autorizador_id', 'autorizacoes.autorizado_id')
        //      ->get();
        $aprovados = User::leftJoin('autorizacoes', function($join) use ($userId) {
            $join->on('users.id', '=', 'autorizacoes.autorizado_id')
                ->where('autorizacoes.autorizador_id', '=', $userId);
        })
        ->where('autorizacoes.status', '=', 'aprovado')
        ->select('users.name', 'users.id')
        ->get();
        //dd($aprovados);

        return view('ver_amigos', ['results' => $aprovados]);
    }

}
