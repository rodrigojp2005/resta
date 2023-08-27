<x-app-layout>
    <div class="py-12 flex justify-center items-center ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 ">
                <div class="flex items-center justify-center">
                    <h1 class="text-center text-xl font-bold mb-4 text-gray-500 m-4 pt-2" style="color:blue;">Escreva sua Carta de Amor</h1>
                    <img src="https://media.giphy.com/media/odkJEIraWWWH8D3vsE/giphy.gif" class="w-16 h-16 align-middle" alt="Escrever Carta">
                </div>
                <div class="card">
                    <div class="card-body space-y-4 text-gray-500">
                        <h5 class="card-title"></h5>
                        <form action="{{ route('salvar_message') }}" method="POST">
                            @csrf
                            <!-- <p> De:{{ Auth::user()->name }} </p> -->
                            <div>
                                <label for="titulo" class="block font-medium">Título:</label>
                                <input type="text" name="titulo" id="titulo" class="rounded-lg shadow-sm p-2 w-full">
                            </div>
                            <div>
                                <label for="texto" class="block font-medium">Texto:</label>
                                <!-- <input type="text" name="texto" id="texto" class="rounded-lg shadow-sm p-2 w-full"> -->
                                <textarea id="texto" name="texto" class="rounded-lg shadow-sm p-2 w-full h-96"></textarea>
                            </div>
                            <!-- <div class="flex justify-center w-full">
                                <form action="{{ route('search_user') }}" method="GET">
                                    <input type="text" name="name" placeholder="Procure por um usuário" class="rounded-lg shadow-sm p-2 bg-gray-100 text-gray-700 hover:bg-gray-200">
                                    <button type="submit" class="inline-block"><img src="https://img.icons8.com/?size=512&id=12773&format=png" class="w-8 h-8" alt="Pesquisar"></button>
                                </form>
                            </div> -->
                            
                            <button type="submit"  class="w-full mt-4" style="display: inline-block; padding: 8px 16px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">Salvar</button>
                        
                        </form>
                    </div>
                    <a href="{{ route('dashboard') }}" class="w-full mt-4" style="display: inline-block; padding: 8px 16px; background-color: #6CA6CD; color: white; text-align: center; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">Voltar</a>
                    <!-- <p> Para: </p> -->
                            <!-- <div class="flex justify-center w-full">
                                <form id="searchForm" action="{{ route('search_user') }}" method="GET">
                                    <input type="text" name="name" placeholder="Procure por um usuário" class="rounded-lg shadow-sm p-2 bg-gray-100 text-gray-700 hover:bg-gray-200">
                                    <button type="submit" class="inline-block"><img src="https://img.icons8.com/?size=512&id=12773&format=png" class="w-8 h-8" alt="Pesquisar"></button>
                                </form>
                            </div>
                        <ul id="userList"></ul> -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- 
fetch ok
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
                        listItem.textContent = user.name;
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
    $(document).ready(function() {
        $('#searchForm').submit(function(event) {
            event.preventDefault(); // Cancelar envio do formulário padrão

            var formData = $(this).serialize(); // Obter dados do formulário

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    // Exiba a lista de usuários
                    var users = response.users;
                    var userList = $('#userList');

                    userList.empty(); // Limpar a lista de usuários antes de adicionar os novos

                    for (var i = 0; i < users.length; i++) {
                        var user = users[i];
                        var listItem = $('<li>').text(user.name);
                        userList.append(listItem);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script> -->
