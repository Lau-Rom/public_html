//Este scrip verifica que tenga un formato válido del tel antes de enviar el formulario, si esque el usuario decide agregar uno

// Capturamos los 3 inputs de teléfono
const telInputs = [
    document.getElementById('tel1'),
    document.getElementById('tel2'),
    document.getElementById('tel3')
];

// Validar cuando se intenta enviar el formulario
const formularioTel = document.getElementById('loginform');
formularioTel.addEventListener('submit', function(event) {
    eliminarMensajesErrorTel(); // Limpiar mensajes previos
    let valido = true;

    telInputs.forEach(input => {
        if (!validarTelefono(input)) {
            valido = false;
        }
    });

    if (!valido) {
        event.preventDefault(); // Evitar envío si alguno falla
    }
});

function validarTelefono(input) {
    const tel = input.value.trim();

    if (tel === '') return true; // Opcional

    if (!/^\d{10}$/.test(tel)) {
        mostrarMensajeErrorTel(input, 'El teléfono debe tener 10 dígitos');
        return false;
    }

    return true;
}

function mostrarMensajeErrorTel(input, mensaje) {
    const span = document.createElement('span');
    span.className = 'error-tel';
    span.style.color = 'red';
    span.style.fontSize = '0.9em';
    span.innerText = mensaje;
    input.parentNode.appendChild(span);
}

function eliminarMensajesErrorTel() {
    document.querySelectorAll('.error-tel').forEach(e => e.remove());
}

