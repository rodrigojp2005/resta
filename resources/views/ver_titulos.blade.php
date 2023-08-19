<x-app-layout>
    <div class="py-12">   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- <div class="flex justify-center items-center">
                    <div class="flex items-center w-3/4 ">
                        <img src="https://media.giphy.com/media/VFfpZ5bYzMqQGiIHUD/giphy.gif" class="w-20 h-20 mt-4" alt="Escrever Carta">
                        <a href="{{ route('escrever_carta') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-1/2"> Posta Restante</a>
                    </div>
                </div> -->
                <div class="flex justify-center w-full">
                    <table class=" w-3/4">
                            <tbody>
                                @foreach ($textos as $texto)
                                <tr>
                                    <td class="text-right p-2" style="border-bottom: 1px solid lightgray;">
                                        <div class="flex justify-between">
                                            <span class="truncate text-left text-gray-600" style="overflow-wrap: break-word;">
                                                <!-- <a href="#">{{ $texto->titulo }} - {{ $texto->id }} </a>  -->
                                                <a href="{{ route('textos', ['id' => $texto->id]) }}">{{ $texto->titulo }}</a>
                                            </span>
                
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <a href="{{ route('dashboard') }}" class="w-full mt-4" style="display: inline-block; padding: 8px 16px; background-color: #6CA6CD; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">Voltar</a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

