<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
        <div style="display: flex; flex-direction: column; align-items: center;">
            <img src="https://media.giphy.com/media/cChKTgN5nFyklt8ddH/giphy.gif" alt="Logo" width="100px" height="100px">
            <p style="font-weight: bold;">POSTA-RESTANTE</p>
        </div>
        
        <!-- <img src="https://media.giphy.com/media/cChKTgN5nFyklt8ddH/giphy.gif" alt="Logo" width="100px" height="100px"> -->

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Lembre-me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Esqueceu a senha?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Entrar') }}
            </x-primary-button>
        </div>
    </form>
    @if (Route::has('register'))
    <div class="mt-4 text-center">
        <p class="text-sm text-gray-600">
            {{ __('Ainda não possui uma conta?') }}
            <a href="{{ route('register') }}" class="underline text-sm text-gray-900 hover:text-gray-700 ml-1">
                {{ __('Registre-se') }}
            </a>
        </p>
    </div>
@endif

</x-guest-layout>
