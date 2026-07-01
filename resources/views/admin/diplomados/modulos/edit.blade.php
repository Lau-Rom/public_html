<x-app-layout>

    <div class="panel-diplomado-container">

        <a href="{{ route('admin.diplomados.show', $modulo->diplomado) }}" class="btn-volver">
            ← Volver al diplomado
        </a>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="editar-modulo-container">

            <div class="form-modulo-card">

                <h2>Editar módulo</h2>

                <p>
                    Modifica la información del módulo seleccionado.
                </p>

                <form action="{{ route('admin.diplomados.modulos.update', $modulo) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="campo">
                        <label>Título del módulo</label>
                        <input type="text" name="titulo" value="{{ old('titulo', $modulo->titulo) }}" required>
                    </div>

                    <div class="campo">
                        <label>Descripción</label>
                        <textarea id="descripcionModulo" name="descripcion" rows="4">{{ old('descripcion', $modulo->descripcion) }}</textarea>
                    </div>

                    <div class="campo">
                        <label>Orden</label>
                        <input type="number" name="orden" value="{{ old('orden', $modulo->orden) }}">
                    </div>

                    <button type="submit" class="btn-guardar-modulo">
                        Actualizar módulo
                    </button>

                </form>

            </div>

        </div>

    </div>

    @vite('resources/js/admin/diplomados/create.js')

</x-app-layout>
