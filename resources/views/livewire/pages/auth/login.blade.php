<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();

        $login = $this->form->email;
        $password = $this->form->password;

        /*
    |--------------------------------------------------------------------------
    | 1. ADMINISTRADOR - tabla users
    |--------------------------------------------------------------------------
    */
        $admin = DB::table('users')
            ->where(function ($query) use ($login) {
                $query->where('usuario', $login)->orWhere('email', $login);
            })
            ->first();

        if ($admin && Hash::check($password, $admin->password)) {
            auth()->loginUsingId($admin->id, $this->form->remember);

            Session::regenerate();

            Session::put('tipo_usuario', 'admin');

            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        /*
    |--------------------------------------------------------------------------
    | 2. SEMILLERO - tabla semilleros
    |--------------------------------------------------------------------------
    */
        $semillero = DB::table('semilleros')
            ->where(function ($query) use ($login) {
                $query->where('usuario', $login)->orWhere('correo', $login);
            })
            ->first();

        if ($semillero && Hash::check($password, $semillero->contrasena)) {
            Session::regenerate();

            Session::put('semillero_id', $semillero->id);
            Session::put('semillero_usuario', $semillero->usuario);
            Session::put('tipo_usuario', 'semillero');

            $this->redirect(route('semillero.ejemplo_panel', absolute: false), navigate: true);

            return;
        }

        /*
    |--------------------------------------------------------------------------
    | 3. DOCENTE - tabla docentes
    |--------------------------------------------------------------------------
    */
        $docente = DB::table('docentes')
            ->where(function ($query) use ($login) {
                $query->where('usuario', $login)->orWhere('correo', $login);
            })
            ->first();

        if ($docente && Hash::check($password, $docente->contrasena)) {
            Session::regenerate();

            Session::put('docente_id', $docente->id);
            Session::put('docente_usuario', $docente->usuario);
            Session::put('tipo_usuario', 'docente');

            $this->redirect(route('docente.menu_docente', absolute: false), navigate: true);

            return;
        }

        /*
    |--------------------------------------------------------------------------
    | ERROR
    |--------------------------------------------------------------------------
    */
        $this->addError('form.email', 'Las credenciales no son correctas.');
    }
};

?>


<form wire:submit="login">

    <!-- Email Address -->
    <div>
        <x-input-label for="email" :value="__('Ingresa tu usuario o correo electrónico')" />
        <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="text" name="email" required
            autofocus autocomplete="username" />
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
