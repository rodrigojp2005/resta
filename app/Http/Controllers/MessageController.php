<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    // public function index(, )
    // {
    //     // Lógica para exibir a lista de mensagens entre  e 
    // }

    // public function show()
    // {
    //     // Lógica para exibir os detalhes da mensagem com 
    // }

    // public function store(Request )
    // {
    //     // Lógica para criar uma nova mensagem com base nos dados fornecidos em 
    // }

    // public function destroy()
    // {
    //     // Lógica para excluir a mensagem com 
    // }

    public function index($senderId, $recipientId)
    {
        $messages = Message::where(function ($query) use ($senderId, $recipientId) {
            $query->where('sender_id', $senderId)
                ->where('recipient_id', $recipientId);
        })->orWhere(function ($query) use ($senderId, $recipientId) {
            $query->where('sender_id', $recipientId)
                ->where('recipient_id', $senderId);
        })->get();

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

}
