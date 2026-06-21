<h1>Crear diplomado</h1>

@if ($errors->any())
    <div style="color: red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('admin.diplomados.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Nombre del diplomado</label>
    <br>
    <input type="text" name="nombre" required>
    <br><br>

    <label>Descripción</label>
    <br>
    <textarea name="descripcion"></textarea>
    <br><br>

    <label>Duración</label>
    <br>
    <input type="text" name="duracion" placeholder="Ejemplo: 40 horas">
    <br><br>

    <label>Fecha de inicio</label>
    <br>
    <input type="date" name="fecha_inicio">
    <br><br>

    <label>Fecha de fin</label>
    <br>
    <input type="date" name="fecha_fin">
    <br><br>

    <label>Imagen de portada</label>
    <br>
    <input type="file" name="imagen">
    <br><br>

    <label>Estado</label>
    <br>
    <select name="estado">
        <option value="activo">Activo</option>
        <option value="inactivo">Inactivo</option>
    </select>
    <br><br>

    <button type="submit">Guardar diplomado</button>
</form>
