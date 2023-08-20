
<x-app-layout>
    <div class="py-12 flex justify-center items-center ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <img src="https://media.giphy.com/media/nGtOFccLzujug/giphy.gif" class="w-full h-full mt-4 align-middle" alt="Escrever Carta">
                <h1 class="text-center text-xl font-bold mb-4 text-gray-500">Escreva sua Carta de Amor</h1>
                <div class="card">
                    <div class="card-body space-y-4 text-gray-500">
                        <h5 class="card-title"></h5>
                        <form action="{{ route('atualizar_texto', ['id' => $textos->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="titulo" class="block font-medium">Título:</label>
                                <input type="text" name="titulo" id="titulo" class="rounded-lg shadow-sm p-2 w-full" value="{{ $textos->titulo }}">
                            </div>
                            <div>
                                <label for="texto" class="block font-medium">Texto:</label>
                                <textarea id="texto" name="texto" class="rounded-lg shadow-sm p-2 w-full">{{ $textos->texto }}</textarea>
                            </div>
                            <button type="submit"  class="w-full mt-4" style="display: inline-block; padding: 8px 16px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">Atualizar</button>
                        </form>
                    </div>
                    <a href="{{ route('dashboard') }}" class="w-full mt-4" style="display: inline-block; padding: 8px 16px; background-color: #6CA6CD; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
