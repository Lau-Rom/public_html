<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Postular</title>
    <link rel="stylesheet" href="{{ asset('css/semilleros/post.css') }}">  
</head>

<body>

<div class="container">
    
    <h1>
        Semilleros Creativos de Música
    </h1>

    <p class="nombre-semillero">
        <strong>
            {{ session('nombre_de_agrupacion')
            ?? 'Semillero Orquesta Sinfónica Comunitaria Forjadores del Sauzal' }}
        </strong>
    </p>

    <hr>

        <h2>
            Postulación a convocatoria -
            {{ $convocatoria->titulo }}
        </h2>

<!--el usuario vera cuando la postulaciòn se enviò correctamente o si
el alumno ya estaba postulado-->
@if(session('success'))
    <div class="alert-success"> 
        {{ session('success') }}
        </div>
@endif

@if(session('error'))
    <div class="alert-error">
            {{ session('error') }}
        </div>
@endif

  @if ($errors->any())
        <div class="alert-warning">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@if($alumnos->count())

<form method="POST"
      action="{{ route('semillero.convocatorias.guardarPostulacion', $convocatoria->id ) }}"
      enctype="multipart/form-data">

 @csrf

    <table>

        <thead>
            <tr>
                <th>Seleccionar</th>
                <th>Folio</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Meses en la agrupación</th>
            </tr>
        </thead>

        <tbody>

        @foreach($alumnos as $alumno)
            @php
             $yaPostulado = in_array(
                $alumno->folio_semillero,
                $foliosPostulados
             );
            @endphp
            <tr class="{{ $yaPostulado ? 'fila-deshabilitada' : '' }}">

                <td>
                    <input
                        type="radio"
                        name="folio_alumno"
                        value="{{ $alumno->folio_semillero }}"
                        {{ $yaPostulado ? 'disabled' : '' }}
                        required>
    <!-- se puede implementar {{ ($yaPostulado || !$alumno->elegible) ? 'disabled' : '' }}, para que muestre deshabilitado el radio button si el alumno no es elegible-->
<!--Esto evita que un integrante sea postulado dos veces a la misma convocatoria 
y se muestra visualmente cuáles ya fueron registrados.-->
            @if($yaPostulado)
                    <small class="mensaje-error">
                    Ya postulado
                    </small>
            @endif

<!-- @if(!$alumno->elegible) este if se puede implementar para mostrar un mensaje que indique que el alumno no cumple los requisitos
                     <small style="color:red;">
                        No cumple requisitos
                         </small>
            @endif-->
                </td>


                <td>
                    {{ $alumno->folio_semillero }}
                </td>

                <td>
                    {{ $alumno->nombre }}
                    {{ $alumno->a_paterno }}
                    {{ $alumno->a_materno }}
                </td>
               
                <td> {{ $alumno->edad }}</td>

                <td> {{ $alumno->meses_en_grupo }}</td>
           
            </tr>

        @endforeach


        </tbody>

    </table>

    <br>

    <label>Documentos PDF</label>

    <input type="file"
           name="archivos[]"
           multiple
           accept=".pdf">

    <br><br>

    <label>Video de audición</label>

    <input type="url"
           name="video_link"
           placeholder="https://...">

    <br><br>

    <button type="submit">
        Enviar Postulación
    </button>

     <a href="{{ route('semillero.convocatorias.show', $convocatoria->id) }}"
               class="btn btn-regresar">
                Regresar
        </a>

</form>

@else

    <div class="card-convocatoria">
            <h2>
                No existen alumnos elegibles
            </h2>
        </div>

        <a href="{{ route( 'semillero.convocatorias.show', $convocatoria->id) }}"
            class="btn btn-regresar">
             Regresar
            </a>

  @endif
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