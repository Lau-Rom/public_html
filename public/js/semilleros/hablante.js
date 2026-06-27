
    // Capturamos radios y el select
    const radios = document.querySelectorAll('input[name="hablante"]');
    const lenguaInput = document.getElementById('lengua');

    function toggleLengua() {
        const seleccionado = document.querySelector('input[name="hablante"]:checked');
        if (!seleccionado) return;

        // Normalizamos a minúsculas para evitar problemas con "Sí" / "SÍ"
        if (seleccionado.value.toLowerCase() === 'sí') {
            lenguaInput.disabled = false;
            lenguaInput.required = true;
        } else {
            lenguaInput.disabled = true;
            lenguaInput.required = false;
            lenguaInput.value = ""; // limpia selección si tenía algo
        }
    }

    // Escuchar cambios
    radios.forEach(radio => {
        radio.addEventListener('change', toggleLengua);
    });

    // Ejecutar al cargar para mantener coherencia inicial
    toggleLengua();

function habilitarSelect(activar) {
    document.getElementById('lengua').disabled = !activar;
    if (!activar) {
        document.getElementById('lengua').value = ''; // vuelve al placeholder
    }
}