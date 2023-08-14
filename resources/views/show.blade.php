
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1>Detalhes do Usuário</h1>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                        <!-- Outros detalhes do usuário -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>