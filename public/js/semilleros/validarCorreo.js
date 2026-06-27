//Este scrip verifica que tenga un formato válido del email antes de enviar el formulario, si esque el usuario decide agregar uno
const formulario = document.getElementById('loginform');
const emailInputs = [
    document.getElementById('email1'),
    document.getElementById('email2'),
    document.getElementById('email3')
];

formulario.addEventListener('submit', function(event) {
    eliminarMensajesError(); // limpiar mensajes previos
    let valido = true;

    emailInputs.forEach(input => {
        if (!validarEmail(input)) {
            valido = false;
        }
    });

    if (!valido) {
        event.preventDefault(); // si alguno es inválido, no enviamos
    }
});

function validarEmail(input) {
    const email = input.value.trim();
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Si está vacío, es válido porque es opcional
    if (email === '') {
        return true;
    }

    if (!regex.test(email)) {
        mostrarMensajeError(input, 'Formato de correo inválido');
        return false;
    }

    return true;
}

function mostrarMensajeError(input, mensaje) {
    const span = document.createElement('span');
    span.className = 'error-email';
    span.style.color = 'red';
    span.style.fontSize = '0.9em';
    span.innerText = mensaje;
    input.parentNode.appendChild(span);
}

function eliminarMensajesError() {
    document.querySelectorAll('.error-email').forEach(e => e.remove());
}

