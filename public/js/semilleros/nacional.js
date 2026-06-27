
                //Este escrip es para habilitar o deshabilitar la curp dependiendo de la nacionalidad
                document.addEventListener("DOMContentLoaded", () => {
                    const nacionalidad = document.getElementById("nacionalidad");
                    const curp = document.getElementById("curp_id");

                    function toggleCurp() {
                        if (nacionalidad.value === "Extranjero") {
                            curp.value = "";
                            curp.disabled = true; // deshabilitado (gris, no se puede escribir)
                            curp.required = false; // ya no es obligatorio
                        } else {
                            curp.disabled = false; // habilitado
                            curp.required = true; // obligatorio
                        }
                    }

                    nacionalidad.addEventListener("change", toggleCurp);
                    toggleCurp(); // se ejecuta al cargar
                });
