<x-app-layout>
    <div class="py-12">   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white h-screen overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center items-center w-full">
                    <div class="items-center w-full ">
                        <div class="flex justify-center items-center">
                            <img src="https://media.giphy.com/media/Vl2bfaJZ9lwh3tu6he/giphy.gif" class="w-20 h-20 mt-4" alt="Escrever Carta">
                        </div>
                        <div class="flex justify-center items-center" >
                            <p class=" text-black font-bold py-2 px-4 rounded w-full m-4 text-center"> Seus Rascunhos ...</p>
                        </div>                    
                    </div>
                </div>
                @if (!empty($messages))
                <div class="flex justify-center w-full">
                    <table class=" w-3/4">
                            <tbody>
                                @foreach ($messages as $message)
                                <tr>
                                    <td class="text-right p-2" style="border-bottom: 1px solid lightgray;">
                                        <div class="flex justify-between">
                                        <!-- <input type="checkbox" name="selectedMessages[]" value="{{ $message->id }}" class="inline-block w-8 h-8"> -->
                                        <input type="radio" name="selectedMessage" value="{{ $message->id }}">
                                            <span class="truncate text-left text-gray-600" style="overflow-wrap: break-word;">{{ $message->titulo }} </span>
                                            <div class="flex justify-end">
                                                <a href="{{ route('editar_message', ['id' => $message->id]) }}" class="inline-block w-8 h-8" ><img src="https://img.icons8.com/?size=512&id=118958&format=png" class="w-8 h-8" alt="Editar"></a>
                                                <a href="{{ route('deletar_message', ['id' => $message->id]) }}" class="inline-block w-8 h-8"><img src="https://img.icons8.com/?size=512&id=102350&format=png" class="w-8 h-8" alt="Excluir"></a>
                                                <!-- <a href="#" class="inline-block w-8 h-8"><img src="https://img.icons8.com/?size=512&id=32555&format=png" class="w-8 h-8" alt="Enviar"></a> -->
                                                <!-- <input type="checkbox" name="selectedMessages[]" value="{{ $message->id }}" class="inline-block w-8 h-8"> -->
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>Nenhum título encontrado.</p> 
                @endif
                <div class="p-6 text-gray-900 w-full">
                    <div class="flex justify-center w-full">
                        <form id="searchForm" action="{{ route('search_user') }}" method="GET">
                            <input type="text" name="name" placeholder="Procure por um usuário" class="rounded-lg shadow-sm p-2 bg-gray-100 text-gray-700 hover:bg-gray-200">
                            <button type="submit" class="inline-block"><img src="https://img.icons8.com/?size=512&id=12773&format=png" class="w-8 h-8" alt="Pesquisar"></button>
                        </form>
                    </div>
                    <br>
                    <ul id="userList">
                        
                    </ul> 
                </div> 
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('searchForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(form);

            fetch(form.action + '?' + new URLSearchParams(formData))
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    const users = data.users;
                    const userList = document.getElementById('userList');

                    userList.innerHTML = ''; // Limpar a lista de usuários antes de adicionar os novos

                    for (let i = 0; i < users.length; i++) {
                        const user = users[i];
                        const listItem = document.createElement('li');
                        const userText = document.createTextNode(user.name);
                        listItem.appendChild(userText);

                        const sendButton = document.createElement('button');
                        sendButton.textContent = 'Enviar';
                        sendButton.classList.add('m-4', 'justify-center', 'text-center');
                        sendButton.style.display = 'inline-block';
                        sendButton.style.padding = '4px 8px';
                        sendButton.style.backgroundColor = '#4285F4';
                        sendButton.style.color = 'white';
                        sendButton.style.textAlign = 'center';
                        sendButton.style.textDecoration = 'none';
                        sendButton.style.border = 'none';
                        sendButton.style.borderRadius = '4px';
                        sendButton.style.cursor = 'pointer'
                        sendButton.addEventListener('click', function() {
                            const userId = user.id; // ID do usuário
                            const userName = user.name; // Nome do usuário
                            const selectedMessage = document.querySelector('input[name="selectedMessage"]:checked');
                            const messageId = selectedMessage.value;

                            if (!messageId) {
                                alert('Selecione uma mensagem');
                            } else {
                                const payload = {
                                    userId: userId,
                                    messageId: messageId
                                };

                                fetch('/update_recepient', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Certifique-se de substituir '{{ csrf_token() }}' com o valor correto para o token CSRF no Laravel
                                    },
                                    body: JSON.stringify(payload)
                                })
                                .then(function(response) {
                                    console.log(JSON.stringify(payload));
                                    alert(response.status);
                                //    alert('Rota update_recepient chamada com sucesso!');
                                    
                                    return response.json();
                                })
                                .then(function(data) {
                                    // Lógica de manipulação da resposta do controller
                                })
                                .catch(function(error) {
                                    console.log(error);
                                });
                            }
                        });


                        listItem.appendChild(sendButton);
                        userList.appendChild(listItem);
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        });
    });
