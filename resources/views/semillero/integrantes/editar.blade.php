<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Integrante</title>

    <link rel="stylesheet"
          href="{{ asset('css/semilleros/agregar.css') }}">
</head>

<body>

<h1>Semilleros Creativos de Música</h1>

<h5>
    <strong>
        {{ session('nombre_de_agrupacion') }}
    </strong>
</h5>

<form method="POST"
      action="{{ route(
            'semillero.integrantes.update',
            $integrante->folio_semillero
      ) }}">

    @csrf
    @method('PUT')

    <fieldset>

        <legend>
            DATOS INTEGRANTE
        </legend>

        <label>FOLIO DEL INTEGRANTE</label>

        <input type="text"
               value="{{ $integrante->folio_semillero }}"
               disabled>

        <br><br>

        <label>NOMBRE</label>

        <input type="text"
               name="nombre"
               value="{{ old('nombre',$integrante->nombre) }}"
               required>

               @error('nombre')
    <small class="error">
        {{ $message }}
    </small>
@enderror

        <br><br>

        <label>APELLIDO PATERNO</label>

        <input type="text"
               name="a_paterno"
               value="{{ old('a_paterno',$integrante->a_paterno) }}"
               required>

        <br><br>

        <label>APELLIDO MATERNO</label>

        <input type="text"
               name="a_materno"
               value="{{ old('a_materno',$integrante->a_materno) }}">

        <br><br>

        <label>GÉNERO</label>

        <select name="genero">

            <option value="Hombre"
                {{ $integrante->genero=='Hombre' ? 'selected' : '' }}>
                HOMBRE
            </option>

            <option value="Mujer"
                {{ $integrante->genero=='Mujer' ? 'selected' : '' }}>
                MUJER
            </option>

        </select>

        <br><br>

        <label>NACIONALIDAD</label>

        <select name="nacionalidad">

            <option value="Mexicana"
                {{ $integrante->nacionalidad=='Mexicana' ? 'selected' : '' }}>
                MEXICANA
            </option>

            <option value="Extranjero"
                {{ $integrante->nacionalidad=='Extranjero' ? 'selected' : '' }}>
                EXTRANJERO
            </option>

        </select>

        <br><br>

        <label>CURP</label>

        <input type="text"
               name="curp_id"
               value="{{ old('curp_id',$integrante->curp_id) }}">

        <br><br>

        <label>FECHA DE NACIMIENTO</label>

        <input type="date"
               name="fecha_nacimiento"
               value="{{ old(
                    'fecha_nacimiento',
                    $integrante->fecha_nacimiento
               ) }}">

        <br><br>

        <label>EMAIL</label>

        <input type="email"
               name="email"
               value="{{ old('email',$integrante->email) }}">

        <br><br>

        <label>TELÉFONO</label>

        <input type="text"
               name="tel"
               value="{{ old('tel',$integrante->tel) }}">

        <br><br>

        <label>INSTRUMENTO</label>

        <select name="instrumento">

            @foreach($instrumentos as $instrumento)

                <option value="{{ $instrumento->ID }}"
                    {{ $integrante->instrumento == $instrumento->ID ? 'selected' : '' }}>

                    {{ $instrumento->INSTRUMENTO }}

                </option>

            @endforeach

        </select>

        <br><br>

        <label>ESTATUS</label>

        <select name="estatus">

            <option value="Activo"
                {{ $integrante->estatus=='Activo' ? 'selected' : '' }}>
                ACTIVO
            </option>

            <option value="Baja"
                {{ $integrante->estatus=='Baja' ? 'selected' : '' }}>
                BAJA
            </option>

        </select>

        <br><br>

        <label>
          ¿SE AUTOPERCIBE DE ORIGEN INDÍGENA?
        </label>

        <br>

        <input type="radio"
       name="origen"
       value="Sí"
       {{ $integrante->origen=='Sí' ? 'checked' : '' }}>

        Sí

        <input type="radio"
       name="origen"
       value="No"
       {{ $integrante->origen=='No' ? 'checked' : '' }}>

        No

        <br><br>

        <label>
         ¿HABLA ALGUNA LENGUA INDÍGENA?
        </label>

        <br>

        <input type="radio"
       name="hablante"
       value="Sí"
       {{ $integrante->hablante=='Sí' ? 'checked' : '' }}>

        Sí

    <input type="radio"
       name="hablante"
       value="No"
       {{ $integrante->hablante=='No' ? 'checked' : '' }}>

        No

    <br><br>

    <label>Lengua</label>

    <select name="lengua">

    <option value="">
        Seleccione
    </option>

    @foreach($lenguas as $lengua)

        <option value="{{ $lengua->id }}"
            {{ $integrante->lengua == $lengua->id ? 'selected' : '' }}>

            {{ $lengua->lengua }}

        </option>

    @endforeach

