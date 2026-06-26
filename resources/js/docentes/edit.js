
const editarCuenta = document.getElementById('editarCuenta');
const cuentaForm = document.getElementById('cuentaForm');

const usuario = document.getElementById('usuario');
const contrasena = document.getElementById('contrasena');
const confirmar = document.getElementById('contrasena_confirmation');

function actualizarEstadoCuenta() {

    const habilitado = editarCuenta.checked;

    usuario.disabled = !habilitado;
    contrasena.disabled = !habilitado;
    confirmar.disabled = !habilitado;

    cuentaForm.classList.toggle('cuenta-deshabilitada', !habilitado);

    if (!habilitado) {
        contrasena.value = '';
        confirmar.value = '';
    }
}

editarCuenta.addEventListener('change', actualizarEstadoCuenta);

// Estado inicial al abrir la página
actualizarEstadoCuenta();