<!--
    Vista para buscar integrantes de un semillero musical comunitario.
    Muestra un formulario para ingresar el folio del integrante a buscar y una tabla con los resultados de la búsqueda.
    Si no se ingresa ningún folio, muestra todos los integrantes registrados.
    Permite ver, editar o eliminar un integrante si se encuentra en la búsqueda.
    Muestra mensajes de éxito al realizar acciones como eliminar un integrante.
    Incluye enlaces para limpiar la búsqueda y regresar al dashboard del semillero.-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrupaciones Musicales Comunitarias</title>

    <link rel="stylesheet" href="{{ asset('css/semilleros/buscar.css') }}">
</head>

<body>

<h1 class="titulo">
    Agrupaciones Musicales Comunitarias
</h1>

<p>
    Agrupación:
    <strong>
        {{ session('nombre_de_agrupacion') ?? 'Semillero Orquesta Sinfónica Comunitaria Forjadores del Sauzal' }}
    </strong>
</p>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

<form id="loginform"
      method="GET"
      action="{{ route('semillero.integrantes.buscar') }}">

    <label>
        Ingresa el <strong>Folio del integrante</strong> a buscar:
    </label>

    <input
        type="text"
        id="buscar"
        name="buscar"
        value="{{ $buscar ?? '' }}"
        required>

    <button type="submit" value="buscar">
        Buscar
    </button>

    <a href="{{ route('semillero.integrantes.buscar') }}">
        <button type="button">
            Limpiar
        </button>
    </a>

    <a href="{{ route('semillero.dashboard') }}">
        <button type="button">
            Atrás
        </button>
    </a>

</form>

@if($integrantes->count())

    <h2>
        @if(!empty($buscar))
            Resultado de la búsqueda
        @else
            Lista de integrantes
        @endif
    </h2>

    <h3>
        Total {{ $integrantes->count() }} integrantes
    </h3>

    <div class="table-container">

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Folio Semillero</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>

                    @if(empty($buscar))
                        <th>CURP</th>
                    @endif

                    <th>Instrumento</th>

                    @if(!empty($buscar))
                        <th>Acciones</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @foreach($integrantes as $i => $integrante)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $integrante->folio_semillero }}</td>
                        <td>{{ $integrante->nombre }}</td>
                        <td>{{ $integrante->a_paterno }}</td>
                        <td>{{ $integrante->a_materno }}</td>

                        @if(empty($buscar))
                            <td>{{ $integrante->curp_id }}</td>
                        @endif

                        <td>{{ $integrante->instrumento_nombre }}</td>

                        @if(!empty($buscar))
                            <td>
                                <a href="{{ route('semillero.integrantes.ver', [
                                    'folio' => urlencode($integrante->folio_semillero)
                                ]) }}">
                                    Ver
                                </a>
                               <a href="{{ route('semillero.integrantes.edit', [
                                'folio_semillero' => urlencode($integrante->folio_semillero)
                                ]) }}">
                                    Editar
                                </a> 
                                <br>

                        <form method="POST"action="{{ route('semillero.integrantes.destroy', [
                          'folio_semillero' => urlencode($integrante->folio_semillero)]) }}"
                        style="display:inline;">

    @csrf
    @method('DELETE')

                    <button type="submit"class="btn-eliminar" onclick="return confirm('¿Desea eliminar a {{ $integrante->nombre }} {{ $integrante->a_paterno }}?')">
                         Eliminar
                    </button>
</form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@else

    @if(!empty($buscar))
        <h3>
            No se encontró ningún integrante con el folio
            <strong>{{ $buscar }}</strong>
        </h3>
    @else
        <h3>
            No hay integrantes registrados.
        </h3>
    @endif

@endif

</body>

<footer>

    <div style="text-align:center;padding:1em 0;">

        <strong>
            Sistema Nacional de Fomento Musical 2025
        </strong>

        <h5 style="color:gray;">
            Hora actual en Mexico City, México
        </h5>

        <iframe
            src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=small&timezone=America%2FMexico_City">
        </iframe>

    </div>

</footer>
</html>