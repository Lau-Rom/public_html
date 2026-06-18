<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>
<div class="login-bg flex items-center justify-center px-4">

    <div class="w-full max-w-md">


        <div class="login-card">

            <form wire:submit="login">
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Ingresa tu usuario o correo electrónico')" />
                    <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="text"
                        name="email" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" />

                    <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                        name="password" required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember" class="inline-flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox"
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recuérdame') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-6">

                    {{-- NOTA: DEJO ESTE BLOQUE POR SI EN ALGUN MOMENTO SE UTILIZA,
            YA ESTA PROGRAMADO LA PARTE DE OLVIDASTE TU CONTRASEÑA, NADAMAS FALTARIA PROGRAMAR LA VERIFICACIÓN DEL
            CORREO AL CREAR CUENTA.


            <div class="flex flex-col text-sm">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" wire:navigate
                        class="text-gray-400 hover:text-white transition-colors">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" wire:navigate
                        class="mt-2 text-gray-400 hover:text-white transition-colors">
                        Crear cuenta
                    </a>
                @endif
            </div> --}}

                    <x-primary-button class="btn-gob w-full justify-center">
                        Iniciar sesión
                    </x-primary-button>

                </div>
            </form>

        </div>

    </div>

</div>
