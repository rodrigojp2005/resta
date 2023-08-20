<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Texto;

class TextoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function listarTitulos()
    {
        $userId = Auth::id();
        $textos = Texto::where('user_id', $userId)->get(['id', 'titulo']);
        return view('dashboard', ['textos' => $textos]);
    }

    public function verTitulos($id){
        $textos = Texto::where('user_id', $id)->get(['id', 'titulo']);
        return view('ver_titulos', compact('textos'));    
    }

    public function verTextos($id){
        $textos = Texto::where('id', $id)->get(['id', 'texto']);
        return view('ver_textos', compact('textos'));
    }   

    public function salvarTexto(Request $request)
    {
        $texto = new Texto();
        $texto->user_id = $request->user()->id;
        $texto->titulo = $request->input('titulo');
        $texto->texto = $request->input('texto');
        $texto->save();
        
        return redirect('/dashboard')->with('titulo', 'Texto salvo com sucesso.');
    }
        
    public function deletarTexto($id)
    {
        $texto = Texto::find($id);
        if ($texto) {
            $texto->delete();
        }
        return redirect()->route('dashboard');
    }
    
    public function editarTexto($id){
        $texto = Texto::find($id);
        return view('editar_texto', ['textos' => $texto]);
    }

    public function atualizarTexto(Request $request, $id){
        $texto = Texto::find($id);
        $texto->titulo = $request->input('titulo');
        if ($request->filled('texto')) {
            $texto->texto = $request->texto; // Atualizar o texto com o valor enviado pelo formulário
        } else {
            $texto->texto = ''; // Definir o texto como uma string vazia
        }
        $texto->update();
        return redirect()->route('dashboard');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function escreverCarta(){
        return view('texto');
    }
}
