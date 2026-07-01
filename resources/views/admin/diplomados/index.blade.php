<x-app-layout>
    <div class="diplomados-container">

        <div class="header-diplomados">

            <div>
                <h1>Panel de Diplomados</h1>
                <p>Administra todos los diplomados del sistema.</p>
            </div>

            <div class="header-acciones">
                <a href="{{ route('admin.diplomados.create') }}" class="btn-crear">
                    + Crear Diplomado
                </a>

                <a href="{{ route('dashboard') }}" class="btn-salir">
                    Salir
                </a>
            </div>

        </div>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($diplomados->count())
            <div class="diplomados-grid">

                @foreach ($diplomados as $diplomado)
                    <div class="card-diplomado">

                        <div class="card-header">

                            <h2>{{ $diplomado->nombre }}</h2>

                            <span class="estado {{ strtolower($diplomado->estado) }}">
                                {{ ucfirst($diplomado->estado) }}
                            </span>

                        </div>

                        <div class="contenido-editor">
                            <p class="descripcion">
                                {!! $diplomado->descripcion !!}
                            </p>
                        </div>

                        <div class="info-diplomado">

                            <div class="info-item">
                                <span>⏱</span>
                                <strong>Duración:</strong>
                                {{ $diplomado->duracion }}
                            </div>

                            <div class="info-item">
                                <span>📚</span>
                                <strong>Módulos:</strong>
                                {{ $diplomado->modulos_count }}
                                {{ $diplomado->modulos_count == 1 ? 'módulo' : 'módulos' }}
                            </div>



                            <div class="info-item">
                                <span>📄</span>
                                <strong>Materiales:</strong>

                                {{ $diplomado->modulos->sum(fn($modulo) => $modulo->materiales->count()) }}

                                {{ $diplomado->modulos->sum(fn($modulo) => $modulo->materiales->count()) == 1 ? 'material' : 'materiales' }}
                            </div>

                        </div>

                        <div class="acciones-diplomado">

                            <a href="{{ route('admin.diplomados.show', $diplomado) }}" class="btn btn-entrar">
                                Entrar
                            </a>

                            <a href="{{ route('admin.diplomados.edit', $diplomado) }}" class="btn btn-editar">
                                Editar
                            </a>

                            {{-- AQUI FALTA QUE ELIMINE MODULOS, MATERIALES, ETC --}}
                            <form action="{{ route('admin.diplomados.destroy', $diplomado->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-eliminarr"
                                    onclick="return confirm('¿Seguro que deseas eliminar este diplomado?')">
                                    Eliminar
                                </button>
                            </form>

                        </div>

                    </div>
                @endforeach

            </div>
        @else
            <div class="sin-diplomados">

                <h2>No hay diplomados registrados</h2>

                <p>
                    Comienza creando el primer diplomado para asignarlo posteriormente
                    a los docentes.
                </p>

                <a href="{{ route('admin.diplomados.create') }}" class="btn-crear">
                    Crear primer diplomado
                </a>

            </div>
        @endif

    </div>

</x-app-layout>
