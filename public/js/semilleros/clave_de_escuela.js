
(function(){
  const input = document.getElementById('clave_escuela');
  const feedback = document.getElementById('cct_feedback');

  function validarCCT(raw) {
    if (!raw) return { ok: false, msg: 'La CCT no puede estar vacía.' };

    const cct = raw.toUpperCase().replace(/\s+/g,'');
    if (cct.length !== 10) return { ok: false, msg: 'La CCT debe tener exactamente 10 caracteres.' };

    // 1-2: entidad federativa numérica (00-32)
    const entidad = cct.slice(0,2);
    if (!/^\d{2}$/.test(entidad)) return { ok: false, msg: 'Los dos primeros caracteres deben ser dígitos (código de entidad).' };
    const entidadNum = parseInt(entidad, 10);
    if (entidadNum < 0 || entidadNum > 32) return { ok: false, msg: 'El código de entidad debe estar entre 00 y 32.' };

    // 3: tipo de escuela
    const tipoEscuela = cct.charAt(2);
    if (!/^[EDKUG]$/.test(tipoEscuela)) return { ok: false, msg: 'El tercer carácter debe ser E (Estatal), D (Federal/Desconcentrada), K (CONAFE), U (UNAM) o G (CETIS).' };

    // 4-5: tipo de servicio (solo letras A-Z)
    const servicio = cct.slice(3,5);
    if (!/^[A-Z]{2}$/.test(servicio)) return { ok: false, msg: 'Los caracteres 4 y 5 deben ser letras (A-Z).' };

    // 6-9: número
    const numero = cct.slice(5,9);
    if (!/^\d{4}$/.test(numero)) return { ok: false, msg: 'Los caracteres 6 a 9 deben ser un número de 4 dígitos.' };

    // 10: letra
    const ultima = cct.charAt(9);
    if (!/^[A-Z]$/.test(ultima)) return { ok: false, msg: 'El último carácter debe ser una letra (A-Z).' };

    return { ok: true, msg: 'CCT con formato válido.', value: cct };
  }

  function mostrarMensaje(result) {
    if (result.ok) {
      feedback.style.color = '#0a0';
      feedback.textContent = result.msg;
    } else {
      feedback.style.color = '#b00';
      feedback.textContent = result.msg;
    }
  }

  input.addEventListener('blur', () => {
    const res = validarCCT(input.value);
    mostrarMensaje(res);
    if (res.ok) input.value = res.value;
  });

  input.addEventListener('input', () => {
    feedback.textContent = '';
  });

  const form = input.closest('form');
  if (form) {
    form.addEventListener('submit', function(e){
      const res = validarCCT(input.value);
      if (!res.ok) {
        e.preventDefault();
        mostrarMensaje(res);
        input.focus();
      } else {
        input.value = res.value;
      }
    });
  }

  window.validarCCT = validarCCT;
})();
