<x-app-layout>

    <div class="panel-modulo-container">

        <a href="{{ route('admin.diplomados.modulos.show', $modulo) }}" class="btn-volver">
            ← Volver al módulo
        </a>

        <section class="hero-modulo">
            <span class="modulo-badge">Nuevo material</span>

            <h1>Agregar material</h1>

            <p class="descripcion-modulo">
                Agrega un recurso para el módulo:
                <strong>{{ $modulo->titulo }}</strong>
            </p>
        </section>

        <section class="materiales-section">

            <div class="materiales-header">
                <div>
                    <h2>Datos del material</h2>
                    <p>Completa la información del recurso que verá el usuario.</p>
                </div>
            </div>

            <form action="{{ route('admin.diplomados.modulos.materiales.store', $modulo) }}" method="POST"
                enctype="multipart/form-data" class="form-material">
                @csrf

                <div class="form-group">
                    <label for="titulo">Título del material</label>
                    <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}"
                        placeholder="Ej. Guía de estudio del módulo" required>

                    @error('titulo')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo de material</label>
                    <select name="tipo" id="tipo" required>
                        <option value="">Selecciona una opción</option>
                        <option value="archivo" {{ old('tipo') == 'archivo' ? 'selected' : '' }}>Archivo</option>
                        <option value="enlace" {{ old('tipo') == 'enlace' ? 'selected' : '' }}>Enlace</option>
                        <option value="video" {{ old('tipo') == 'video' ? 'selected' : '' }}>Video</option>
                        <option value="texto" {{ old('tipo') == 'texto' ? 'selected' : '' }}>Texto</option>
                    </select>

                    @error('tipo')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group campo-descripcion">
                    <label for="descripcionMateriales" id="label-descripcion">Descripción</label>

                    <textarea name="descripcion" id="descripcionMateriales" rows="6"
                        placeholder="Describe brevemente el contenido del material...">{{ old('descripcion') }}</textarea>

                    @error('descripcion')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group campo-archivo">
                    <label for="archivo">Archivo</label>
                    <input type="file" name="archivo" id="archivo">

                    <small class="ayuda-campo">
                        Puedes subir PDF, Word, PowerPoint, imágenes o video.
                    </small>

                    @error('archivo')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group campo-url">
                    <label for="url" id="label-url">URL del material</label>
                    <input type="url" name="url" id="url" value="{{ old('url') }}"
                        placeholder="https://ejemplo.com/material">

                    @error('url')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.diplomados.modulos.show', $modulo) }}" class="btn-cancelar">
                        Cancelar
                    </a>

                    <button type="submit" class="btn-agregar-material">
                        Guardar material
                    </button>
                </div>

            </form>

        </section>

    </div>
    @vite('resources/js/admin/materiales/create.js')

</x-app-layout>
