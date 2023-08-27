<x-app-layout>
    <div class="py-12">   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="ref" class="overflow-hidden shadow-sm sm:rounded-lg flex flex-col relative">
            <div class="flex justify-center items-center">
                <div class="flex justify-center">
                <div>
                <img src="https://cdn.icon-icons.com/icons2/2416/PNG/512/blossom_branch_floral_florist_flowering_heart_nature_icon_146725.png" class="w-20 h-20 mt-4 transform rotate-180" alt="Escrever Carta">
                </div>
                    <div>
                        <img src="https://media.giphy.com/media/DiLgdeayLSKjrEcqsV/giphy.gif" class="w-20 h-20 mt-4" alt="Escrever Carta">
                    </div>
                </div>
                <div>
                    <img src="https://cdn.icon-icons.com/icons2/2416/PNG/512/blossom_branch_floral_florist_flowering_heart_nature_icon_146725.png" class="w-20 h-20 mt-4" alt="Escrever Carta">
                </div>
            </div>
            <div class="flex justify-center items-center">
                <div class="flex flex-col items-start w-full mt-4 p-2 mx-4">
                <!-- @foreach ($messages as $message) -->
                <div class="flex flex-col justify-between w-full mt-4 p-2 mx-4">
                    <div class="text-left  break-all mb-2" style="overflow-wrap: break-word;font-size: 18px;color:RoyalBlue;font-weight: bold;">
                        De: {{ $message->sender_name }} <!-- {{ $message->sender_id }};-->
                    </div>
                    <div class="text-center mt-4" style="font-size: 18px;color:RoyalBlue;font-weight: bold;">
                        {{ $message->titulo }}
                    </div>
                    <div class="text-center mt-4" style="font-size: 18px;color:RoyalBlue">
                        {{ $message->texto }}
                    </div>
                </div>
                <!-- @endforeach --> 
                <!-- <div class="absolute bottom-0 mb-8 w-full"> -->
                    <div class="w-3/4 mx-auto">
                        <div class="mt-4">
                            <button onclick="window.location.href='{{ route('escrever_carta', ['id' => $message->sender_id]) }}'" class="w-full mb-4 py-2 px-4 bg-blue-500 text-white rounded-md text-center">Responder</button>
                            <button onclick="window.location.href='{{ route('dashboard') }}'" class="w-full py-2 px-4 bg-gray-500 text-white rounded-md text-center">Voltar</button>
                        </div>
                    </div>
                <!-- </div> -->
            
            </div>
            
        </div>
    </div>
    </div>
</x-app-layout>
