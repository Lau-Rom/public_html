<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="docente-form-dashboard">

        <div class="docente-form-container">

            <div class="docente-form-card">

                <h1>Editar docente</h1>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Se encontraron errores:</strong>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.docentes.update', $docente->id) }}" method="POST">
                    @csrf
                    @method('PUT')


                    <div class="docente-form-section">
                        <h2>Datos personales</h2>

                        <div class="docente-form-grid">

                            <div class="docente-form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" value="{{ old('nombre', $docente->nombre) }}"
                                    required>
                                @error('nombre')
                                    <small class="text-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="docente-form-group">
                                <label>Apellido paterno</label>
                                <input type="text" name="apellido_paterno"
                                    value="{{ old('apellido_paterno', $docente->apellido_paterno) }}" required>
                                @error('apellido_paterno')
                                    <small class="text-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="docente-form-group">
                                <label>Apellido materno</label>
                                <input type="text" name="apellido_materno"
                                    value="{{ old('apellido_materno', $docente->apellido_materno) }}">

                            </div>

                            <div class="docente-form-group">
                                <label>Nacionalidad</label>
                                <select name="nacionalidad_id" id="nacionalidad_id" required>
                                    <option value="">Selecciona una opción</option>
                                    @foreach ($nacionalidades as $nacionalidad)
                                        <option value="{{ $nacionalidad->id }}" @selected(old('nacionalidad_id', $docente->nacionalidad_id) == $nacionalidad->id)>
                                            {{ $nacionalidad->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('nacionalidad_id')
                                    <small class="text-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="docente-form-group">
                                <label>CURP</label>
                                <input type="text" name="curp" id="curp"
                                    value="{{ old('curp', $docente->curp) }}" maxlength="18">
                                @error('curp')
                                    <small class="text-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="docente-form-group">
                                <label>Fecha de nacimiento</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                    value="{{ old('fecha_nacimiento', $docente->fecha_nacimiento) }}"
                                    max="{{ now()->subYears(18)->format('Y-m-d') }}">
                                @error('fecha_nacimiento')
                                    <small class="text-error">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="docente-form-group">
                                <label>Teléfono</label>
                                <input type="text" name="telefono" value="{{ old('telefono', $docente->telefono) }}"
                                    maxlength="10" required>
                                @error('telefono')
                                    <small class="text-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="docente-form-group">
                                <label>Correo</label>
                                <input type="email" name="correo" id="correo"
                                    value="{{ old('correo', $docente->correo) }}" required>
                                @error('correo')
                                    <small class="text-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="docente-form-group">
                                <label>Género</label>
                                <select name="genero_id" id="genero_id" required>
                                    <option value="">Selecciona una opción</option>
                                    @foreach ($generos as $genero)
                                        <option value="{{ $genero->id }}" @selected(old('genero_id', $docente->genero_id) == $genero->id)>
                                            {{ $genero->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('genero_id')
                                    <small class="text-error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="docente-form-section">
                            <h2>Información laboral</h2>

                            <div class="docente-form-grid">

                                <div class="docente-form-group">
                                    <label for="estatus">Estatus</label>
                                    <select name="estatus" id="estatus" class="form-control">
                                        <option value="ACTIVO"
                                            {{ old('estatus', $docente->estatus) == 'ACTIVO' ? 'selected' : '' }}>
                                            ACTIVO
                                        </option>

                                        <option value="INACTIVO"
                                            {{ old('estatus', $docente->estatus) == 'INACTIVO' ? 'selected' : '' }}>
                                            INACTIVO
                                        </option>
                                    </select>
                                </div>

                                <div class="docente-form-group">
                                    <label>Clave de trabajo</label>
                                    <input type="text" name="clave_trabajo"
                                        value="{{ old('clave_trabajo', $docente->clave_trabajo) }}" required>
                                    @error('clave_trabajo')
                                        <small class="text-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="docente-form-group">
                                    <label>Actividad</label>
                                    <select name="actividad_id" required>
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($actividades as $actividad)
                                            <option value="{{ $actividad->id }}" @selected(old('actividad_id', $docente->actividad_id) == $actividad->id)>
                                                {{ $actividad->nombre }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('actividad_id')
                                        <small class="text-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="docente-form-group">
                                    <label>Especialidad</label>
                                    <select name="especialidad_id" required>
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($especialidades as $especialidad)
                                            <option value="{{ $especialidad->id }}" @selected(old('especialidad_id', $docente->especialidad_id) == $especialidad->id)>
                                                {{ $especialidad->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('especialidad_id')
                                        <small class="text-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="docente-form-group">
                                    <label>Tipo de contratación</label>
                                    <select name="tipo_contratacion_id" required>
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($tipoContrataciones as $tipo)
                                            <option value="{{ $tipo->id }}" @selected(old('tipo_contratacion_id', $docente->tipo_contratacion_id) == $tipo->id)>
                                                {{ $tipo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tipo_contratacion_id')
                                        <small class="text-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="docente-form-group">
                                    <label>Tabulador</label>
                                    <select name="tabulador_id" required>
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($tabuladores as $tabulador)
                                            <option value="{{ $tabulador->id }}" @selected(old('tabulador_id', $docente->tabulador_id) == $tabulador->id)>
                                                {{ $tabulador->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tabulador_id')
                                        <small class="text-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="docente-form-group">
                                    <label>Horas por semana</label>
                                    <select name="horas_semana_id" required>
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($horasSemana as $horas)
                                            <option value="{{ $horas->id }}" @selected(old('horas_semana_id', $docente->horas_semana_id) == $horas->id)>
                                                {{ $horas->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('horas_semana_id')
                                        <small class="text-error">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="docente-form-section">
                            <h2>Semilleros</h2>

                            <div class="docente-semilleros-box">

                                @php
                                    $semillerosSeleccionados = old(
                                        'semilleros',
                                        $docente->semilleros->pluck('id')->toArray(),
                                    );
                                @endphp

                                @foreach ($semilleros as $semillero)
                                    <label class="docente-check-label">
                                        <input type="checkbox" name="semilleros[]" value="{{ $semillero->id }}"
                                            @checked(in_array($semillero->id, $semillerosSeleccionados))>
                                        <span>{{ $semillero->nombre_de_agrupacion }}</span>
                                    </label>
                                @endforeach

                            </div>
                        </div>


                        <div class="docente-form-section">
                            <h2>Cuenta</h2>

                            <label class="docente-check-label">
                                <input type="checkbox" id="editarCuenta" name="editar_cuenta" value="1">
                                <span>Actualizar usuario o contraseña</span>
                            </label>

                            <div class="docente-form-grid">

                                <div class="docente-form-group">
                                    <label>Usuario de acceso</label>

                                    <input type="text" name="usuario" id="usuario"
                                        value="{{ old('usuario', $docente->usuario) }}" autocomplete="off" disabled>

                                    @error('usuario')
                                        <small class="text-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="docente-form-group">
                                    <label>Nueva contraseña</label>

                                    <input type="password" name="contrasena" id="contrasena"
                                        autocomplete="new-password" disabled>

                                    @error('contrasena')
                                        <small class="text-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="docente-form-group">
                                    <label>Confirmar nueva contraseña</label>

                                    <input type="password" name="contrasena_confirmation"
                                        id="contrasena_confirmation" autocomplete="new-password" disabled>

                                    @error('contrasena_confirmation')
                                        <small class="text-error">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="docente-form-actions">
                            <button type="submit" class="btn-guardar-docente">
                                Guardar docente
                            </button>


                            <a href="{{ route('admin.docentes.buscar') }}" class="btn-cancelar-docente">
                                Cancelar
                            </a>
                        </div>

                </form>

            </div>

        </div>

    </div>

    @vite('resources/js/docentes/create.js')
    @vite('resources/js/docentes/edit.js')
</x-app-layout>
