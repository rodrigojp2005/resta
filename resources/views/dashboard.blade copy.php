<x-app-layout>
    <div class="py-12">   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white h-screen overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center items-center w-full">
                    <div class="items-center w-full ">
                        <div class="flex justify-center items-center">
                            <img src="https://media.giphy.com/media/tN7eDLPdsfHLPWMjPs/giphy.gif" class="w-20 h-20 mt-4" alt="Escrever Carta">
                        </div>
                        <div class="flex justify-center items-center" >
                            <a href="{{ route('escrever_carta') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full m-4 text-center"> Escreva sua carta</a>
                        </div>                    
                    </div>
                </div>
                <!-- @if (!empty($textos))
                <div class="flex justify-center w-full">
                    <table class=" w-3/4">
                            <tbody>
                                @foreach ($textos as $texto)
                                <tr>
                                    <td class="text-right p-2" style="border-bottom: 1px solid lightgray;">
                                        <div class="flex justify-between">
                                            <span class="truncate text-left text-gray-600" style="overflow-wrap: break-word;">{{ $texto->titulo }} </span>
                                            <div class="flex justify-end">
                                                <a href="{{ route('editar_texto', ['id' => $texto->id]) }}" class="inline-block w-8 h-8" ><img src="https://img.icons8.com/?size=512&id=118958&format=png" class="w-8 h-8" alt="Editar"></a>
                                                <a href="{{ route('deletar_texto', ['id' => $texto->id]) }}" class="inline-block w-8 h-8"><img src="https://img.icons8.com/?size=512&id=102350&format=png" class="w-8 h-8" alt="Excluir"></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>Nenhum título encontrado.</p> 
                @endif
                <div class="p-6 text-gray-900">
                    <div class="flex justify-center w-full">
                        <form action="{{ route('search') }}" method="GET">
                            <input type="text" name="name" placeholder="Procure por um usuário" class="rounded-lg shadow-sm p-2 bg-gray-100 text-gray-700 hover:bg-gray-200">
                            <button type="submit" class="inline-block"><img src="https://img.icons8.com/?size=512&id=12773&format=png" class="w-8 h-8" alt="Pesquisar"></button>
                        </form>
                    </div>
                    <br>
                    @if (isset($results) && $results->count() > 0)
                        <ul class="w-full">
                            @foreach ($results as $result)
                            @if($result->id != Auth::id())
                                <li>
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <div>{{ $result->name }}-{{ $result->id }}</div>
                                        <div>
                                            <form action="{{ route('enviar_solicitacao_dashboard') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $result->id }}">
                                                @if ($result->status == 'pendente')
                                                    <button type="submit" id="btn-solicitar-acesso" class="mt-2" style="display: inline-block; padding: 4px 8px; background-color: #c0c0c0; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;" disabled>Pendente</button>
                                                @elseif ($result->status == null)
                                                    <button type="submit" id="btn-solicitar-acesso" class="mt-2" style="display: inline-block; padding: 4px 8px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">Solicitar Acesso</button>
                                                @elseif ($result->status == 'aprovado')
                                                    <button type="submit" id="btn-solicitar-acesso" class="mt-2" style="display: inline-block; padding: 4px 8px; background-color: #4285F4; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;"><a href="{{ route('titulos', ['id' => $result->id]) }}" class="text-white"> Aprovado</a></button>
                                                @elseif ($result->status == 'reprovado')
                                                <button type="submit" id="btn-solicitar-acesso" class="mt-2" style="display: inline-block; padding: 4px 8px; background-color: #DB4A3B; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;" disabled>Recusado</button>
                                                @else
                                                    <button type="submit" id="btn-solicitar-acesso" class="mt-2" style="display: inline-block; padding: 4px 8px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">Solicitar Acesso</button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @endforeach
                        </ul>
                    @else
                        <p>Nenhum resultado encontrado.</p> 
                    @endif
                </div> -->
            </div>
        </div>
    </div>
</x-app-layout>

