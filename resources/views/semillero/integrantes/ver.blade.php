<!--vista para ver los detalles de un integrante-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <title>
        Ver Integrante
    </title>

    <link rel="stylesheet"
          href="{{ asset('css/semilleros/ver.css') }}">


    <script>
        function printDiv(divId) {
            const contenido = document.getElementById(divId).innerHTML;
            const ventana = window.open('', '', 'width=800,height=600');

            ventana.document.write('<html><head><title>Imprimir</title>');
            ventana.document.write('<style>');
            ventana.document.write('@page { size: portrait; margin: 0.5cm; }');
            ventana.document.write('body { font-family: Poppins, sans-serif; padding: 0.5rem; font-size: 0.85rem; }');
            ventana.document.write('table { width: 100%; border-collapse: collapse; background-color: #fff; }');
            ventana.document.write('th, td { padding: 0.2rem 0.4rem; text-align: left; border: 1px solid #ccc; }');
            ventana.document.write('h1 { text-align: center; color: #430c22; margin-bottom: 0.5rem; font-size: 1.3rem; }');
            ventana.document.write('</style>');
            ventana.document.write('</head><body>');
            ventana.document.write('<h1>Agrupaciones Musicales Comunitarias</h1>');
            ventana.document.write('<p>Agrupación: <strong>{{ session('nombre_de_agrupacion') ?? 'Semillero Orquesta Sinfónica Comunitaria Forjadores del Sauzal' }}</strong></p>');
            ventana.document.write('<p>BÚSQUEDA DE INTEGRANTE</p>');
            ventana.document.write(contenido);
            ventana.document.write('</body></html>');

            ventana.document.close();
            ventana.focus();
            ventana.print();
            ventana.close();
        }
    </script>
</head>

<body>
<div class="Imprimir">
<h1 class="titulo"> Agrupaciones Musicales Comunitarias</h1>

<p>
    Agrupación:
    <strong>
        {{ session('nombre_de_agrupacion')?? 'Semillero Orquesta Sinfónica Comunitaria Forjadores del Sauzal' }}
    </strong>
</p>
   <p>BÚSQUEDA DE INTEGRANTE</p>
</div>
 @php
        $edad = null;

        if (!empty($integrante->fecha_nacimiento)) {
            $edad = \Carbon\Carbon::parse($integrante->fecha_nacimiento)->age;
        }
    @endphp

<div id="print-area">

<table>

<tbody>

<tr>
    <th>Folio Semillero</th>
    <td>{{ $integrante->folio_semillero }}</td>
</tr>

<tr>
    <th>Semillero</th>
    <td>{{ $integrante->semillero }}</td>
</tr>

<tr>
    <th>Nombre</th>
    <td>{{ $integrante->nombre }}</td>
</tr>

<tr>
    <th>Apellido Paterno</th>
    <td>{{ $integrante->a_paterno }}</td>
</tr>

<tr>
    <th>Apellido Materno</th>
    <td>{{ $integrante->a_materno }}</td>
</tr>

<tr>
    <th>Género</th>
    <td>{{ $integrante->genero }}</td>
</tr>

<tr>
    <th>Nacionalidad</th>
    <td>{{ $integrante->nacionalidad }}</td>
</tr>

<tr>
    <th>CURP</th>
    <td>{{ $integrante->curp_id }}</td>
</tr>

<tr>
    <th>Fecha Nacimiento</th>
    <td>{{ $integrante->fecha_nacimiento }}</td>
</tr>

 <tr><th>Edad</th><td>{{ $edad }}</td></tr>

<tr>
    <th>Email</th>
    <td>{{ $integrante->email }}</td>
</tr>

<tr>
    <th>Teléfono</th>
    <td>{{ $integrante->tel }}</td>
</tr>

<tr>
    <th>Instrumento</th>
    <td>{{ $integrante->instrumento_nombre }}</td>
</tr>

<tr>
    <th>Estatus</th>
    <td>{{ $integrante->estatus }}</td>
</tr>

<tr>
    <th>Nombre Escuela</th>
    <td>{{ $integrante->nombre_escuela }}</td>
</tr>

<tr>
    <th>Clave Escuela</th>
    <td>{{ $integrante->clave_escuela }}</td>
</tr>

<tr>
    <th>Dirección Escuela</th>
    <td>{{ $integrante->dir_escuela }}</td>
</tr>

<tr>
    <th>Nivel Escolar</th>
    <td>{{ $integrante->nivel_escuela }}</td>
</tr>

<tr>
    <th>Grado Escolar</th>
    <td>{{ $integrante->grado_escuela }}</td>
</tr>

<tr>
    <th>Email Escuela</th>
    <td>{{ $integrante->email_escuela }}</td>
</tr>

<tr>
    <th>Tel Escuela</th>
    <td>{{ $integrante->tel_escuela }}</td>
</tr>

<tr>
    <th>Nombre Tutor</th>
    <td>{{ $integrante->nombre_tutor }}</td>
</tr>

<tr>
    <th>Parentesco Tutor</th>
    <td>{{ $integrante->parentesco_tutor }}</td>
</tr>

<tr>
    <th>Dirección Tutor</th>
    <td>{{ $integrante->dir_tutor }}</td>
</tr>

<tr>
    <th>Población Tutor</th>
    <td>{{ $integrante->poblacion_tutor }}</td>
</tr>

<tr>
    <th>Municipio Tutor</th>
    <td>{{ $integrante->municipio_tutor }}</td>
</tr>

<tr>
    <th>CP Tutor</th>
    <td>{{ $integrante->cp_tutor }}</td>
</tr>

<tr>
    <th>Estado Tutor</th>
    <td>{{ $integrante->estado_tutor }}</td>
</tr>

<tr>
    <th>Tel Tutor</th>
    <td>{{ $integrante->tel_tutor }}</td>
</tr>

<tr>
    <th>Email Tutor</th>
    <td>{{ $integrante->email_tutor }}</td>
</tr>

<tr>
    <th>Origen Indígena</th>
    <td>{{ $integrante->origen }}</td>
</tr>

<tr>
    <th>¿Habla Lengua Indigena? </th>
    <td>{{ $integrante->hablante }}</td>
</tr>

<tr>
    <th>Lengua</th>
    <td>{{ $integrante->lengua_nombre }}</td>
</tr>

<tr>
    <th>Fecha Carga</th>
    <td>{{ $integrante->fecha_carga }}</td>
</tr>

</tbody>

</table>

</div>

<br>

<button type="button"
        onclick="location.href='{{ route('semillero.integrantes.buscar') }}'">
    Atrás
</button>

<button type="button"
        onclick="printDiv('print-area')">
    Imprimir PDF
</button>
</body>
 <footer>
        <div style="text-align:center;padding:1em 0;">
            <strong>Sistema Nacional de Fomento Musical 2025</strong>
            <h5 style="color:gray;">Hora actual en Mexico City, México</h5>
            <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=small&timezone=America%2FMexico_City" </iframe>
        </div>
    </footer>

</html>