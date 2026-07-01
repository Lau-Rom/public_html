import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.addEventListener('DOMContentLoaded', function () {
    const editor = document.querySelector('#descripcionMateriales');

    if (editor) {
        ClassicEditor.create(editor, {
            toolbar: {
                removeItems: [
                    'uploadImage',
                    'insertTable',
                    'blockQuote',
                    'mediaEmbed'
                ]
            }
        }).catch(error => console.error(error));
    }

    const tipo = document.getElementById('tipo');
    const campoArchivo = document.querySelector('.campo-archivo');
    const campoUrl = document.querySelector('.campo-url');
    const campoDescripcion = document.querySelector('.campo-descripcion');

    const archivo = document.getElementById('archivo');
    const url = document.getElementById('url');
    const descripcion = document.getElementById('descripcionMateriales');

    const labelDescripcion = document.getElementById('label-descripcion');
    const labelUrl = document.getElementById('label-url');

    function actualizarCampos() {
        const valor = tipo.value;

        campoArchivo.style.display = 'none';
        campoUrl.style.display = 'none';
        campoDescripcion.style.display = 'block';

        archivo.required = false;
        url.required = false;
        descripcion.required = false;

        labelDescripcion.textContent = 'Descripción';
        descripcion.placeholder = 'Describe brevemente el contenido del material...';
        labelUrl.textContent = 'URL del material';

        if (valor === 'archivo') {
            campoArchivo.style.display = 'block';

            if (!archivo.dataset.edit) {
                archivo.required = true;
            }
        }

        if (valor === 'enlace') {
            campoUrl.style.display = 'block';
            url.required = true;
            labelUrl.textContent = 'URL del enlace';
            url.placeholder = 'https://ejemplo.com/material';
        }

        if (valor === 'video') {
            campoUrl.style.display = 'block';
            url.required = true;
            labelUrl.textContent = 'URL del video';
            url.placeholder = 'https://youtube.com/...';
        }

        if (valor === 'texto') {
    labelDescripcion.textContent = 'Contenido del material';
    descripcion.placeholder = 'Escribe aquí el contenido que verá el alumno...';
}

        if (valor === '') {
            campoArchivo.style.display = 'none';
            campoUrl.style.display = 'none';
            campoDescripcion.style.display = 'none';
        }
    }

    tipo.addEventListener('change', actualizarCampos);
    actualizarCampos();
});