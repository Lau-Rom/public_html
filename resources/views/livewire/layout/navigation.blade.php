<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    public string $nombreUsuario = 'Usuario';
    public string $correoUsuario = '';

    public function mount(): void
    {
        if (auth()->check()) {
            $this->nombreUsuario = auth()->user()->name;
            $this->correoUsuario = auth()->user()->email;
            return;
        }

        if (session('tipo_usuario') === 'semillero') {
            $this->nombreUsuario = session('semillero_usuario', 'Semillero');
            $this->correoUsuario = 'Semillero';
            return;
        }

        if (session('tipo_usuario') === 'docente') {
            $this->nombreUsuario = session('docente_usuario', 'Docente');
            $this->correoUsuario = 'Docente';
            return;
        }
    }

    public function logout(Logout $logout): void
    {
        $logout();

        session()->forget(['semillero_id', 'semillero_usuario', 'docente_id', 'docente_usuario', 'tipo_usuario']);

        $this->redirect('/');
    }
};

?>

<nav x-data="{ open: false }" class="bg-[#ece8e1] border-b border-[#d7d0c4]">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-end h-16">

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center px-4 py-2 border border-[#d7d0c4] text-sm leading-4 font-semibold rounded-lg text-[#691c32] bg-[#f6f2ea] hover:bg-[#eee7dc] focus:outline-none transition">

                            <div x-data="{{ json_encode(['name' => $nombreUsuario]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name">
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        {{-- Perfil deshabilitado temporalmente para escritorio --}}
                        {{--
                        <x-dropdown-link :href="route('profile')">
                            Perfil
                        </x-dropdown-link>
                        --}}

                        <button wire:click="logout" class="w-full text-start">

                            <x-dropdown-link>
                                Finalizar sesión
                            </x-dropdown-link>

                        </button>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">

                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-[#691c32] hover:bg-[#eee7dc] focus:outline-none transition">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">

                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">

                Dashboard

            </x-responsive-nav-link>

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-[#d7d0c4]">

            <div class="px-4">

                <div class="font-medium text-base text-[#691c32]" x-data="{{ json_encode(['name' => $nombreUsuario]) }}" x-text="name"
                    x-on:profile-updated.window="name = $event.detail.name">
                </div>

                <div class="font-medium text-sm text-gray-500">
                    {{ $correoUsuario }}
                </div>

            </div>

            <div class="mt-3 space-y-1">

                {{-- Perfil deshabilitado temporalmente para móvil --}}
                {{--
                <x-responsive-nav-link :href="route('profile')">
                    Perfil
                </x-responsive-nav-link>
                --}}

                <button wire:click="logout" class="w-full text-start">

                    <x-responsive-nav-link>
                        Finalizar sesión
                    </x-responsive-nav-link>

                </button>

            </div>

        </div>

    </div>

</nav>
