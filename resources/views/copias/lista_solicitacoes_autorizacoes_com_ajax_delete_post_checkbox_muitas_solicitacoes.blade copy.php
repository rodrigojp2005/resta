<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center items-center">
                    <img src="https://media.giphy.com/media/8wnKFbyxNc9MRsvFEe/giphy.gif" class="w-20 h-20 mt-4" alt="Escrever Carta">
                </div>
                <form id="meuFormulario" onsubmit="handleSubmit(event)" action="{{ route('salvar_autorizacoes') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="flex items-center justify-between border-b border-gray-200 p-4 font-bold">
                        <span class="truncate w-1/2 text-left text-gray-600">Nome</span>
                        <span class="w-fulltext-center text-gray-600 mr-8">Autorização</span>
                    </div>
                    @foreach ($autorizacoes as $autorizacao)
                        @if($autorizacao->autorizado_id != Auth::id() && $autorizacao->status !== 'null')
                        <div class="flex items-center justify-between border-b border-gray-200 p-4">
                            <span class="truncate text-left text-gray-600" style="overflow-wrap: break-word;">{{ $autorizacao->autorizado->name }} - {{ $autorizacao->autorizado_id }}</span>
                            <div class="flex items-center mr-8">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" data-user-id="{{ $autorizacao->autorizado_id }}" name="autorizacao[]" value="{{ $autorizacao->status }}-{{ $autorizacao->autorizado_id }}" class="sr-only peer" onchange="handleCheckboxChange(event)"  {{ $autorizacao->status === 'aprovado' ? 'checked' : 'reprovado' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    <!-- <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Autorizar</span> -->
                                </label>
                                <button type="button" class="ml-2 text-gray-500 focus:outline-none" aria-label="Fechar" onclick="deleteRow(this, '{{ $autorizacao->id }}')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @endif 
                    @endforeach
                    <input type="hidden" name="valoresCheckbox" id="valoresCheckbox">
                    <button type="submit" class="w-3/4 mt-4 mb-2 mx-auto block" style="padding: 8px 16px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">
                        Confirmar Acesso
                    </button>
                </form>
                <!-- <a href="{{ route('dashboard') }}" class="w-3/4 mb-4 mx-auto block" style="display: inline-block; padding: 8px 16px; background-color: #6CA6CD; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">Voltar</a> -->
                <a href="{{ route('dashboard') }}" class="w-3/4 mb-4 mx-auto block text-center" style="padding: 8px 16px; background-color: #6CA6CD; color: white; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">Voltar</a>

            </div>
        </div>
    </div>
    <script>

//só remove a linha
        // function hideRow(button) {
        // var row = button.closest('.border-b');
        // row.style.display = 'none';
        // }
// remove a linha e tenta excluir do banco mas nao deu certo
    //     function deleteRow(button, autorizacaoId) {
    //     var row = button.closest('.border-b');
    //     row.style.display = 'none';

    //     // Fazer a chamada AJAX para excluir a linha do banco de dados
    //     var xhr = new XMLHttpRequest();
    //     xhr.open('DELETE', '/autorizacoes/' + autorizacaoId);
    //     xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    //     xhr.send();
    // }

    function deleteRow(button, autorizacaoId) {
    var row = button.closest('.border-b');
    row.style.display = 'none';

    // Fazer a chamada AJAX para excluir a linha do banco de dados
    fetch('/autorizacoes/' + autorizacaoId, {
       // method: 'DELETE',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erro ao atualizar a linha do banco de dados');
        }
    })
    .catch(error => {
        console.error(error);
    });
}


    
    const checkboxValues = [];
    function handleCheckboxChange(event) {
        const checkbox = event.target;
        const isChecked = checkbox.checked;
        const value = isChecked ? "aprovado" : "reprovado";
        const userId = checkbox.getAttribute('data-user-id');
        checkbox.value = value + '-' + userId;
    }

    function handleSubmit(event) {
        event.preventDefault();
            const checkboxes = document.querySelectorAll('#meuFormulario input[type="checkbox"]');
            const valuesArray = Array.from(checkboxes).map(checkbox => checkbox.value);

            // Atualizar o valor do campo de entrada oculto com os valores do array
            const valoresCheckboxInput = document.getElementById('valoresCheckbox');
            valoresCheckboxInput.value = JSON.stringify(valuesArray);

        // Envie o formulário
        event.target.submit();
    }

</script>
</x-app-layout>
