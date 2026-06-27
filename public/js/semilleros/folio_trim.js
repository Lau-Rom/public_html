// Este script es para quitar los espacios del folio que se ingrege en buscar
function trimFolio() {
    const input = document.getElementById('buscar');
    if (input) {
        input.value = input.value.trim(); // elimina espacios al inicio y al final
    }
    return true; // importante para que el formulario se envíe
}
