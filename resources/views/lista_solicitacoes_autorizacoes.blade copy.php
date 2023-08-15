<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form   action="{{ route('autorizacoes') }}" method="POST">
                    @csrf
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
    const checkboxValues = [];

    function handleCheckboxChange(event) {
        const checkbox = event.target;
        const isChecked = checkbox.checked;
        //const value = checkbox.value;
        const value = isChecked ? "aprovado" : "reprovado";
        
        checkboxValues.push(value);
        
        console.clear();
        console.log("Checkbox value:", value);
      //  console.log("Checkbox checked:", isChecked);
        console.log("ID do usuário:", checkbox.dataset.userId);
        console.log("Checkbox values:", checkboxValues);
        
        // if (isChecked) {
        //     // Adicionar o valor ao array se o checkbox estiver marcado
        //     checkboxValues.push(value);
        // } else {
        //     // Remover o valor do array se o checkbox estiver desmarcado
        //     const index = checkboxValues.indexOf(value);
        //     if (index !== -1) {
        //         checkboxValues.splice(index, 1);
        //     }
        // }
       // console.log(checkboxValues);
    }
</script>
</x-app-layout>
