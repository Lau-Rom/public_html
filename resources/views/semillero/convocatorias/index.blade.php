<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Convocatorias Activas</title>
 <link rel="stylesheet" href="{{ asset('css/semilleros/post.css') }}">   
</head>

<body>

<div class="container">

    <h1 >Semilleros Creativos de Música </h1>

    <p class="nombre-semillero">
        <strong>
            {{ session('nombre_de_agrupacion')
            ?? 'Semillero Orquesta Sinfónica Comunitaria Forjadores del Sauzal' }}
        </strong>
    </p>

    <hr>

    <div class="encabezado-convocatorias">

        <h3>
            Convocatorias Activas
        </h3>

        <a href="{{ route('semillero.dashboard') }}"
           class="btn btn-regresar">
            Regresar
        </a>

    </div>

@if($convocatorias->count())

    @foreach($convocatorias as $convocatoria)

        <div class="card-convocatoria">
            <h2>{{ $convocatoria->titulo }}</h2>

            <p>{{ $convocatoria->descripcion }}</p>

            <small>Inicio: {{ $convocatoria->fecha_inicio }}</small>
            <br>
            <small>Fin: {{ $convocatoria->fecha_fin }}</small>

            </p>

                <a href="{{ route('semillero.convocatorias.show', $convocatoria->id) }}"
                   class="btn btn-postular">
                    Ver convocatoria
                </a>


        </div>

        <hr>

    @endforeach

@else
     <div class="card-convocatoria">
            <h2>No existen convocatorias activas</h2>
        </div>

@endif

</div>
</body>
<footer>
    <div style="text-align:center;padding:1em 0;">
        <strong>Sistema Nacional de Fomento Musical 2025</strong>
        <h5 style="color:gray;">Hora actual en Mexico City, México</h5>
        <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=small&timezone=America%2FMexico_City" </iframe>
    </div>
</footer>
</html>