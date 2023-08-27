<x-app-layout>
    <div class="py-12">   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white h-screen overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center items-center w-full">
                    <div class="items-center w-full ">
                        <div class="flex justify-center items-center">
                            <img src="https://media.giphy.com/media/hQ5YTKrPtyCdkN75mj/giphy.gif" class="w-14 h-20 mt-4" alt="Escrever Carta">
                        </div>
                        <div class="flex justify-center items-center" >
                            <p class=" text-black font-bold py-2 px-4 rounded w-full m-4 text-center" style="color:DodgerBlue;"> Cartas Arquivadas</p>
                        </div>                    
                    </div>
                </div>
                <div class="flex justify-center w-full">
                @if ($messages->isEmpty())
                    <div class="flex justify-center w-full">
                        <div class="flex flex-col items-center">
                            <img src="https://media.giphy.com/media/UtntwSFHG15eMBBXEJ/giphy.gif" class="w-12 h-20 mt-4" alt="Escrever Carta">
                            <p class="text-center" style="color:DodgerBlue;">Você não tem nada arquivado.</p>
                        </div>
                    </div>
                @else
                <div class="flex justify-center w-full">
                    <table class=" w-3/4">
                        <tbody>
                    @foreach ($messages as $message)
                        @if ($message->arquivadas == 1)
                            <tr>
                                <td class="text-right p-2" style="border-bottom: 1px solid DodgerBlue;">
                                    <div class="flex justify-between">
                                    <!-- <input type="radio" style="border-color: DodgerBlue;" name="selectedMessage" value=""> -->
                                        <span class="truncate text-left" style="overflow-wrap: break-word;color:DodgerBlue;">
                                            {{ $message->titulo }}
                                            <!-- <a href="{{ route('ver_mensagens', ['id' => $message->id]) }}">{{ $message->titulo }}</a> -->
                                        </span>
                                        <div class="flex justify-end">
                                            <!-- <a href="" class="inline-block w-8 h-8" ><img src="https://img.icons8.com/?size=512&id=104300&format=png" class="w-8 h-8" alt="Restaurar"></a>
                                            <a href="" class="inline-block w-8 h-8"><img src="https://cdn-icons-png.flaticon.com/512/4140/4140207.png" class="w-8 h-8" alt="ocultar"></a> -->
                                            <a href="{{ route('restaurar_mensagem', ['id' => $message->id]) }}" class="inline-block w-8 h-8" ><img src="https://img.icons8.com/?size=512&id=104300&format=png" class="w-8 h-8" alt="Restaurar"></a>
                                            <a href="{{ route('ocultar_mensagem', ['id' => $message->id]) }}" class="inline-block w-8 h-8"><img src="https://img.icons8.com/?size=512&id=102350&format=png" class="w-8 h-8" alt="Ocultar"></a>
                                            <!-- <a href="{{ route('ocultar_mensagem', ['id' => $message->id]) }}" class="inline-block w-8 h-8"><img src="https://cdn-icons-png.flaticon.com/512/4140/4140207.png" class="w-8 h-8" alt="Ocultar"></a> -->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <!-- Código para exibir mensagens arquivadas -->
                        @else
                            <!-- Código para exibir mensagens não arquivadas -->
                        @endif
                    @endforeach
                    </tbody>
                    </table>
                </div>
                    
                @endif
                </div> 
            </div>
        </div>
    </div>
</x-app-layout>