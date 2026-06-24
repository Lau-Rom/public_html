<x-app-layout>
    <div class="docente-show-container">
        <h1>Información completa del docente</h1>

        <div class="docente-show-card">
            <p><strong>ID:</strong> {{ $docente->id }}</p>

            <p><strong>Nombre:</strong> {{ $docente->nombre }}</p>
            <p><strong>Apellido paterno:</strong> {{ $docente->apellido_paterno }}</p>
            <p><strong>Apellido materno:</strong> {{ $docente->apellido_materno }}</p>

            <p><strong>CURP:</strong> {{ $docente->curp ?? 'No registrado' }}</p>
            <p><strong>Fecha de nacimiento:</strong> {{ $docente->fecha_nacimiento }}</p>
            <div class="dato">
                <span class="label">Edad:</span>
                {{ $docente->fecha_nacimiento ? \Carbon\Carbon::parse($docente->fecha_nacimiento)->age . ' años' : 'No registrado' }}
            </div>
            <p><strong>Estatus:</strong> {{ $docente->estatus ?? 'No registrado' }}</p>
            <p><strong>Clave de trabajo:</strong> {{ $docente->clave_trabajo ?? 'No registrado' }}</p>

            <p><strong>Nacionalidad:</strong> {{ $docente->nacionalidad->nombre ?? 'No registrado' }}</p>
            <p><strong>Género:</strong> {{ $docente->genero->nombre ?? 'No registrado' }}</p>
            <p><strong>Actividad:</strong> {{ $docente->actividad->nombre ?? 'No registrado' }}</p>
            <p><strong>Especialidad:</strong> {{ $docente->especialidad->nombre ?? 'No registrado' }}</p>

            <p><strong>Teléfono:</strong> {{ $docente->telefono ?? 'No registrado' }}</p>
            <p><strong>Correo:</strong> {{ $docente->correo ?? 'No registrado' }}</p>
            <p><strong>Usuario:</strong> {{ $docente->usuario ?? 'No registrado' }}</p>

            <p><strong>Contraseña:</strong> ********</p>

            <p><strong>Tipo de contratación:</strong> {{ $docente->tipoContratacion->nombre ?? 'No registrado' }}</p>
            <p><strong>Tabulador:</strong> {{ $docente->tabulador->nombre ?? 'No registrado' }}</p>
            <p><strong>Horas por semana:</strong> {{ $docente->horasSemana->nombre ?? 'No registrado' }}</p>

            <div class="docente-semilleros-box">
                <h2>Semillero(s) asignado(s)</h2>

                @if ($docente->semilleros->count())
                    @foreach ($docente->semilleros as $semillero)
                        <div class="semillero-card">
                            <p><strong>Sistema:</strong> {{ $semillero->sistema ?? 'No registrado' }}</p>
                            <p><strong>Nombre de agrupación:</strong>
                                {{ $semillero->nombre_de_agrupacion ?? 'No registrado' }}</p>
                            <p><strong>Tipo de agrupación:</strong>
                                {{ $semillero->tipo_agrupacion ?? 'No registrado' }}</p>
                            <p><strong>Estado:</strong> {{ $semillero->estado ?? 'No registrado' }}</p>
                            <p><strong>Municipio:</strong> {{ $semillero->municipio ?? 'No registrado' }}</p>
                            <p><strong>Localidad:</strong> {{ $semillero->localidad ?? 'No registrado' }}</p>
                        </div>
                    @endforeach
                @else
                    <p>No tiene semilleros asignados</p>
                @endif
            </div>
        </div>

        <div class="docente-show-actions">
            <a href="{{ route('admin.docentes.pdf', $docente->id) }}" class="btn-descargar">
                Descargar PDF
            </a>
        </div>
    </div>
</x-app-layout>
