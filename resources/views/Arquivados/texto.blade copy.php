<x-app-layout>
    <div class="py-12 flex justify-center items-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <img src="https://media.giphy.com/media/nGtOFccLzujug/giphy.gif" class="w-full h-full mt-4 align-middle" alt="Escrever Carta">
                <h1 class="text-center text-2xl font-bold mb-4">Escreva sua Carta de Amor</h1>
                <div class="card">
                    <div class="card-body space-y-4">
                        <h5 class="card-title"></h5>
                        <form action="{{ route('salvar') }}" method="POST">
                            @csrf
                            <div>
                                <label for="titulo" class="block font-medium">Título:</label>
                                <input type="text" name="titulo" id="titulo" class="rounded-lg shadow-sm p-2 w-full">
                            </div>
                            <div>
                                <label for="texto" class="block font-medium">Texto:</label>
                                <input type="text" name="texto" id="texto" class="rounded-lg shadow-sm p-2 w-full">
                            </div>
                            <button type="submit" >Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- 
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1>Escreva sua Carta de Amor</h1>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <form action="{{ route('salvar') }}" method="POST">
                            @csrf
                            <div>
                                <label for="titulo">Título:</label>
                                <input type="text" name="titulo" id="titulo">
                            </div>
                            <div>
                                <label for="texto">Texto:</label>
                                <input type="text" name="texto" id="texto">
                            </div>
                            <button type="submit">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> -->