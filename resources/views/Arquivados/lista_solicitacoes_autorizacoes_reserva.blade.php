<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- <form   action="{{ route('autorizacoes') }}" method="POST"> -->
                <form id="meuFormulario" action="{{ route('autorizacoes_update', $autorizacoes->first()->autorizador_id) }}" method="POST" onsubmit="handleSubmit(event)">
                    @csrf
                    @method('PUT')
                    @foreach ($autorizacoes as $autorizacao)
                        <div class="flex items-center justify-between border-b border-gray-200 p-4">
                            <span class="truncate text-left text-gray-600" style="overflow-wrap: break-word;">{{ $autorizacao->autorizado->name }} - {{ $autorizacao->autorizado_id }}</span>
                            <div class="flex items-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" data-user-id="{{ $autorizacao->autorizado_id }}" name="autorizacao[]" value="{{ $autorizacao->status }}" class="sr-only peer" onchange="handleCheckboxChange(event)"  {{ $autorizacao->status === 'aprovado' ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Autorizar</span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                    <button type="submit" class="w-3/4 m-4 mx-auto block" style="padding: 8px 16px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">
                        Confirmar Acesso
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>

    //const checkboxValues = [];
    const checkboxValues = {};
    function handleCheckboxChange(event) {
       // const id_user = event.target.dataset.userId;
        const checkbox = event.target;
        const isChecked = checkbox.checked;
        const value = isChecked ? "aprovado" : "reprovado";
       // const index = checkboxValues.indexOf(value);
        //checkboxValues[userId] = value;
        //console.log("Checkbox values:", checkboxValues);
        checkbox.value = value; //??
        //console.log("Checkbox value:", value);
    }

    function handleSubmit(event) {
        event.preventDefault();

        // Verificar o estado de todos os checkboxes
        var checkboxes = document.querySelectorAll('#meuFormulario input[type="checkbox"]');
  //      var checkboxValues = [];

        // checkboxes.forEach(function(checkbox) {
        //     var value = checkbox.value;
        //     var checked = checkbox.checked;
        //     var userId = checkbox.dataset.userId;

        //     checkboxValues.push({
        //         userId: userId,
        //         value: value,
        //         checked: checked
        //     });
        // });

        // Exibir os resultados em um alerta ou elemento HTML
        // checkboxValues.forEach(function(obj) {
        //     console.log('ID do usuário:', obj.userId);
        //     console.log('Valor do checkbox:', obj.value);
        //    // console.log('Marcado:', obj.checked);
        // });

        fetch(event.target.action, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
            body: JSON.stringify(checkboxValues)
        })
        .then(response => {
            // Tratar a resposta da requisição
        })
        .catch(error => {
            // Tratar erros da requisição
        });
            // Envie o formulário
     //       event.target.submit();
    }
</script>
</x-app-layout>
