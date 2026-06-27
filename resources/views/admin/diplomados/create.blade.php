<x-app-layout>
    <div class="diplomados-container">
        <div class="crear-diplomado-container">

            <div class="titulo-formulario">

                <h1>Crear Diplomado</h1>

                <p>
                    Completa la información general del diplomado.
                    Posteriormente podrás agregar módulos, materiales y cuestionarios.
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

            <form action="{{ route('admin.diplomados.store') }}" method="POST" enctype="multipart/form-data"
                class="form-diplomado">

                @csrf

                <div class="campo">

                    <label>Nombre del diplomado</label>

                    <input type="text" name="nombre" value="{{ old('nombre') }}" required>

                </div>

                <div class="campo">

                    <label>Descripción</label>

                    <textarea name="descripcion" rows="5">{{ old('descripcion') }}</textarea>

                </div>

                <div class="dos-columnas">

                    <div class="campo">

                        <label>Duración</label>

                        <input type="text" name="duracion" value="{{ old('duracion') }}"
                            placeholder="Ejemplo: 40 horas">

                    </div>

                    <div class="campo">

                        <label>Estado</label>

                        <select name="estado">

                            <option value="activo">Activo</option>

                            <option value="inactivo">Inactivo</option>

                        </select>

                    </div>

                </div>

                <div class="dos-columnas">

                    <div class="campo">

                        <label>Fecha de inicio</label>

                        <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}">

                    </div>

                    <div class="campo">

                        <label>Fecha de fin</label>

                        <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}">

                    </div>

                </div>

                <div class="campo">

                    <label>Imagen de portada</label>

                    <div class="upload-area" id="uploadArea">

                        <input type="file" name="imagen" id="imagen" accept="image/*" hidden>

                        <div class="upload-content">

                            <div class="icono-upload">
                                📷
                            </div>

                            <h3>Selecciona una imagen</h3>

                            <p>
                                Haz clic aquí o arrastra una imagen.
                            </p>

                            <button type="button" class="btn-subir"
                                onclick="document.getElementById('imagen').click()">

                                Seleccionar imagen

                            </button>

                        </div>

                        <img id="preview" class="preview-image" style="display:none;">

                    </div>

                </div>

                <div class="botones">

                    <a href="{{ route('admin.diplomados.index') }}" class="btn-cancelar">

                        Cancelar

                    </a>

                    <button type="submit" class="btn-guardar">

                        Guardar Diplomado

                    </button>

                </div>

            </form>

        </div>
    </div>
    <script>
        const input = document.getElementById('imagen');
        const preview = document.getElementById('preview');
        const uploadContent = document.querySelector('.upload-content');

        input.addEventListener('change', function() {

            const file = this.files[0];

            if (!file) return;

            const reader = new FileReader();

            reader.onload = function(e) {

                preview.src = e.target.result;

                preview.style.display = "block";

                uploadContent.style.display = "none";

            };

            reader.readAsDataURL(file);

        });
    </script>
</x-app-layout>
