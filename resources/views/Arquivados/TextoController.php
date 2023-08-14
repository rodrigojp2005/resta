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
        // $titulos = Texto::pluck('titulo')->all();
        // dd($titulos);
        // return view('dashboard', ['titulos' => $titulos]);
        $userId = Auth::id();
     //   $textos = Texto::where('user_id', $userId)->pluck('titulo')->toArray();
    //    $textos = Texto::where('user_id', $userId)->pluck('titulo', 'id')->toArray();
        $textos = Texto::where('user_id', $userId)->get(['id', 'titulo']);

       //dd($textos);
        return view('dashboard', ['textos' => $textos]);
    }
    

    public function salvar(Request $request)
    {
        $texto = new Texto();
        $texto->user_id = $request->user()->id;
        $texto->titulo = $request->input('titulo');
        $texto->texto = $request->input('texto');
        $texto->save();
    
       // Faça qualquer outra lógica necessária
    
       // return response()->json(['message' => 'Texto salvo com sucesso.']);
    //return redirect('/dashboard')->with('titulo', $texto->titulo);
    return redirect('/dashboard')->with('titulo', 'Texto salvo com sucesso.');

    }
    
//      public function salvar(Request $request)
//     {
//         $titulo = $request->input('titulo');
//         $texto = $request->input('texto');
//         $texto->user_id = $request->user()->id;
//         $texto->save();

//         dd($titulo, $texto);
//         // Faça o processamento e salvamento dos dados como desejado

//         // Exemplo: Salvar em um banco de dados
//         // Se você tiver um modelo correspondente, pode criar uma nova instância do modelo e atribuir os valores dos campos
//         // Por exemplo:
//         // $seuModelo = new SeuModelo;
//         // $seuModelo->titulo = $titulo;
//         // $seuModelo->texto = $texto;
//         // $seuModelo->save();

//         // Exemplo: Salvar em um arquivo
//         // Por exemplo:
//         // file_put_contents('caminho/para/o/arquivo.txt', "Título: $titulo\nTexto: $texto", FILE_APPEND);

//         // Você pode adicionar lógica adicional de acordo com suas necessidades

// //        return redirect()->back()->with('success', 'Dados salvos com sucesso!');
//     }

    public function salvarTexto(Request $request)
    {
        $texto = Texto::create([
            'user_id' => $request->user()->id,
            'titulo' => $request->input('titulo'),
            'texto' => $request->input('texto'),
        ]);
    
         // Faça qualquer outra lógica necessária
    
        return response()->json(['message' => 'Texto salvo com sucesso.']);
    }
    

    public function deletarTexto($id)
    {
        //$texto = Texto::where('titulo', $titulo)->first();
        $texto = Texto::find($id);

        if ($texto) {
            $texto->delete();
        }

        return redirect()->route('dashboard');

    }
    
    public function editarTexto($id){
        $texto = Texto::find($id);
       // dd($texto);
        return view('editar_texto', ['textos' => $texto]);
    }

    public function atualizarTexto(Request $request, $id){
       // dd($id);
        //dd($request->all());

        $texto = Texto::find($id);
        $texto->titulo = $request->input('titulo');
        if ($request->filled('texto')) {
            $texto->texto = $request->texto; // Atualizar o texto com o valor enviado pelo formulário
        } else {
            $texto->texto = ''; // Definir o texto como uma string vazia
        }
    
       // $texto->texto = $request->input('texto');
    //    dd($texto);
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
