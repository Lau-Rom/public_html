<x-app-layout>

    <div class="panel-modulo-container">

        <a href="{{ route('admin.diplomados.modulos.show', $material->modulo) }}" class="btn-volver">
            ← Volver al módulo
        </a>

        <section class="hero-modulo">
            <span class="modulo-badge">Editar material</span>

            <h1>{{ $material->titulo }}</h1>

            <p class="descripcion-modulo">
                Edita este recurso del módulo:
                <strong>{{ $material->modulo->titulo }}</strong>
            </p>
        </section>

        <section class="materiales-section">

            <div class="materiales-header">
                <div>
                    <h2>Datos del material</h2>
                    <p>Actualiza la información del recurso que verá el usuario.</p>
                </div>
            </div>

            <form action="{{ route('admin.diplomados.modulos.materiales.update', $material) }}" method="POST"
                enctype="multipart/form-data" class="form-material">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="titulo">Título del material</label>
                    <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $material->titulo) }}"
                        placeholder="Ej. Guía de estudio del módulo" required>

                    @error('titulo')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo de material</label>
                    <select name="tipo" id="tipo" required>
                        <option value="">Selecciona una opción</option>
                        <option value="archivo" {{ old('tipo', $material->tipo) == 'archivo' ? 'selected' : '' }}>
                            Archivo</option>
                        <option value="enlace" {{ old('tipo', $material->tipo) == 'enlace' ? 'selected' : '' }}>Enlace
                        </option>
                        <option value="video" {{ old('tipo', $material->tipo) == 'video' ? 'selected' : '' }}>Video
                        </option>
                        <option value="texto" {{ old('tipo', $material->tipo) == 'texto' ? 'selected' : '' }}>Texto
                        </option>
                    </select>

                    @error('tipo')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group campo-descripcion">
                    <label for="descripcionMateriales" id="label-descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcionMateriales" rows="6"
                        placeholder="Describe brevemente el contenido del material...">{{ old('descripcion', $material->descripcion) }}</textarea>

                    @error('descripcion')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group campo-archivo">
                    <label for="archivo">Archivo</label>

                    @if ($material->archivo)
                        <div class="archivo-actual">

                            Archivo actual:


                            <a href="{{ Storage::url($material->archivo) }}" target="_blank" class="archivo-link">
                                Ver archivo
                            </a>
                        </div>
                    @endif

                    <input type="file" name="archivo" id="archivo" data-edit="true">

                    <small class="ayuda-campo">
                        Si subes un nuevo archivo, reemplazará al anterior.
                    </small>

                    @error('archivo')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group campo-url">
                    <label for="url" id="label-url">URL del material</label>
                    <input type="url" name="url" id="url" value="{{ old('url', $material->url) }}"
                        placeholder="https://ejemplo.com/material">

                    @error('url')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.diplomados.modulos.show', $material->modulo) }}" class="btn-cancelar">
                        Cancelar
                    </a>

                    <button type="submit" class="btn-agregar-material">
                        Actualizar material
                    </button>
                </div>

            </form>

        </section>

    </div>

    @vite('resources/js/admin/materiales/create.js')


</x-app-layout>
