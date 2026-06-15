<div class="bg-white shadow rounded-lg p-4">

    <h3 class="font-bold mb-4">
        Menú
    </h3>

    @if (Auth::user()->rol == 'super-admin')
        <ul class="space-y-2">
            <li>
                <a href="#" class="block p-2 hover:bg-gray-100 rounded">
                    crear administradores
                </a>
            </li>

            <li>
                <a href="#" class="block p-2 hover:bg-gray-100 rounded">
                    crear semilleros
                </a>
            </li>

            <li>
                <a href="{{ route('admin.docentes.index') }}" class="block p-2 hover:bg-gray-100 rounded">
                    crear docentes
                </a>
            </li>

            <li>
                <a href="#" class="block p-2 hover:bg-gray-100 rounded">
                    convocatorias
                </a>
            </li>

            <li>
                <a href="#" class="block p-2 hover:bg-gray-100 rounded">
                    estadisticas
                </a>
            </li>

            <li>
                <a href="#" class="block p-2 hover:bg-gray-100 rounded">
                    diplomados
                </a>
            </li>

        </ul>
    @elseif(Auth::user()->rol == 'admin')
        <ul class="space-y-2">

            <li>
                <a href="#">estadisticas</a>
            </li>

        </ul>
    @elseif(Auth::user()->rol == 'docente')
        <ul class="space-y-2">

            <li>
                <a href="#">Diplomados</a>
            </li>

            <li>
                <a href="#">mis certificados</a>
            </li>

            <li>
                <a href="#">mensajes</a>
            </li>

        </ul>
    @elseif(Auth::user()->rol == 'semillero')
        <ul class="space-y-2">

            <li>
                <a href="#">agregar</a>
            </li>

            <li>
                <a href="#">editar/eliminar</a>
            </li>

            <li>
                <a href="#">convocatorias</a>
            </li>

            <li>
                <a href="#">mensajes</a>
            </li>

            <li>
                <a href="#">biblioteca</a>
            </li>

        </ul>
    @endif

</div>
