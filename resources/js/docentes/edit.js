
    const editarCuenta = document.getElementById('editarCuenta');
    const usuario = document.getElementById('usuario');
    const contrasena = document.getElementById('contrasena');
    const confirmar = document.getElementById('contrasena_confirmation');

    editarCuenta.addEventListener('change', function () {
        usuario.disabled = !this.checked;
        contrasena.disabled = !this.checked;
        confirmar.disabled = !this.checked;

        if (!this.checked) {
            contrasena.value = '';
            confirmar.value = '';
        }
    });