</script>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('searchForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(form);

            fetch(form.action + '?' + new URLSearchParams(formData))
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    const users = data.users;
                    const userList = document.getElementById('userList');

                    userList.innerHTML = ''; // Limpar a lista de usuários antes de adicionar os novos

                    for (let i = 0; i < users.length; i++) {
                        const user = users[i];
                        const listItem = document.createElement('li');
                        const userText = document.createTextNode(user.name);
                        listItem.appendChild(userText);

                        const sendButton = document.createElement('button');
                        sendButton.textContent = 'Enviar';
                        sendButton.classList.add('m-4', 'justify-center', 'text-center');
                        sendButton.style.display = 'inline-block';
                        sendButton.style.padding = '4px 8px';
                        sendButton.style.backgroundColor = '#4285F4';
                        sendButton.style.color = 'white';
                        sendButton.style.textAlign = 'center';
                        sendButton.style.textDecoration = 'none';
                        sendButton.style.border = 'none';
                        sendButton.style.borderRadius = '4px';
                        sendButton.style.cursor = 'pointer'
                        sendButton.addEventListener('click', function() {
                            const userId = user.id; // ID do usuário
                            const userName = user.name; // Nome do usuário
                            const selectedMessages = document.querySelectorAll('input[name="selectedMessages[]"]:checked');
                            const messageIds = Array.from(selectedMessages).map(function(checkbox) {
                                return checkbox.value;
                            });

                            if (messageIds.length === 0) {
                                alert('Selecione pelo menos uma mensagem');
                            } else {
                                const payload = {
                                    userId: userId,
                                    messageIds: messageIds
                                };

                                fetch('/update_recepient', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                          'X-CSRF-TOKEN': '{{ csrf_token() }}' // Certifique-se de substituir '{{ csrf_token() }}' com o valor correto para o token CSRF no Laravel

                                    },
                                    body: JSON.stringify(payload)
                                })
                                    .then(function(response) {
                                        console.log(JSON.stringify(payload));
                                        alert(response.status);
                                        alert('Rota update_recepient chamada com sucesso!');

                                        return response.json();
                                    })
                                    .then(function(data) {
                                        // Lógica de manipulação da resposta do controller
                                    })
                                    .catch(function(error) {
                                        console.log(error);
                                    });
                            }
                        });

                        listItem.appendChild(sendButton);
                        userList.appendChild(listItem);
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        });
    });
</script> -->

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('searchForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(form);

            fetch(form.action + '?' + new URLSearchParams(formData))
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    const users = data.users;
                    const userList = document.getElementById('userList');

                    userList.innerHTML = ''; // Limpar a lista de usuários antes de adicionar os novos

                    for (let i = 0; i < users.length; i++) {
                        const user = users[i];
                        const listItem = document.createElement('li');
                        // const userText = document.createTextNode('ID: ' + user.id + ' - Nome: ' + user.name);
                        const userText = document.createTextNode(user.name);
                        listItem.appendChild(userText);

                        const sendButton = document.createElement('button');
                        sendButton.textContent = 'Enviar';
                        sendButton.classList.add('m-4','justify-center','text-center');
                        sendButton.style.display = 'inline-block';
                        sendButton.style.padding = '4px 8px';
                        sendButton.style.backgroundColor = '#4285F4';
                        sendButton.style.color = 'white';
                        sendButton.style.textAlign = 'center';
                        sendButton.style.textDecoration = 'none';
                        sendButton.style.border = 'none';
                        sendButton.style.borderRadius = '4px';
                        sendButton.style.cursor = 'pointer'
                        sendButton.addEventListener('click', function() {
                            // Lógica para enviar a solicitação aqui
                            // Você pode acessar o ID do usuário usando user.id
                            const userId = user.id; // ID do usuário
                            const userName = user.name; // Nome do usuário
                            const selectedMessages = document.querySelectorAll('input[name="selectedMessages[]"]:checked');
                            const messageIds = Array.from(selectedMessages).map(function(checkbox) {
                                return checkbox.value;
                            });
                            if(messageIds.length == 0){
                                alert('Selecione pelo menos uma mensagem');
                            }else{
                              //  alert('ID do usuário: ' + userId + '\nNome do usuário: ' + userName + '\nIDs das mensagens selecionadas: ' + messageIds.join(', '));
                                
                            }
                        });

                        listItem.appendChild(sendButton);
                        userList.appendChild(listItem);
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        });
    });
</script> -->

<!-- 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('searchForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(form);

            fetch(form.action + '?' + new URLSearchParams(formData))
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    const users = data.users;
                    const userList = document.getElementById('userList');

                    userList.innerHTML = ''; // Limpar a lista de usuários antes de adicionar os novos

                    for (let i = 0; i < users.length; i++) {
                        const user = users[i];
                        const listItem = document.createElement('li');
                        const userText = document.createTextNode('ID: ' + user.id + ' - Nome: ' + user.name);
                        listItem.appendChild(userText);

                        const sendButton = document.createElement('button');
                        sendButton.textContent = 'Enviar';
                        sendButton.classList.add('m-4');
                        sendButton.style.display = 'inline-block';
                        sendButton.style.padding = '4px 8px';
                        sendButton.style.backgroundColor = '#4285F4';
                        sendButton.style.color = 'white';
                        sendButton.style.textAlign = 'center';
                        sendButton.style.textDecoration = 'none';
                        sendButton.style.border = 'none';
                        sendButton.style.borderRadius = '4px';
                        sendButton.style.cursor = 'pointer'
                        sendButton.addEventListener('click', function() {
                            // Lógica para enviar a solicitação aqui
                            // Você pode acessar o ID do usuário usando user.id
                            const userId = user.id; // ID do usuário
                            const userName = user.name; // Nome do usuário
                            const messageId = message.id; // ID da mensagem

                            alert('ID do usuário: ' + userId + '\nNome do usuário: ' + userName + '\nID da mensagem: ' + messageId);
                        });

                        listItem.appendChild(sendButton);
                        userList.appendChild(listItem);
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        });
    });
</script> -->