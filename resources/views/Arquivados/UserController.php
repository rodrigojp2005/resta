<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->input('name');

        // Lógica de busca com base no nome do usuário
        // $results = User::where('name', $name)
        //             ->select('id', 'name')
        //             ->get();
        $results = User::where('name', 'LIKE', '%' . $name . '%')
                    ->select('id', 'name')
                    ->get();

        // Exibir os resultados no dd
        // foreach ($results as $result) {
        //     dd($result->name, $result->id);
        // }
        return view('dashboard', ['results' => $results]);

        // Retornar para a página de dashboard com os resultados da busca
        //return view('dashboard', compact('results'));
    }
    // public function search(Request $request)
    // {
    //     $userId = $request->input('user_id');

    //     // Lógica de busca com base no ID do usuário
    //     $results = User::where('id', $userId)
    //                    ->select('id', 'name')
    //                    ->get();

    //     // Exibir os resultados no dd
    //     foreach ($results as $result) {
    //         dd($result->name, $result->id);
    //     }
        
    //     // Retornar para a página de dashboard com os resultados da busca
    //     return view('dashboard', compact('results'));
    // }
    public function show($id)
    {
        // Recuperar o usuário com base no ID
        $user = User::findOrFail($id);

        // Retornar uma view que exiba os detalhes do usuário
        return view('show', ['user' => $user]);
    }
}
