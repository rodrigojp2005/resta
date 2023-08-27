<x-app-layout>
    <div class="py-12">   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white h-screen overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center items-center w-full">
                    <div class="items-center w-full ">
                        <div class="flex justify-center items-center">
                            <img src="https://media.giphy.com/media/tN7eDLPdsfHLPWMjPs/giphy.gif" class="w-20 h-20 mt-4" alt="Escrever Carta">
                        </div>
                @if (!empty($messages))
                <div class="flex justify-center w-full">
                    <table class=" w-3/4">
                            <tbody>
                                @foreach ($messages as $message)
                                <tr>
                                    <td class="text-right p-2" style="border-bottom: 1px solid lightgray;">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('textos', ['id' => $message->id]) }}">
                                            <img src="https://media.giphy.com/media/cJHAJn3dPZlpTFjDV0/giphy.gif" class="w-12 h-12 mt-2" alt="Escrever Carta">
                                        </a>
                                        <!-- <a href="{{ route('textos', ['id' => $message->id]) }}">
                                            <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExa291aDAyYWd3ZHQyNXhvZ3R1a2plcWdvbTdjamhncHF6OHlrbndmOCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/CO0T4PKoX9xfPD0wMY/giphy.gif" class="w-12 h-12 mt-2" alt="Escrever Carta">
                                        </a> -->
                                        <!-- <p class="text-right truncate text-gray-600" style="overflow-wrap: break-word;">{{ $message->sender->name }}</p> -->
                                    </div>
                                        <!-- <div class="flex justify-between">
                                            <span class="truncate text-left text-gray-600" style="overflow-wrap: break-word;">{{ $message->message }} </span>
                                            <div class="flex justify-end">
                                                <a href="{{ route('editar_texto', ['id' => $message->id]) }}" class="inline-block w-8 h-8" ><img src="https://img.icons8.com/?size=512&id=118958&format=png" class="w-8 h-8" alt="Editar"></a>
                                                <a href="{{ route('deletar_texto', ['id' => $message->id]) }}" class="inline-block w-8 h-8"><img src="https://img.icons8.com/?size=512&id=102350&format=png" class="w-8 h-8" alt="Excluir"></a>
                                            </div>
                                        </div> -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                <p>Você não possui cartas de amor recbidas.</p>
                @endif
                        <div class="flex justify-center items-center" >
                            <a href="{{ route('escrever_carta') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full m-4 text-center"> Escreva sua carta</a>
                        </div>                    
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

