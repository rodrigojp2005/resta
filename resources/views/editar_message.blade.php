
<x-app-layout>
    <div class="py-12 flex justify-center items-center ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-center">
                    <h1 class="text-center text-xl font-bold mb-4 m-4 pt-2" style="color:DodgerBlue;">Escreva uma Carta de Amor</h1>
                    <img src="https://media.giphy.com/media/odkJEIraWWWH8D3vsE/giphy.gif" class="w-16 h-16 align-middle" alt="Escrever Carta">
                </div>
                <div class="card">
                    <div class="card-body space-y-4 text-blue-500">
                        <h5 class="card-title"></h5>
                        <form action="{{ route('atualizar_message', ['id' => $messages->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="titulo" class="block font-medium" style="color:DodgerBlue;">Título:</label>
                                <input type="text" name="titulo" id="titulo" class="rounded-lg shadow-sm p-2 w-full" value="{{ $messages->titulo }}" style="color:DodgerBlue;border-color:DodgerBlue;">
                            </div>
                            <div>
                                <label for="texto" class="block font-medium" style="color:DodgerBlue;">Texto:</label>
                                <textarea id="texto" name="texto" class="rounded-lg shadow-sm p-2 w-full h-96" style="color:DodgerBlue;border-color:DodgerBlue">{{ $messages->texto }}</textarea>
                            </div>
                            <button type="submit"  class="w-full mt-4 " style="background-color: Royalblue; display: inline-block; padding: 8px 16px; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">Atualizar</button>
                        </form>
                    </div>
                    <a href="{{ route('dashboard') }}" class="w-full mt-4 bg-gray-500" style="display: inline-block; padding: 8px 16px; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
