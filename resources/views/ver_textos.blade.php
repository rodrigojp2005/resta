<x-app-layout>
    <div class="py-12">   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white h-screen overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center items-center">
                    <img src="https://media.giphy.com/media/VDNDX5BhKKz0YsJkl0/giphy.gif" class="w-20 h-20 mt-4" alt="Escrever Carta">
                </div>
                <div class="flex justify-center w-full">
                    <table class=" w-3/4">
                            <tbody>
                                @foreach ($textos as $texto)
                                <tr>
                                    <td class="text-right p-2" style="border-bottom: 1px solid lightgray;">
                                        <div class="flex justify-between">
                                            <!-- <span class="truncate text-left text-gray-600" style="overflow-wrap: break-word;"> -->
                                            <!-- <span class="truncate text-left text-gray-600" style="overflow-wrap: break-word; word-break: break-word; max-width: 100%;"> -->
                                                <!-- {{ $texto->texto }} -->
                                                <!-- <a href="#">{{ $texto->titulo }} - {{ $texto->id }} </a>  -->
                                                <textarea class="truncate text-left text-gray-600" style="overflow-wrap: break-word; resize: none; border: none; background-color: transparent; width: 100%;" readonly>{{ $texto->texto }}</textarea>
                                            </span>                
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-center">
                        <div class="w-3/4">
                            <button onclick="goBack()" class="w-full mx-auto my-4" style="display: inline-block; padding: 8px 16px; background-color: #6CA6CD; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">Voltar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function goBack() {
        history.back();
    }
</script>