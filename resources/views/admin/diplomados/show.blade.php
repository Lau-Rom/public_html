<x-app-layout>

    <div class="panel-diplomado-container">

        <a href="{{ route('admin.diplomados.index') }}" class="btn-volver">
            ← Volver al panel
        </a>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="hero-diplomado">

            <div class="hero-info">

                <span class="badge-estado {{ strtolower($diplomado->estado) }}">
                    {{ ucfirst($diplomado->estado) }}
                </span>

                <h1>{{ $diplomado->nombre }}</h1>

                <p>
                    {{ $diplomado->descripcion }}
                </p>

                <div class="datos-diplomado">

                    <div>
                        <strong>Duración</strong>
                        <span>{{ $diplomado->duracion ?? 'No definida' }}</span>
                    </div>

                    <div>
                        <strong>Fecha inicio</strong>
                        <span>{{ $diplomado->fecha_inicio ?? 'No definida' }}</span>
                    </div>

                    <div>
                        <strong>Fecha fin</strong>
                        <span>{{ $diplomado->fecha_fin ?? 'No definida' }}</span>
                    </div>

                </div>

            </div>

            <div class="hero-imagen">

                @if ($diplomado->imagen)
                    <img src="{{ asset('storage/' . $diplomado->imagen) }}" alt="Imagen del diplomado">
                @else
                    <div class="sin-imagen">
                        📚
                        <span>Sin imagen de portada</span>
                    </div>
                @endif

            </div>

        </div>


        <div class="contenido-diplomado">

            <div class="form-modulo-card">

                <h2>Agregar módulo</h2>

                <p>
                    Crea los módulos que formarán parte del diplomado.
                </p>

                <form action="{{ route('admin.diplomados.modulos.store', $diplomado) }}" method="POST">
                    @csrf

                    <div class="campo">
                        <label>Título del módulo</label>
                        <input type="text" name="titulo" value="{{ old('titulo') }}" required>
                    </div>

                    <div class="campo">
                        <label>Descripción</label>
                        <textarea name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="campo">
                        <label>Orden</label>
                        <input type="number" name="orden"
                            value="{{ old('orden', $diplomado->modulos->count() + 1) }}">
                    </div>

                    <button type="submit" class="btn-guardar-modulo">
                        Guardar módulo
                    </button>

                </form>

            </div>

            <div class="modulos-section">

                <div class="section-header">
                    <h2>Módulos del diplomado</h2>
                    <p>Administra el contenido por módulo.</p>
                </div>

                @if ($diplomado->modulos->count())

                    <div class="modulos-lista">

                        @foreach ($diplomado->modulos as $modulo)
                            <div class="modulo-card">

                                <div class="modulo-numero">
                                    {{ $modulo->orden }}
                                </div>

                                <div class="modulo-info">

                                    <h3>{{ $modulo->titulo }}</h3>

                                    <p>
                                        {{ $modulo->descripcion ?? 'Sin descripción.' }}
                                    </p>

                                    <div class="modulo-meta">
                                        <span>📄 {{ $modulo->materiales->count() }} materiales</span>
                                    </div>

                                </div>

                                <div class="modulo-acciones">

                                    <a href="{{ route('admin.diplomados.modulos.show', $modulo) }}"
                                        class="btn-entrar-modulo">
                                        Entrar
                                    </a>

                                </div>

                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="sin-modulos">
                        <h3>No hay módulos registrados</h3>
                        <p>Agrega el primer módulo para comenzar a construir el diplomado.</p>
                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
