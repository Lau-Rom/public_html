<x-app-layout>



    <div class="diplomados-container">

        <div class="header-diplomados">

            <div>
                <h1>Panel de Diplomados</h1>
                <p>Administra todos los diplomados del sistema.</p>
            </div>

            <a href="{{ route('admin.diplomados.create') }}" class="btn-crear">
                + Crear Diplomado
            </a>

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

                        <p class="descripcion">
                            {{ $diplomado->descripcion }}
                        </p>

                        <div class="info-diplomado">

                            <div class="info-item">
                                <span>⏱</span>
                                <strong>Duración:</strong>
                                {{ $diplomado->duracion }}
                            </div>

                            <div class="info-item">
                                <span>📚</span>
                                <strong>Módulos:</strong>
                                Próximamente
                            </div>

                            <div class="info-item">
                                <span>👨‍🏫</span>
                                <strong>Docentes:</strong>
                                Próximamente
                            </div>

                        </div>

                        <div class="acciones-diplomado">

                            <a href="{{ route('admin.diplomados.show', $diplomado) }}" class="btn btn-entrar">
                                Entrar
                            </a>

                            {{-- Cuando exista la ruta descomenta --}}
                            {{--
                        <a href="{{ route('admin.diplomados.edit',$diplomado) }}" class="btn btn-editar">
                            Editar
                        </a>
                        --}}

                            {{--
                        <a href="{{ route('admin.diplomados.docentes',$diplomado) }}" class="btn btn-docente">
                            Asignar docente
                        </a>
                        --}}

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
