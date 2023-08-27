<x-app-layout>
    <div class="py-12">   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white h-screen overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center items-center w-full">
                    <div class="items-center w-full ">
                        <div class="flex justify-center items-center">
                            <img src="https://media.giphy.com/media/ZC3CkcI03G2bWG1P76/giphy.gif" class="w-20 h-20 mt-4" alt="Escrever Carta">
                        </div>
                        <div class="flex justify-center items-center" >
                            <p class=" text-black font-bold py-2 px-4 rounded w-full m-4 text-center" style="color:DodgerBlue;"> Cartas Enviadas</p>
                        </div>                    
                    </div>
                </div>
                <div class="flex justify-center w-full">
                    <!-- <div class="flex flex-col items-center">
                        <img src="https://media.giphy.com/media/UtntwSFHG15eMBBXEJ/giphy.gif" class="w-12 h-20 mt-4" alt="Escrever Carta">
                        <p class="text-center" style="color:DodgerBlue;">Você não escreveu nada ainda.</p>
                    </div>-->
                </div> 
                <div class="flex justify-center w-full">
                    <table class=" w-3/4">
                            <tbody>
                                <tr>
                                    <td class="text-right p-2" style="border-bottom: 1px solid DodgerBlue;">
                                        <div class="flex justify-between">
                                        <input type="radio" style="border-color: DodgerBlue;" name="selectedMessage" value="">
                                            <span class="truncate text-left" style="overflow-wrap: break-word;color:DodgerBlue;"></span>
                                            <div class="flex justify-end">
                                                <a href="" class="inline-block w-8 h-8" ><img src="https://img.icons8.com/?size=512&id=118958&format=png" class="w-8 h-8" alt="Editar"></a>
                                                <a href="" class="inline-block w-8 h-8"><img src="https://cdn-icons-png.flaticon.com/512/4140/4140207.png" class="w-8 h-8" alt="Excluir"></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <div class="p-6 text-gray-900 w-full">
                    <div class="flex justify-center w-full">
                        <form id="searchForm" action="{{ route('search_user') }}" method="GET">
                            <input type="text" name="name" placeholder="Envie para um usuário" class="rounded-lg shadow-sm p-2 bg-blue-100 text-gray-700 hover:bg-yellow-200" style="border-color:DodgerBlue;color:DodgerBlue;">
                            <button type="submit" class="inline-block"><img src="https://img.icons8.com/?size=512&id=12773&format=png" class="w-8 h-8" alt="Pesquisar"></button>
                        </form>
                    </div>
                    <br>
                    <div class="flex justify-center w-full">
                        <ul id="userList"  class="flex flex-wrap justify-between" style="color:DodgerBlue;">     
                        </ul>
                    </div>
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
                    userList.classList.add('flex', 'flex-wrap', 'justify-between'); // Adicione a classe 'justify-between' ao elemento 'ul'


                    userList.innerHTML = ''; // Limpar a lista de usuários antes de adicionar os novos

                    for (let i = 0; i < users.length; i++) {
                        const user = users[i];
                        const listItem = document.createElement('li');
                        listItem.classList.add('flex', 'items-center', 'justify-between'); // Adicione a classe 'flex' e outras classes para alinhamento


                        const userText = document.createTextNode(user.name);
                        listItem.appendChild(userText);
                        listItem.style.width = '100%';

                        const sendButton = document.createElement('button');
                        sendButton.textContent = 'Enviar';
                        sendButton.classList.add('m-2');
                        sendButton.style.display = 'inline-block';
                        sendButton.style.padding = '2px 8px';
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
                            const messageId = selectedMessage ? selectedMessage.value : null;

                            if (!messageId) {
                                Swal.fire({
                                    title: 'Selecione alguma mensagem!',
                                    imageUrl: 'https://media.giphy.com/media/PijzuUzUhm7hcWinGn/giphy.gif',
                                    imageWidth: 200,
                                    imageHeight: 200,
                                    imageAlt: 'Custom image',
                                    confirmButtonText: 'Ok',
                                    confirmButtonColor: '#4285F4'
                                })
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
                                })
                                .then(function(data) {
                                    // Redirecionar para a rota "dashboard"
                                        Swal.fire({
                                        title: 'Mensagem enviada!',
                                        imageUrl: 'https://media.giphy.com/media/PmdxNHDIA898ZFvHxB/giphy.gif',
                                        imageWidth: 200,
                                        imageHeight: 200,
                                        imageAlt: 'Custom image',
                                        confirmButtonText: 'Ok',
                                        confirmButtonColor: '#4285F4',
                                        didClose: () => {
                                            // Redirecionar para a página desejada
                                            window.location.href = "/edita_envia_message";
                                        } 
                                    })
                                    
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