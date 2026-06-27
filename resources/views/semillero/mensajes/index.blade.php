<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mensajes</title>

    <link rel="stylesheet"
          href="{{ asset('css/semilleros/post.css') }}">
</head>

<body>

<div class="container">

    <h1>
        Resultados Publicados
    </h1>

    @if($resultados->count())

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre del archivo</th>
                    <th>Fecha de publicación</th>
                    <th>Disponible hasta</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>
                @foreach($resultados as $i => $resultado)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $resultado->nombre_archivo }}</td>
                        <td>{{ \Carbon\Carbon::parse($resultado->fecha_subida)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($resultado->fecha_expiracion)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ asset($resultado->ruta_archivo) }}"
                               target="_blank"
                               class="btn btn-postular">
                                Descargar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else

        <div class="alert-warning">
            No hay resultados disponibles en este momento.
        </div>

    @endif

    <a href="{{ route('semillero.dashboard') }}"
       class="btn btn-regresar">
        Regresar
    </a>

</div>

</body>

</html>