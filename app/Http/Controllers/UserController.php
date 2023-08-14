<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->input('name');
        $results = User::where('name', 'LIKE', '%' . $name . '%')
                    ->select('id', 'name')
                    ->get();
        return view('dashboard', ['results' => $results]);
    }
    public function show($id)
    {
        // Recuperar o usuário com base no ID
        $user = User::findOrFail($id);

        // Retornar uma view que exiba os detalhes do usuário
        return view('show', ['user' => $user]);
    }
}
