<x-app-layout>

    <div class="panel-modulo-container">

        <a href="{{ route('admin.diplomados.show', $modulo->diplomado) }}" class="btn-volver">
            ← Volver al diplomado
        </a>

        <section class="hero-modulo">
            <span class="modulo-badge">
                Módulo {{ $modulo->orden }}
            </span>

            <h1>{{ $modulo->titulo }}</h1>

            <div class="descripcion-modulo contenido-editor">
                {!! $modulo->descripcion !!}
            </div>
        </section>
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <section class="materiales-section">

            <div class="materiales-header">
                <div>
                    <h2>Materiales del módulo</h2>
                    <p>Administra los recursos, archivos y enlaces de este módulo.</p>
                </div>

                <div class="acciones-header-modulo">
                    <a href="{{ route('admin.diplomados.modulos.materiales.create', $modulo) }}"
                        class="btn-agregar-material">
                        + Agregar material
                    </a>

                </div>
            </div>

            @if ($modulo->materiales->count())

                <div class="materiales-lista">

                    @foreach ($modulo->materiales as $material)
                        <div class="material-card">

                            <div class="material-icono">
                                📄
                            </div>

                            <div class="material-info">
                                <h3>{{ $material->titulo }}</h3>

                                <span class="material-tipo">
                                    {{ ucfirst($material->tipo) }}
                                </span>

                                @if ($material->descripcion)
                                    <div class="contenido-editor">
                                        {!! $material->descripcion !!}
                                    </div>
                                @endif

                                <div class="material-acciones">
                                    <a href="{{ route('admin.diplomados.modulos.materiales.edit', $material) }}"
                                        class="btn-ver-material">
                                        Editar material
                                    </a>
                                    <form action="{{ route('admin.diplomados.modulos.materiales.destroy', $material) }}"
                                        method="POST" class="form-eliminar-material">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-eliminar-material">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                <div class="sin-materiales">
                    <div class="icono-vacio">📚</div>
                    <h3>Aún no hay materiales</h3>
                    <p>Agrega el primer recurso para este módulo.</p>
                </div>

            @endif

        </section>

    </div>

</x-app-layout>
