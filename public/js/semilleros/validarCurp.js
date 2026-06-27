

                // Función para validar CURP
                function validarCurp(curp) {
                    const regex = /^[A-ZÑ]{4}\d{6}[HM][A-Z]{2}[B-DF-HJ-NP-TV-Z]{3}[A-Z0-9]\d$/;
                    if (!regex.test(curp)) return false;

                    const yy = parseInt(curp.substring(4, 6));
                    const mm = parseInt(curp.substring(6, 8));
                    const dd = parseInt(curp.substring(8, 10));
                    const currentYY = new Date().getFullYear() % 100;
                    const year = (yy > currentYY ? 1900 : 2000) + yy;

                    const fecha = new Date(year, mm - 1, dd);
                    if (fecha.getFullYear() !== year || fecha.getMonth() + 1 !== mm || fecha.getDate() !== dd) {
                        return false;
                    }

                    return true;
                }

                // Función para validar fecha de nacimiento
                function validarFechaNacimiento(fechaStr) {
                    const fecha = new Date(fechaStr);
                    const hoy = new Date();

                    let edad = hoy.getFullYear() - fecha.getFullYear();
                    const mes = hoy.getMonth() - fecha.getMonth();
                    const dia = hoy.getDate() - fecha.getDate();

                    if (mes < 0 || (mes === 0 && dia < 0)) edad -= 1;

                    if (edad < 7) return {
                        valido: false,
                        msg: "❌ El alumno debe tener al menos 7 años."
                    };
                    if (edad > 100) return {
                        valido: false,
                        msg: "❌ La edad no puede ser mayor a 100 años."
                    };

                    return {
                        valido: true,
                        msg: ""
                    };
                }

                // Función principal para validar CURP y fecha
                function validarCurpForm() {
                    let esValido = true;

                    const curpInput = document.getElementById("curp_id");
                    const curpValue = curpInput.value.trim();
                    const msgCurp = document.getElementById("msg_curp");
                    const fechaInput = document.getElementById("fecha_nacimiento");
                    const msgFechaId = "msg_fecha";

                    let msgFecha = document.getElementById(msgFechaId);
                    if (!msgFecha) {
                        msgFecha = document.createElement("span");
                        msgFecha.id = msgFechaId;
                        msgFecha.style.color = "red";
                        fechaInput.parentNode.insertBefore(msgFecha, fechaInput.nextSibling);
                    }

                    // Validar CURP solo si está habilitado
                    if (!curpInput.disabled) {
                        if (!validarCurp(curpValue)) {
                            msgCurp.textContent = "❌ La CURP ingresada no es válida.";
                            esValido = false;
                        } else {
                            msgCurp.textContent = "";

                            // Extraer fecha de la CURP y completar automáticamente
                            const yy = parseInt(curpValue.substring(4, 6));
                            const mm = parseInt(curpValue.substring(6, 8));
                            const dd = parseInt(curpValue.substring(8, 10));
                            const currentYY = new Date().getFullYear() % 100;
                            const year = (yy > currentYY ? 1900 : 2000) + yy;

                            fechaInput.value = `${year.toString().padStart(4,'0')}-${mm.toString().padStart(2,'0')}-${dd.toString().padStart(2,'0')}`;
                        }
                    } else {
                        msgCurp.textContent = "";
                    }

                    // Validar fecha de nacimiento
                    if (fechaInput.value) {
                        const resultado = validarFechaNacimiento(fechaInput.value);
                        if (!resultado.valido) {
                            msgFecha.textContent = resultado.msg;
                            esValido = false;
                        } else {
                            msgFecha.textContent = "";
                        }
                    }

                    return esValido;
                }

                // Actualizar fecha automáticamente al cambiar CURP (si CURP es válida y no está deshabilitada)
                document.getElementById("curp_id").addEventListener("input", function() {
                    const curp = this.value.trim();
                    const fechaInput = document.getElementById("fecha_nacimiento");

                    if (!this.disabled && validarCurp(curp)) {
                        const yy = parseInt(curp.substring(4, 6));
                        const mm = parseInt(curp.substring(6, 8));
                        const dd = parseInt(curp.substring(8, 10));
                        const currentYY = new Date().getFullYear() % 100;
                        const year = (yy > currentYY ? 1900 : 2000) + yy;
                        fechaInput.value = `${year.toString().padStart(4,'0')}-${mm.toString().padStart(2,'0')}-${dd.toString().padStart(2,'0')}`;
                    }
                });
