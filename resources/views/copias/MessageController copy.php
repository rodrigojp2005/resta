<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    // public function index($senderId, $recipientId)
    // {
    //     $messages = Message::where(function ($query) use ($senderId, $recipientId) {
    //         $query->where('sender_id', $senderId)
    //             ->where('recipient_id', $recipientId);
    //     })->orWhere(function ($query) use ($senderId, $recipientId) {
    //         $query->where('sender_id', $recipientId)
    //             ->where('recipient_id', $senderId);
    //     })->get();
    // dd($messages);
    //   //  return view('dashboard', compact('messages'));
    //     return view('dashboard', ['messages' => $messages]);

    //     //return view('messages')->with('messages', $messages);
    //     //return response()->json($messages);
    // }

    public function listaMensagens(){
        // $userId = Auth::id();
        // $messages = Message::where('sender_id', $userId)->orWhere('recipient_id', $userId)->get();
        // return view('dashboard', ['messages' => $messages]);
        $userId = Auth::id();
        $messages = Message::join('users', 'messages.sender_id', '=', 'users.id')
                    ->select('messages.*', 'users.name as sender_name')
                    ->where('sender_id', $userId)
                    ->orWhere('recipient_id', $userId)
                    ->get();
       // dd($messages);
        return view('dashboard', ['messages' => $messages]);
        
    }

    public function update(Request $request, $id)
{
    // Encontrar o recurso a ser atualizado com base no ID fornecido
    $recurso = Message::findOrFail($id);
  //  dd($request->all());

    // Aplicar as alterações desejadas nos dados do recurso
//    $recurso->campo1 = $request->input('campo1');
  //  $recurso->campo2 = $request->input('campo2');
    // ...

    // Salvar as alterações no banco de dados
    $recurso->save();

    // Retornar uma resposta adequada, por exemplo, um redirecionamento ou uma resposta JSON
    return response()->json(['message' => 'Recurso atualizado com sucesso']);
}

public function update_recepient(Request $request)
{
    // pega os valores de request e passa pelo json(enconde) para varaiveis correspondentes
//     $messageIds = json_decode($request->messageIds, true);
//     $userId = json_decode($request->userId, true);
//    // dd('Rota update_recepient chamada com sucesso!2');
//    // $messageIds = $request->messageIds;
//     //$userId = $request->userId;
//     // Atualizar a tabela 'messages' com o 'recepient_id' correspondente ao 'user_id'
//     Message::whereIn('id', $messageIds)
//         ->update(['recepient_id' => $userId]);

//    return view('dashboard');
    // Retornar uma resposta adequada para indicar o sucesso da atualização
 //   return response()->json(['message' => 'Recepients updated successfully']);
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
    //dd($id);
    $messages = Message::where('id', $id)->get(['id', 'message']);
    Message::where('id', $id)->update(['lida' => 0]);

   // dd($messages);
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

    public function escreverCarta(){
        return view('message');
    }

    public function rascunho(){
        $userId = Auth::id();        
        $textos = Message::where('user_id', $userId)->get(['id','titulo','texto']);
        //dd($textos);
        // return view('ver_textos', compact('textos'));
        return view('ver_titulos', compact('textos'));
    }

    public function salvarMessage(Request $request)
    {
      //  dd($request->all());
        $user_id = Auth::id();
        $message = new Message();
        $message->sender_id = $user_id;
        $message->titulo = $request->input('titulo');
        $message->texto = $request->input('texto');
        $message->save();
       // dd($message);
       return redirect()->route('edita_envia_message');

        // return redirect()->route('edita_envia');
        // return redirect('/dashboard')->with('titulo', 'Texto salvo com sucesso.');
    }

    public function deletarMessage($id)
    {
        $message = Message::find($id);
        if ($message) {
            $message->delete();
        }
       // return redirect()->route('dashboard');
       return redirect()->route('edita_envia_message');
    }
    
    public function atualizarMessage(Request $request, $id){
       // dd($request->all());
        $message= Message::find($id);
        $message->titulo = $request->input('titulo');
        if ($request->filled('texto')) {
            $message->texto = $request->texto; // Atualizar o texto com o valor enviado pelo formulário
        } else {
            $message->texto = ''; // Definir o texto como uma string vazia
        }
        $message->update();
        return redirect()->route('edita_envia_message');
        //return redirect()->route('dashboard');
    }

    public function editarMessage($id){
        $message = Message::find($id);
        //dd($message);
        return view('editar_message', ['messages' => $message]);
    }


    public function edita_envia_message(){
        $userId = Auth::id();
        $message = Message::where('sender_id', $userId)->get(['id', 'titulo', 'texto']);
      //  dd('consulta',$message);
        return view('edita_envia_message', ['messages' => $message]);
    }

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

      //  dd($titulo, $texto);
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
