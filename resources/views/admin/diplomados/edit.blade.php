<x-app-layout>
    <div class="diplomados-container">
        <div class="crear-diplomado-container">

            <div class="titulo-formulario">
                <h1>Editar Diplomado</h1>

                <p>
                    Modifica la información general del diplomado.
                </p>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    <strong>Se encontraron los siguientes errores:</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.diplomados.update', $diplomado) }}" method="POST" enctype="multipart/form-data"
                class="form-diplomado">

                @csrf
                @method('PUT')

                <div class="campo">
                    <label>Nombre del diplomado</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $diplomado->nombre) }}" required>
                </div>

                <div class="campo">
                    <label>Descripción</label>
                    <textarea id="descripcionDiplomadoEdit" name="descripcion" rows="5">{{ old('descripcion', $diplomado->descripcion) }}</textarea>
                </div>

                <div class="dos-columnas">
                    <div class="campo">
                        <label>Duración</label>
                        <input type="text" name="duracion" value="{{ old('duracion', $diplomado->duracion) }}">
                    </div>

                    <div class="campo">
                        <label>Estado</label>
                        <select name="estado">
                            <option value="activo"
                                {{ old('estado', $diplomado->estado) == 'activo' ? 'selected' : '' }}>
                                Activo
                            </option>

                            <option value="inactivo"
                                {{ old('estado', $diplomado->estado) == 'inactivo' ? 'selected' : '' }}>
                                Inactivo
                            </option>
                        </select>
                    </div>
                </div>

                <div class="dos-columnas">
                    <div class="campo">
                        <label>Fecha de inicio</label>
                        <input type="date" name="fecha_inicio"
                            value="{{ old('fecha_inicio', $diplomado->fecha_inicio) }}">
                    </div>

                    <div class="campo">
                        <label>Fecha de fin</label>
                        <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $diplomado->fecha_fin) }}">
                    </div>
                </div>

                <div class="campo">
                    <label>Imagen de portada</label>

                    <div class="upload-area" id="uploadArea">
                        <input type="file" name="imagen" id="imagen" accept="image/*" hidden>

                        <div class="upload-content">
                            <div class="icono-upload">📷</div>

                            <h3>Cambiar imagen</h3>

                            <p>
                                Haz clic aquí o arrastra una nueva imagen.
                            </p>

                            <button type="button" class="btn-subir"
                                onclick="document.getElementById('imagen').click()">
                                Seleccionar imagen
                            </button>
                        </div>

                        @if ($diplomado->imagen)
                            <img id="preview" class="preview-image"
                                src="{{ asset('storage/' . $diplomado->imagen) }}">
                        @else
                            <img id="preview" class="preview-image" style="display:none;">
                        @endif
                    </div>
                </div>

                <div class="botones">
                    <a href="{{ route('admin.diplomados.index', $diplomado) }}" class="btn-cancelar">
                        Cancelar
                    </a>

                    <button type="submit" class="btn-guardar">
                        Actualizar Diplomado
                    </button>
                </div>

            </form>

        </div>
    </div>

    @vite('resources/js/admin/diplomados/create.js')
</x-app-layout>
