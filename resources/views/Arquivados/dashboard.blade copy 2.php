<x-app-layout>
    <div class="py-12">
    

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <!-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="criarTexto()">Criar Texto</button> -->
                    <!-- <a href="{{ route('redigir_texto') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Escrevar Carta</a> -->
                    <a href="{{ route('escrever_carta') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Escrevar Carta</a>
                </div>
                @if (!empty($textos))
                <!-- <?php foreach ($textos as $id => $titulo) {
    echo $id; // ou faça qualquer outra coisa com o ID
} ?> -->

                    @foreach ($textos as $texto)
                    <!-- <?php dd($texto); ?> -->
                    <tr>
                        <td>{{ $texto }}</td>
                        <td>
                            <form action="{{ route('deletar_texto', ['id' => $titulo]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <p>Nenhum título encontrado.</p>
                @endif

                <h1>{{ session('titulo') }}</h1>
                <div class="p-6 text-gray-900">
                    {{ __("Informe o nome do usuário!") }}
                    <form action="{{ route('search') }}" method="GET">
                        <input type="text" name="name" placeholder="Digite o nome">
                        <input type="submit" value="Pesquisar">
                    </form>
                    <br>
                    @if (isset($results) && $results->count() > 0)
                        <ul>
                            @foreach ($results as $result)
                                <li>{{ $result->name }} -
                                    <a href="{{ route('show', ['id' => $result->id]) }}" class="btn btn-primary">Contatar</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Nenhum resultado encontrado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

