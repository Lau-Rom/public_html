
       document.addEventListener('DOMContentLoaded', function() {

    const nacionalidad = document.getElementById('nacionalidad_id');
    const curp = document.getElementById('curp');
    const fechaNacimiento = document.getElementById('fecha_nacimiento');
    const genero = document.getElementById('genero_id');
    const telefono = document.querySelector('[name="telefono"]');
    const correo = document.getElementById('correo');
    const claveTrabajo = document.querySelector('[name="clave_trabajo"]');

    const camposSoloLetras = [
        'nombre',
        'apellido_paterno',
        'apellido_materno'
    ];

   camposSoloLetras.forEach(name => {
    const input = document.querySelector(`[name="${name}"]`);

    if (input) {

        input.value = input.value
            .replace(/[^a-zA-ZÁÉÍÓÚáéíóúÑñ\s]/g, '')
            .replace(/\s+/g, ' ')
            .toUpperCase();

        input.addEventListener('input', function() {
            this.value = this.value
                .replace(/[^a-zA-ZÁÉÍÓÚáéíóúÑñ\s]/g, '')
                .replace(/\s+/g, ' ')
                .toUpperCase();
        });
    }
});

    if (telefono) {
        telefono.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });
    }

    if (correo) {
        correo.addEventListener('input', function() {
            this.value = this.value
                .trim()
                .toLowerCase()
                .replace(/\s/g, '');
        });
    }

    if (claveTrabajo) {
        claveTrabajo.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    }

   if (nacionalidad) {
    nacionalidad.addEventListener('change', function() {
        validarNacionalidad(true);
    });

    validarNacionalidad(false);
}

    if (curp) {
        curp.addEventListener('input', function() {
            this.value = this.value
                .replace(/[^a-zA-Z0-9]/g, '')
                .toUpperCase()
                .slice(0, 18);

            if (this.value.length >= 10) {
                generarFechaDesdeCurp(this.value);
            } else {
                fechaNacimiento.value = '';
            }

            if (this.value.length >= 11) {
                generarGeneroDesdeCurp(this.value);
            } else {
                genero.value = '';
            }
        });
    }

    function validarNacionalidad(limpiarCampos = false) {
        const opcion = nacionalidad.options[nacionalidad.selectedIndex];

        const nombre = opcion.dataset.nombre ?
            opcion.dataset.nombre.toLowerCase().trim() :
            '';

        const esMexicana = nombre === 'mexicano';

        if (esMexicana) {
            curp.disabled = false;
            curp.required = true;

            fechaNacimiento.required = true;
            fechaNacimiento.readOnly = true;

            if (limpiarCampos) {
                fechaNacimiento.value = '';
            }

            curp.style.backgroundColor = '#ffffff';
            curp.style.color = '#111827';
            curp.style.cursor = 'text';
            curp.placeholder = 'Ingresa la CURP';

        } else {
            if (limpiarCampos) {
                curp.value = '';
                genero.value = '';
                fechaNacimiento.value = '';
            }

            curp.disabled = true;
            curp.required = false;

            fechaNacimiento.required = true;
            fechaNacimiento.readOnly = false;

            curp.style.backgroundColor = '#e5e7eb';
            curp.style.color = '#6b7280';
            curp.style.cursor = 'not-allowed';
            curp.placeholder = 'CURP no requerida para extranjeros';
        }
    }

    function generarFechaDesdeCurp(curpValor) {
        const anio = curpValor.substring(4, 6);
        const mes = curpValor.substring(6, 8);
        const dia = curpValor.substring(8, 10);

        if (!/^\d{2}$/.test(anio) || !/^\d{2}$/.test(mes) || !/^\d{2}$/.test(dia)) {
            fechaNacimiento.value = '';
            return;
        }

        const anioActualCompleto = new Date().getFullYear();
        const anioActualDosDigitos = anioActualCompleto % 100;

        const siglo = parseInt(anio) <= anioActualDosDigitos ? '20' : '19';

        const anioCompleto = parseInt(`${siglo}${anio}`);
        const mesNumero = parseInt(mes);
        const diaNumero = parseInt(dia);

        const fecha = `${anioCompleto}-${mes}-${dia}`;
        const fechaObj = new Date(anioCompleto, mesNumero - 1, diaNumero);

        const fechaEsValida =
            fechaObj.getFullYear() === anioCompleto &&
            fechaObj.getMonth() + 1 === mesNumero &&
            fechaObj.getDate() === diaNumero;

        if (!fechaEsValida) {
            fechaNacimiento.value = '';
            return;
        }

        const edad = calcularEdad(fecha);

        if (edad <= 0) {
            alert('No puedes registrar una persona con 0 años de edad o menor.');
            fechaNacimiento.value = '';
            curp.value = '';
            genero.value = '';
            return;
        }

        fechaNacimiento.value = fecha;
    }

    function calcularEdad(fecha) {
        const nacimiento = new Date(fecha + 'T00:00:00');
        const hoy = new Date();

        let edad = hoy.getFullYear() - nacimiento.getFullYear();

        const mesActual = hoy.getMonth();
        const diaActual = hoy.getDate();

        const mesNacimiento = nacimiento.getMonth();
        const diaNacimiento = nacimiento.getDate();

        if (
            mesActual < mesNacimiento ||
            (mesActual === mesNacimiento && diaActual < diaNacimiento)
        ) {
            edad--;
        }

        return edad;
    }

    function generarGeneroDesdeCurp(curpValor) {
        const sexo = curpValor.charAt(10);

        if (sexo !== 'H' && sexo !== 'M') {
            genero.value = '';
            return;
        }

        const opcionesGenero = genero.options;

        for (let i = 0; i < opcionesGenero.length; i++) {
            const opcion = opcionesGenero[i];

            const nombreGenero = opcion.dataset.nombre ?
                opcion.dataset.nombre.toLowerCase().trim() :
                '';

            if (sexo === 'H' && (nombreGenero === 'hombre' || nombreGenero === 'masculino')) {
                genero.value = opcion.value;
                return;
            }

            if (sexo === 'M' && (nombreGenero === 'mujer' || nombreGenero === 'femenino')) {
                genero.value = opcion.value;
                return;
            }
        }
    }

    validarNacionalidad(false);

});