<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Integrante</title>
    <link rel="stylesheet"
      href="{{ asset('css/semilleros/agregar.css') }}">
</head>

<body>

<h1>Agregar Integrante</h1>

@if(session('success'))
    <div style="
        background:#d4edda;
        color:#155724;
        padding:10px;
        margin-bottom:15px;
        border-radius:5px;
    ">
        {{ session('success') }}
    </div>
@endif

<form id="loginform" method="POST"
      action="{{ route('semillero.integrantes.store') }}">

    @csrf

    <fieldset>
        <legend>DATOS INTEGRANTE --> </legend>

        <label>FOLIO DEL INTEGRANTE</label>
        <input type="text"
               value="{{ $folioSemillero }}"
               disabled>

        <br><br>

        <label>NOMBRE</label>
        <input type="text"
               name="nombre"
               value="{{ old('nombre') }}"
               required placeholder="---">
         @error('nombre')
    <small class="error">
        {{ $message }}
    </small>
@enderror
        <br><br>

        <label>APELLIDO PATERNO</label>
        <input type="text"
               name="a_paterno"
               value="{{ old('a_paterno') }}"
               required placeholder="---">

        <br><br>

        <label>APELLIDO MATERNO</label>
        <input type="text"
               name="a_materno"
               value="{{ old('a_materno') }}"
                required placeholder="---">

        <br><br>

        <label>GÉNERO</label>
        <select name="genero" required>
            <option value="" disabled selected>SELECCIONE</option>
            <option value="Hombre">HOMBRE</option>
            <option value="Mujer">MUJER</option>
        </select>

        <br><br>

        <label>NACIONALIDAD</label>
        <select name="nacionalidad" id="nacionalidad" required>
            <option value="" disabled selected>SELECCIONE</option>
            <option value="Mexicana">MEXICANA</option>
            <option value="Extranjero">OTRO</option>
        </select>

        <br><br>

        <label>CURP</label>
        <input type="text"
               name="curp_id"
               id="curp_id"
               value="{{ old('curp_id') }}"
               maxlength="18"
               placeholder="---">
 <span id="msg_curp" style="color:red;"></span><!--Este span es para mostar el mensaje de la validación de la curp-->

        <br><br>

        <label>FECHA DE NACIMIENTO</label>
        <input type="date"
               name="fecha_nacimiento"
               value="{{ old('fecha_nacimiento') }}"
               required>

        <br><br>

        <label>EMAIL</label>
 <!--En este input no se usa el required ya que los alumnos que son pequeños puede que no tengan correo electronico, solamente el tutor-->
        <input type="email"
               name="email"
               id="email1"
               value="{{ old('email') }}"
              placeholder="@">
            <?php
            //Si el usuario envía un correo inválido y PHP detecta el error, se muestra el mensaje. Si el usuario lo corrige y vuelve a enviar, desaparece automáticamente.
            if (!empty($error_email)): ?>
                <p style="color:red;"><?php echo $error_email; ?></p>
            <?php endif; ?>

        <br><br>

        <label>TELÉFONO</label>
