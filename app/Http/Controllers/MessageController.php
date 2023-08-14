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
    public function redigirTexto(Request $request)
    {
        return view('texto');
    }

    public function salvar(Request $request)
    {
        $titulo = $request->input('titulo');
        $texto = $request->input('texto');

        dd($titulo, $texto);
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
