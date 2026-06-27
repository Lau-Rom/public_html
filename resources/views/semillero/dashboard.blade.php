<!-- resources/views/semillero/dashboard.blade.php 
 nos muestra el dasboard del panel semillero-->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agrupaciones Musicales Comunitarias</title>

    <link rel="stylesheet"
          href="{{ asset('css/semilleros/home_semille.css') }}">
</head>

<body>

    <h1 class="titulo">
        Agrupaciones Musicales Comunitarias
    </h1>

    <p>
        Bienvenido/a:
        <strong>{{ session('nombre_de_agrupacion') }}</strong>
    </p>

    <div class="botones-container">

        <h2>¿Qué deseas hacer?</h2>

        <button class="button1"
            onclick="location.href='{{ route('semillero.integrantes.agregar') }}'">
            Agregar
        </button>

        <button class="button2"
            onclick="location.href='{{ route('semillero.integrantes.buscar') }}'">
            Editar/Eliminar
        </button>

        <button class="button3"
             onclick="location.href='{{ route('semillero.convocatorias') }}'">
            Convocatorias
        </button>

        <button class="button4"
             onclick="location.href='{{ route('semillero.mensajes') }}'">
            Mensajes
        </button>

        <form method="POST"
      action="{{ route('filament.admin.auth.logout') }}"
      class="logout-form">

    @csrf

    <button type="submit"
            class="button5">
        Salir
    </button>

</form>

    </div>

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