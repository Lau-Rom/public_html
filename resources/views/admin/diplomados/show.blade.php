<h1>{{ $diplomado->nombre }}</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<p>{{ $diplomado->descripcion }}</p>

<p>
    <strong>Duración:</strong> {{ $diplomado->duracion }}
</p>

<p>
    <strong>Estado:</strong> {{ $diplomado->estado }}
</p>

@if ($diplomado->imagen)
    <img src="{{ asset('storage/' . $diplomado->imagen) }}" width="250">
@endif

<hr>

<h2>Agregar módulo</h2>

<form action="{{ route('admin.diplomados.modulos.store', $diplomado) }}" method="POST">
    @csrf

    <label>Título del módulo</label>
    <br>
    <input type="text" name="titulo" required>
    <br><br>

    <label>Descripción</label>
    <br>
    <textarea name="descripcion"></textarea>
    <br><br>

    <label>Orden</label>
    <br>
    <input type="number" name="orden" value="1">
    <br><br>

    <button type="submit">Guardar módulo</button>
</form>

<hr>

<h2>Módulos del diplomado</h2>

@foreach ($diplomado->modulos as $modulo)
    <div style="border: 1px solid #999; padding: 15px; margin-bottom: 20px;">
        <h3>Módulo {{ $modulo->orden }}: {{ $modulo->titulo }}</h3>

        <p>{{ $modulo->descripcion }}</p>

        <h4>Subir material</h4>

        <form action="{{ route('admin.diplomados.materiales.store', $modulo) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <label>Título del material</label>
            <br>
            <input type="text" name="titulo" required>
            <br><br>

            <label>Descripción</label>
            <br>
            <textarea name="descripcion"></textarea>
            <br><br>

            <label>Tipo</label>
            <br>
            <select name="tipo" required>
                <option value="pdf">PDF</option>
                <option value="infografia">Infografía</option>
                <option value="video">Video</option>
                <option value="documento">Documento</option>
                <option value="link">Link</option>
            </select>
            <br><br>

            <label>Archivo</label>
            <br>
            <input type="file" name="archivo">
            <br><br>

            <label>URL de video o enlace</label>
            <br>
            <input type="url" name="url">
            <br><br>

            <button type="submit">Guardar material</button>
        </form>

        <h4>Materiales cargados</h4>

        @foreach ($modulo->materiales as $material)
            <div style="margin-left: 20px;">
                <strong>{{ $material->titulo }}</strong>
                <br>
                Tipo: {{ $material->tipo }}

                @if ($material->archivo)
                    <br>
                    <a href="{{ asset('storage/' . $material->archivo) }}" target="_blank">
                        Ver archivo
                    </a>
                @endif

                @if ($material->url)
                    <br>
                    <a href="{{ $material->url }}" target="_blank">
                        Ver enlace
                    </a>
                @endif
            </div>
            <br>
        @endforeach
    </div>
@endforeach

<a href="{{ route('admin.diplomados.index') }}">
    Volver al panel
</a>