</select>


    </fieldset>


    <br>

    <fieldset>

        <legend>
            DATOS ESCOLARES
        </legend>

        <label>Nombre Escuela</label>

        <input type="text"
               name="nombre_escuela"
               value="{{ old(
                    'nombre_escuela',
                    $integrante->nombre_escuela
               ) }}">

        <br><br>

        <label>Nivel Escolar</label>

        <input type="text"
               name="nivel_escuela"
               value="{{ old(
                    'nivel_escuela',
                    $integrante->nivel_escuela
               ) }}">

        <br><br>

        <label>Grado Escolar</label>

        <input type="text"
               name="grado_escuela"
               value="{{ old(
                    'grado_escuela',
                    $integrante->grado_escuela
               ) }}">

        <br><br>

        <label>Clave Escuela</label>

        <input type="text"
               name="clave_escuela"
               value="{{ old(
                    'clave_escuela',
                    $integrante->clave_escuela
               ) }}">
        <br><br>

        <label>Dirección Escuela</label>

        <input type="text"
       name="dir_escuela"
       value="{{ old(
            'dir_escuela',
            $integrante->dir_escuela
       ) }}">

        <br><br>

        <label>Email Escuela</label>

        <input type="email"
       name="email_escuela"
       value="{{ old(
            'email_escuela',
            $integrante->email_escuela
       ) }}">

        <br><br>

        <label>Tel Escuela</label>

    <input type="text"
       name="tel_escuela"
       value="{{ old(
            'tel_escuela',
            $integrante->tel_escuela
       ) }}">

        

    </fieldset>

    <br>

    <fieldset>

        <legend>
            DATOS DEL TUTOR
        </legend>

        <label>Nombre Tutor</label>

        <input type="text"
               name="nombre_tutor"
               value="{{ old(
                    'nombre_tutor',
                    $integrante->nombre_tutor
               ) }}">

        <br><br>

        <label>Parentesco</label>

        <input type="text"
               name="parentesco_tutor"
               value="{{ old(
                    'parentesco_tutor',
                    $integrante->parentesco_tutor
               ) }}">

        <br><br>

        <label>Teléfono Tutor</label>

        <input type="text"
               name="tel_tutor"
               value="{{ old(
                    'tel_tutor',
                    $integrante->tel_tutor
               ) }}">

               <br><br>

            <label>Email Tutor</label>

            <input type="email"
             name="email_tutor"
             value="{{ old(
            'email_tutor',
            $integrante->email_tutor
             ) }}">

            <br><br>

            <label>Dirección Tutor</label>

                <input type="text"
                    name="dir_tutor"
                    value="{{ old(
                    'dir_tutor',
                    $integrante->dir_tutor
                    ) }}">

                <br><br>

            <label>Población Tutor</label>

                <input type="text"
                     name="poblacion_tutor"
                     value="{{ old(
                        'poblacion_tutor',
                     $integrante->poblacion_tutor
                        ) }}">

                        <br><br>

            <label>Municipio Tutor</label>

                <input type="text"
                     name="municipio_tutor"
                        value="{{ old(
                         'municipio_tutor',
                            $integrante->municipio_tutor
                          ) }}">

                            <br><br>

            <label>Estado Tutor</label>

                <input type="text"
                      name="estado_tutor"
                          value="{{ old(
                         'estado_tutor',
                          $integrante->estado_tutor
                         ) }}">

                        <br><br>

            <label>Código Postal</label>

                <input type="text"
                     name="cp_tutor"
                        value="{{ old(
                      'cp_tutor',
                      $integrante->cp_tutor
                    ) }}">

    </fieldset>

    <br>


   <button
    type="button"
    class="btn-atras"
    onclick="window.location='{{ route('semillero.integrantes.buscar') }}'">

    Atrás

</button>

    <button type="submit">
        Actualizar
    </button>

</form>

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