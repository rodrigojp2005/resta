<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index($senderId, $recipientId)
    {
        $messages = Message::where(function ($query) use ($senderId, $recipientId) {
            $query->where('sender_id', $senderId)
                ->where('recipient_id', $recipientId);
        })->orWhere(function ($query) use ($senderId, $recipientId) {
            $query->where('sender_id', $recipientId)
                ->where('recipient_id', $senderId);
        })->get();
        dd($messages);
        //return view('messages')->with('messages', $messages);
        return response()->json($messages);
    }

    public function show($messageId)
    {
        $message = Message::findOrFail($messageId);
    
        return response()->json($message);
    }
    
    public function store(Request $request)
    {
        $message = new Message();
        $message->sender_id = $request->input('sender_id');
        $message->recipient_id = $request->input('recipient_id');
        $message->message = $request->input('message');
        $message->save();

        return response()->json($message, 201);
    }

    public function destroy($messageId)
    {
        $message = Message::findOrFail($messageId);
        $message->delete();

        return response()->json(null, 204);
    }

    // public function search(Request $request)
    // {
    //     $userId = $request->input('user_id');

    //     // Lógica de busca com base no ID do usuário
    //     $results = Message::where('sender_id', $userId)
    //     ->orWhere('recipient_id', $userId)
    //     ->get();
    //     // Retornar a view com os resultados da busca
    //     dd($results);
    //     return view('dashboard', compact('results'));

    //     // return view('search_results', compact('results'));
    // }

    public function redigirTexto(Request $request)
    {
      //  dd("Salvando texto");
        // $texto = $request->input('texto');
        // // Faça o processamento e salvamento do texto aqui

        // $message = new Message;
        // $message->texto = $texto;
        // $message->save();

        // return redirect()->back()->with('texto', 'Texto salvo com sucesso!');
        return view('texto');
    }

    public function salvar(Request $request)
    {
        $titulo = $request->input('titulo');
        $texto = $request->input('texto');

        dd($titulo, $texto);
        // Faça o processamento e salvamento dos dados como desejado

        // Exemplo: Salvar em um banco de dados
        // Se você tiver um modelo correspondente, pode criar uma nova instância do modelo e atribuir os valores dos campos
        // Por exemplo:
        // $seuModelo = new SeuModelo;
        // $seuModelo->titulo = $titulo;
        // $seuModelo->texto = $texto;
        // $seuModelo->save();

        // Exemplo: Salvar em um arquivo
        // Por exemplo:
        // file_put_contents('caminho/para/o/arquivo.txt', "Título: $titulo\nTexto: $texto", FILE_APPEND);

        // Você pode adicionar lógica adicional de acordo com suas necessidades

//        return redirect()->back()->with('success', 'Dados salvos com sucesso!');
    }

    public function search(Request $request)
    {
        $userId = $request->input('user_id');
    
        // Lógica de busca com base no ID do usuário
        $results = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                ->orWhere('recipient_id', $userId);
        })
        ->join('users', function ($join) {
            $join->on('messages.sender_id', '=', 'users.id')
                ->orOn('messages.recipient_id', '=', 'users.id');
        })
      //  ->select('messages.*', 'users.name as user_name')
      ->select('users.id', 'users.name')

        ->get();
        dd($results);
        // Retornar para a página de dashboard com os resultados da busca
        return view('dashboard', compact('results'));
    }
    

}
