const cpInput = document.getElementById('cp_tutor');

cpInput.addEventListener('input', function() {
    // eliminar todo lo que no sea número
    this.value = this.value.replace(/[^0-9]/g, '');

    // limitar a 5 dígitos
    if (this.value.length > 5) {
        this.value = this.value.slice(0,5);
    }

    // revisar si ya existe el mensaje
    let existingMsg = document.getElementById('cp_error');
    if (this.value.length < 5) {
        if (!existingMsg) {
            const msg = document.createElement('small');
            msg.id = 'cp_error';
            msg.style.color = 'red';
            msg.textContent = 'El código postal debe tener 5 dígitos';
            this.insertAdjacentElement('afterend', msg);
        }
    } else {
        if (existingMsg) {
            existingMsg.remove();
        }
    }
});