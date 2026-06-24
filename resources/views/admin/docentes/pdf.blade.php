<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Docente {{ $docente->id }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            margin-top: 25px;
            background: #f0f0f0;
            padding: 8px;
            font-size: 15px;
        }

        .dato {
            margin-bottom: 7px;
        }

        .label {
            font-weight: bold;
        }

        .semillero {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 12px;
        }
    </style>
</head>

<body>
    <h1>Información completa del docente</h1>

    <h2>Datos personales</h2>

    <div class="dato"><span class="label">ID:</span> {{ $docente->id }}</div>
    <div class="dato"><span class="label">Nombre:</span> {{ $docente->nombre }}</div>
    <div class="dato"><span class="label">Apellido paterno:</span> {{ $docente->apellido_paterno }}</div>
    <div class="dato"><span class="label">Apellido materno:</span> {{ $docente->apellido_materno }}</div>
    <div class="dato"><span class="label">CURP:</span> {{ $docente->curp ?? 'No registrado' }}</div>
    <div class="dato"><span class="label">Fecha de nacimiento:</span> {{ $docente->fecha_nacimiento }}</div>


    <div class="dato">
        <span class="label">Edad:</span>
        {{ \Carbon\Carbon::parse($docente->fecha_nacimiento)->age }} años
    </div>
    <div class="dato"><span class="label">Nacionalidad:</span>
        {{ $docente->nacionalidad->nombre ?? 'No registrado' }}</div>
    <div class="dato"><span class="label">Género:</span> {{ $docente->genero->nombre ?? 'No registrado' }}</div>

    <h2>Contacto y acceso</h2>

    <div class="dato"><span class="label">Teléfono:</span> {{ $docente->telefono ?? 'No registrado' }}</div>
    <div class="dato"><span class="label">Correo:</span> {{ $docente->correo ?? 'No registrado' }}</div>
    <div class="dato"><span class="label">Usuario:</span> {{ $docente->usuario ?? 'No registrado' }}</div>

    <h2>Datos laborales</h2>

    <div class="dato"><span class="label">Estatus:</span> {{ $docente->estatus ?? 'No registrado' }}</div>
    <div class="dato"><span class="label">Clave de trabajo:</span> {{ $docente->clave_trabajo ?? 'No registrado' }}
    </div>
    <div class="dato"><span class="label">Actividad:</span> {{ $docente->actividad->nombre ?? 'No registrado' }}
    </div>
    <div class="dato"><span class="label">Especialidad:</span>
        {{ $docente->especialidad->nombre ?? 'No registrado' }}</div>
    <div class="dato"><span class="label">Tipo de contratación:</span>
        {{ $docente->tipoContratacion->nombre ?? 'No registrado' }}</div>
    <div class="dato"><span class="label">Tabulador:</span> {{ $docente->tabulador->nombre ?? 'No registrado' }}
    </div>
    <div class="dato"><span class="label">Horas por semana:</span>
        {{ $docente->horasSemana->nombre ?? 'No registrado' }}</div>

    <h2>Semillero(s) asignado(s)</h2>

    @if ($docente->semilleros->count())
        @foreach ($docente->semilleros as $semillero)
            <div class="semillero">
                <div class="dato"><span class="label">Sistema:</span>
                    {{ $semillero->sistema ?? 'No registrado' }}
                </div>
                <div class="dato"><span class="label">Nombre de agrupación:</span>
                    {{ $semillero->nombre_de_agrupacion ?? 'No registrado' }}</div>
                <div class="dato"><span class="label">Tipo de agrupación:</span>
                    {{ $semillero->tipo_agrupacion ?? 'No registrado' }}</div>
                <div class="dato"><span class="label">Estado:</span> {{ $semillero->estado ?? 'No registrado' }}
                </div>
                <div class="dato"><span class="label">Municipio:</span>
                    {{ $semillero->municipio ?? 'No registrado' }}</div>
                <div class="dato"><span class="label">Localidad:</span>
                    {{ $semillero->localidad ?? 'No registrado' }}</div>
            </div>
        @endforeach
    @else
        <p>No tiene semilleros asignados</p>
    @endif
</body>

</html>
