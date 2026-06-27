
const nivelSelect = document.getElementById("nivel");
const grado1 = document.getElementById("grado1");
const grado2 = document.getElementById("grado2");
const grado3 = document.getElementById("grado3");
const nivelFinal = document.getElementById("nivel_escuela_final");
const gradoFinal = document.getElementById("grado_escuela_final");

function activarGrados() {
    let nivel = nivelSelect.value;

    // Deshabilitar todos
    grado1.disabled = true;
    grado1.removeAttribute("required");
    grado2.disabled = true;
    grado2.removeAttribute("required");
    grado3.disabled = true;
    grado3.removeAttribute("required");

    // Limpiar input "Otro" si no corresponde
    if (nivel !== "Otro") {
        grado3.value = "";
        if (gradoFinal.value === grado3.value) gradoFinal.value = "";
    }

    // Activar solo el que corresponde según el nivel
    if (nivel === "Primaria") {
        grado1.disabled = false;
        grado1.setAttribute("required", true);
        gradoFinal.value = grado1.value; // actualizar hidden
    } else if (nivel === "Secundaria" || nivel === "Bachiller") {
        grado2.disabled = false;
        grado2.setAttribute("required", true);
        gradoFinal.value = grado2.value; // actualizar hidden
    } else if (nivel === "Otro") {
        grado3.disabled = false;
        grado3.setAttribute("required", true);
        gradoFinal.value = grado3.value; // mantener lo que haya escrito
    }

    // Guardar nivel en hidden
    nivelFinal.value = nivel;
}

// Actualizar hidden cuando cambien los grados
grado1.addEventListener("change", () => gradoFinal.value = grado1.value);
grado2.addEventListener("change", () => gradoFinal.value = grado2.value);
grado3.addEventListener("input", () => gradoFinal.value = grado3.value);

// Listener para nivel
nivelSelect.addEventListener("change", activarGrados);

// Ejecutar al cargar la página
window.addEventListener("DOMContentLoaded", () => {
    activarGrados();

    // Asegurar que hidden de grado tenga el valor precargado en edición
    if (nivelSelect.value === "Primaria") {
        gradoFinal.value = grado1.value;
    } else if (nivelSelect.value === "Secundaria" || nivelSelect.value === "Bachiller") {
        gradoFinal.value = grado2.value;
    } else if (nivelSelect.value === "Otro") {
        gradoFinal.value = grado3.value;
    }
});

// Validación extra para "Otro"
document.getElementById("loginform").addEventListener("submit", function(e) {
    if (nivelSelect.value === "Otro" && grado3.value.trim() === "") {
        alert("Por favor, escriba el grado en 'ESPECIFIQUE'");
        grado3.focus();
        e.preventDefault();
    }
});