<!--En este input no se usa el required ya que los alumnos que son pequeños puede que no tengan telefono, solamente el tutor-->
        <input type="text"
               name="tel"
               id="tel1"
               value="{{ old('tel') }}"
               placeholder="10 dígitos"
               pattern="[0-9]{10}">
        <br><br>

        <label>INSTRUMENTO</label>
        <select name="instrumento" required>
            <option value="" disabled selected>SELECCIONE</option>

            @foreach($instrumentos as $instrumento)
                <option value="{{ $instrumento->ID }}">
                    {{ $instrumento->INSTRUMENTO }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>ESTATUS</label>
        <input type="text" value="ACTIVO" readonly>
        <input type="hidden" name="estatus" id="estatus" value="Activo">
        </select>

        <br><br>

        <label>¿SE AUTOPERCIBE DE ORIGEN INDÍGENA?</label>
        <br>
        <input type="radio" name="origen" value="Sí"> Sí
        <input type="radio" name="origen" value="No"> No

        <br><br>

        <label>¿HABLA ALGUNA LENGUA INDÍGENA?</label>
        <br>
        <input type="radio" name="hablante" value="Sí"> Sí
        <input type="radio" name="hablante" value="No" > No

        <br><br>

        <select name="lengua" id="lengua" disabled>
            <option value="" selected>SELECCIONE</option>

            @foreach($lenguas as $lengua)
                <option value="{{ $lengua->id }}">
                    {{ $lengua->lengua }}
                </option>
            @endforeach
        </select>

    </fieldset>
    <br>

<fieldset>
    <legend>DATOS ESCOLARES  --> </legend>

    <label>NOMBRE ESCUELA</label>
    <input type="text" name="nombre_escuela" value="{{ old('nombre_escuela') }}"
    required placeholder="---">

    <br><br>

    <label>NIVEL ESCOLAR</label>
    <select name="nivel_escolar"  id="nivel" value="{{ old('nivel_escolar') }}"
    required >

     <option value="" selected disabled>
        SELECCIONE
    </option>

    <option value="Primaria">
        PRIMARIA
    </option>

    <option value="Secundaria">
        SECUNDARIA
    </option>

    <option value="Bachiller">
        BACHILLER
    </option>

    <option value="Otro">
        OTRO
    </option>

</select>

    <br><br>

    <label>GRADO ESCOLAR</label>
    <select id='grado1' disabled>
        <option value="" selected disabled>
        SELECCIONE
    </option>
<!-- PRIMARIA -->
    <option value="1º Año">1º AÑO</option>
    <option value="2º Año">2º AÑO</option>
    <option value="3º Año">3º AÑO</option>
    <option value="4º Año">4º AÑO</option>
    <option value="5º Año">5º AÑO</option>
    <option value="6º Año">6º AÑO</option>
</select>

<!-- SECUNDARIA / BACHILLER -->
<select id="grado2" disabled>

    <option value="" selected disabled>
        SELECCIONE
    </option>

    <option value="1º Semestre">1º SEMESTRE</option>
    <option value="2º Semestre">2º SEMESTRE</option>
    <option value="3º Semestre">3º SEMESTRE</option>
    <option value="4º Semestre">4º SEMESTRE</option>
    <option value="5º Semestre">5º SEMESTRE</option>
    <option value="6º Semestre">6º SEMESTRE</option>

</select>

<!-- OTRO -->
    <input type="text"
       id="grado3"
       placeholder="ESPECIFIQUE"
       disabled>

<!-- CAMPOS QUE SE GUARDAN -->
    <input type="hidden"
       name="nivel_escuela"
       id="nivel_escuela_final">

    <input type="hidden"
       name="grado_escuela"
       id="grado_escuela_final">

    <br><br>

    <label>CLAVE DE LA ESCUELA</label>
    <input type="text" id="clave_escuela" name="clave_escuela" value="{{ old('clave_escuela') }}"
    required placeholder="--Ej: 09EPR1234A--">
    <div id="cct_feedback" style="color: #b00; margin-top:4px;"></div>

    <br><br>

    <label>DIRECCIÓN</label>
    <input type="text" name="dir_escuela" value="{{ old('dir_escuela') }}"
    required placeholder="---" >

    <br><br>

    <label>EMAIL</label>
 <!--En este input si se usa el required ya que las escuelas cuentan con correo electronico-->
    <input type="email" name="email_escuela" id="email2" value="{{ old('email_escuela') }}"
    required placeholder="@" >

    <br><br>

    <label>TEL/CEL</label>
<!--En este input si se usa el required ya que las escuelas cuentan con telefono-->
    <input type="text" name="tel_escuela" id="tel2" value="{{ old('tel_escuela') }}"
    required placeholder="10 dígitos"
    pattern="[0-9]{10}">

</fieldset>
<br>

<fieldset>
    <legend>DATOS DEL TUTOR --></legend>

    <label>NOMBRE</label>
    <input type="text" name="nombre_tutor" value="{{ old('nombre_tutor') }}"
    required placeholder="---">

    <br><br>

    <label>PARENTESCO</label>
    <select name="parentesco_tutor" required>
         <option value=""
                selected disabled>SELECCIONE
              </option>
                <option value="Padre/Madre"
                 {{ old('parentesco_tutor')=='Padre/Madre' ? 'selected' : '' }}>
                 PADRE/MADRE
                </option>
                <option value="Abuelo(a)"
                {{ old('parentesco_tutor')=='Abuelo(a)' ? 'selected' : '' }}>
                 ABUELO(A)
                </option>
                <option value="Tutor"
                {{ old('parentesco_tutor')=='Tía' ? 'selected' : '' }}>
                 TUTOR 
                </option>
                <option value="OTRO"
                {{ old('parentesco_tutor')=='Otro' ? 'selected' : '' }}>
                 OTRO
                  </option>
    </select>

    <br><br>

    <label>TELÉFONO</label>
<!--En este input si se usa el required ya que los tutores si cuentan con telefono-->
    <input type="text" name="tel_tutor" id="tel3" value="{{ old('tel_tutor') }}"
    required placeholder="10 dígitos"
     pattern="[0-9]{10}">

    <br><br>

    <label>EMAIL</label>
<!--En este input si se usa el required ya que los tutores si cuentan con correo electronico-->
    <input type="email" name="email_tutor" id="email3" value="{{ old('email_tutor') }}"
    required placeholder="@">

    <br><br>

    <label>DIRECCIÓN</label>
    <input type="text" name="dir_tutor" value="{{ old('dir_tutor') }}"
    required placeholder="---">

    <br><br>

    <label>POBLACIÓN</label>
    <input type="text" name="poblacion_tutor" value="{{ old('poblacion_tutor') }}"
    required placeholder="---">

    <br><br>

    <label>MUNICIPIO</label>
    <input type="text" name="municipio_tutor" value="{{ old('municipio_tutor') }}"
    required placeholder="---">

    <br><br>

    <label>ESTADO</label>
    <input type="text" value="{{ session('estado') }}"
             readonly>

     <input type="hidden" name="estado_tutor" value="{{ session('estado') }}">
    
    <br><br>

    <label>CÓDIGO POSTAL</label>
    <input type="text" name="cp_tutor" id="cp_tutor"value="{{ old('cp_tutor') }}"
    maxlength="5"
    placeholder="---" required>

</fieldset>
    <br>

   <button
    type="button"
    onclick="window.location='{{ route('semillero.dashboard') }}'">

    Atrás

</button>

    <button type="submit">
    Agregar
</button>

</form>
<script src="{{ asset('js/semilleros/nacional.js') }}"></script>
<script src="{{ asset('js/semilleros/hablante.js') }}"></script>
<script src="{{ asset('js/semilleros/nivelGrado.js') }}"></script>
<script src="{{ asset('js/semilleros/validarCurp.js') }}"></script>
<script src="{{ asset('js/semilleros/validarCorreo.js') }}"></script>
<script src="{{ asset('js/semilleros/validarTel.js') }}"></script>
<script src="{{ asset('js/semilleros/clave_de_escuela.js') }}"></script>
<script src="{{ asset('js/semilleros/cp.js') }}"></script>
</body>
<footer>
    <div style="text-align:center;padding:1em 0;">
        <strong>Sistema Nacional de Fomento Musical 2025</strong>
        <h5 style="color:gray;">Hora actual en Mexico City, México</h5>
        <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=small&timezone=America%2FMexico_City" </iframe>
    </div>
</footer>
</html>