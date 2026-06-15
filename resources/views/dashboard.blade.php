<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <!-- MENÚ -->
                <div>
                    @include('partials.menu')
                </div>

                <!-- CONTENIDO -->
                <div class="md:col-span-3">

                    <div class="bg-white shadow rounded-lg p-6">

                        <h3 class="text-lg font-bold mb-4">
                            Bienvenido
                        </h3>

                        <p>
                            Hola {{ Auth::user()->name }}
                        </p>

                        <p>
                            Rol: {{ Auth::user()->rol }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
