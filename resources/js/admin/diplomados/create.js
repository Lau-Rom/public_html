import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.addEventListener('DOMContentLoaded', () => {

    // Inicializar todos los textareas con CKEditor
   
    ['#descripcion', '#descripcionModulo,#descripcionDiplomadoEdit','#descripcionMateriales'].forEach(selector => {

    const editor = document.querySelector(selector);

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
        })
        .catch(error => console.error(error));
    }

});

    // Vista previa de la imagen
    const input = document.getElementById('imagen');
    const preview = document.getElementById('preview');
    const uploadContent = document.querySelector('.upload-content');

    if (input && preview && uploadContent) {

        input.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) return;

            const reader = new FileReader();

            reader.onload = function (e) {

                preview.src = e.target.result;
                preview.style.display = "block";
                uploadContent.style.display = "none";

            };

            reader.readAsDataURL(file);

        });

    }

});