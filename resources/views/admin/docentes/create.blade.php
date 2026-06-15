<x-app-layout>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">
                    Nuevo docente
                </h1>

                <form action="{{ route('admin.docentes.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block mb-1 font-semibold">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}"
                                class="w-full border rounded p-2" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Apellido paterno</label>
                            <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}"
                                class="w-full border rounded p-2" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Apellido materno</label>
                            <input type="text" name="apellido_materno" value="{{ old('apellido_materno') }}"
                                class="w-full border rounded p-2" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">CURP</label>
                            <input type="text" name="curp" value="{{ old('curp') }}"
                                class="w-full border rounded p-2" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                                class="w-full border rounded p-2" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Clave de trabajo</label>
                            <input type="text" name="clave_trabajo" value="{{ old('clave_trabajo') }}"
                                class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Teléfono</label>
                            <input type="text" name="telefono" value="{{ old('telefono') }}"
                                class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Correo</label>
                            <input type="email" name="correo" value="{{ old('correo') }}"
                                class="w-full border rounded p-2">
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Nacionalidad</label>
                            <select name="nacionalidad_id" class="w-full border rounded p-2" required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($nacionalidades as $nacionalidad)
                                    <option value="{{ $nacionalidad->id }}" @selected(old('nacionalidad_id') == $nacionalidad->id)>
                                        {{ $nacionalidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Género</label>
                            <select name="genero_id" class="w-full border rounded p-2" required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($generos as $genero)
                                    <option value="{{ $genero->id }}" @selected(old('genero_id') == $genero->id)>
                                        {{ $genero->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Actividad</label>
                            <select name="actividad_id" class="w-full border rounded p-2" required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($actividades as $actividad)
                                    <option value="{{ $actividad->id }}" @selected(old('actividad_id') == $actividad->id)>
                                        {{ $actividad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Especialidad</label>
                            <select name="especialidad_id" class="w-full border rounded p-2" required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($especialidades as $especialidad)
                                    <option value="{{ $especialidad->id }}" @selected(old('especialidad_id') == $especialidad->id)>
                                        {{ $especialidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Tipo de contratación</label>
                            <select name="tipo_contratacion_id" class="w-full border rounded p-2" required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($tipoContrataciones as $tipo)
                                    <option value="{{ $tipo->id }}" @selected(old('tipo_contratacion_id') == $tipo->id)>
                                        {{ $tipo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Tabulador</label>
                            <select name="tabulador_id" class="w-full border rounded p-2" required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($tabuladores as $tabulador)
                                    <option value="{{ $tabulador->id }}" @selected(old('tabulador_id') == $tabulador->id)>
                                        {{ $tabulador->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Horas por semana</label>
                            <select name="horas_semana_id" class="w-full border rounded p-2" required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($horasSemana as $horas)
                                    <option value="{{ $horas->id }}" @selected(old('horas_semana_id') == $horas->id)>
                                        {{ $horas->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="mt-6">
                        <label class="block mb-2 font-semibold">
                            Semilleros
                        </label>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 border rounded p-4">
                            @foreach ($semilleros as $semillero)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="semilleros[]" value="{{ $semillero->id }}"
                                        @checked(is_array(old('semilleros')) && in_array($semillero->id, old('semilleros')))>

                                    <span>
                                        {{ $semillero->nombre_de_agrupacion }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6 flex gap-2">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                            Guardar docente
                        </button>

                        <a href="{{ route('admin.docentes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
