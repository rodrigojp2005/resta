<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{

    public function listaMensagens(){
        $userId = Auth::id();
        // $messages = Message::join('users', 'messages.sender_id', '=', 'users.id')
        //             ->select('messages.*', 'users.name as sender_name')
        //             ->where('sender_id', $userId)
        //             ->orWhere('recipient_id', $userId)
        //             ->get();
       // $messages = Message::where('recipient_id', '=', $userId)->get();
       // dd($messages);
        $messages = Message::where('recipient_id', '=', $userId)->where('arquivadas', '=', null)->get();
        //dd($messages);
        return view('dashboard', ['messages' => $messages]);

    }

    public function update(Request $request, $id)
{
    $recurso = Message::findOrFail($id);
    $recurso->save();
    // Retornar uma resposta adequada, por exemplo, um redirecionamento ou uma resposta JSON
    return response()->json(['message' => 'Recurso atualizado com sucesso']);
}

public function update_recepient(Request $request)
{
    $data = json_decode($request->getContent(), true);
    // Capturar os valores de userId e messageId
    $userId = $data['userId'];
    $messageId = $data['messageId'];
    // Atualizar a tabela 'messages' com os valores capturados
    DB::table('messages')
    ->where('id', $messageId)
    ->update(['recipient_id' => $userId]);
    return response()->json(['success' => true]);
}

public function verMensagens($id){
    // $messages = Message::where('id', $id)->get(['id', 'titulo','texto','sender_id','recipient_id']);
    // Message::where('id', $id)->update(['lida' => 1 ]);
    // return view('ver_mensagens', compact('messages'));
    $messages = Message::join('users', 'messages.sender_id', '=', 'users.id')
                    ->where('messages.id', $id)
                    ->select('messages.id', 'messages.titulo', 'messages.texto', 'messages.sender_id', 'messages.recipient_id', 'users.name as sender_name')
                    ->get();

    Message::where('id', $id)->update(['lida' => 1 ]);

    return view('ver_mensagens', compact('messages'));

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

    public function escreverCarta(){
        return view('message');
    }

    public function rascunho(){
        $userId = Auth::id();
        $textos = Message::where('user_id', $userId)->get(['id','titulo','texto']);
        //$textos = Message::where('user_id', $userId)->get(['id','titulo','texto','arquivadas']);
        return view('ver_titulos', compact('textos'));
    }

    public function arquivadas(){
        $userId = Auth::id();
        $messages = Message::where('recipient_id', $userId)->get(['id','titulo','texto','arquivadas']);
        //$messages = Message::where('recipient_id', $userId)->pluck('arquivadas');
        return view('arquivadas', compact('messages'));
        // $userId = Auth::id();
        // $messages = Message::where('recipient_id', $userId)
        //     ->groupBy('arquivadas')
        //     ->select('arquivadas', DB::raw('count(*) as total'))
        //     ->get();
    //dd( $messages );
        return view('arquivadas', compact('messages'));

    }

    public function restaurar_mensagens(request $request){
        $id = $request->input('id');
        $message = Message::find($id);
        $message->arquivadas = null;
        $message->save();

        return redirect()->route('arquivadas');
    }

    public function ocultar_mensagens(request $request){
        $id = $request->input('id');
        $message = Message::find($id);
        $message->arquivadas = 2;
        $message->save();

        return redirect()->route('arquivadas');
        //return view('arquivadas');
    }


    // public function arquivar_cartas(){
    //     $userId = Auth::id();
    //     Message::where('recipient_id', $userId)->update(['arquivadas' => 1]);
    //     return redirect()->route('dashboard');
    //     //    // $messages = Message::where('recipient_id', $userId)->get();
    // }

    public function arquivar_cartas()
    {
        $userId = Auth::id();
        $messages = Message::where('recipient_id', $userId)->get();

        $messages->each(function ($message) {
            if ($message->arquivadas != 2) {
                $message->arquivadas = 1;
                $message->save();
            }
        });

        return redirect()->route('dashboard');
    }


    // public function arquivar_cartas()
    // {
    //     $userId = Auth::id();
    //     $messages = Message::where('recipient_id', $userId)
    //         ->where('arquivadas', '!=', 2)
    //         ->get();

    //     foreach ($messages as $message) {
    //         $message->arquivadas = 1;
    //         $message->save();
    //     }

    //     return redirect()->route('dashboard');
    // }


    public function enviadas(){
        return view('enviadas');
    }

    public function salvarMessage(Request $request)
    {
        $user_id = Auth::id();
        $message = new Message();
        $message->sender_id = $user_id;
        $message->titulo = $request->input('titulo');
        $message->texto = $request->input('texto');
      //  $message->recipient_id = $request->input('recipient_id');
        $message->save();
        return redirect()->route('edita_envia_message');
    }

    public function responderMessage(Request $request)
    {
//        dd($request->all());
        $user_id = Auth::id();
        $message = new Message();
        $message->sender_id = $user_id;
        $message->titulo = $request->input('titulo');
        $message->texto = $request->input('texto');
        $message->recipient_id = $request->input('recipient_id');
        $message->save();
        return view('dashboard');
        //return redirect()->route('edita_envia_message');
    }

    public function deletarMessage($id)
    {
        $message = Message::find($id);
        if ($message) {
            $message->delete();
        }
        return redirect()->route('edita_envia_message');
    }

    public function atualizarMessage(Request $request, $id){
        $message= Message::find($id);
        $message->titulo = $request->input('titulo');
        if ($request->filled('texto')) {
            $message->texto = $request->texto; // Atualizar o texto com o valor enviado pelo formulário
        } else {
            $message->texto = ''; // Definir o texto como uma string vazia
        }
        $message->update();
        return redirect()->route('edita_envia_message');
    }

    public function editarMessage($id){
        $message = Message::find($id);
        return view('editar_message', ['messages' => $message]);
    }

    public function edita_envia_message(){
        $userId = Auth::id();
        $message = Message::where('sender_id', $userId)->get(['id', 'titulo', 'texto','recipient_id','sender_id']);//incluido sender_id
       // $message = Message::where('sender_id', $userId)->get(['id', 'titulo', 'texto','recipient_id'])->toArray();//incluido sender_id
       // dd($message);
        return view('edita_envia_message', ['messages' => $message]);
    }

    public function redigirTexto(Request $request)
    {
        return view('texto');
    }

    public function salvar(Request $request)
    {
        $titulo = $request->input('titulo');
        $texto = $request->input('texto');
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
        ->select('users.id', 'users.name')
        ->get();
        //dd($results);
        return view('dashboard', compact('results'));
    }
}