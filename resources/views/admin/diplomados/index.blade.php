<h1>Panel de Diplomados</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('admin.diplomados.create') }}">
    Crear diplomado
</a>

<hr>

@foreach ($diplomados as $diplomado)
    <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px;">
        <h3>{{ $diplomado->nombre }}</h3>

        <p>{{ $diplomado->descripcion }}</p>

        <p>
            <strong>Duración:</strong> {{ $diplomado->duracion }}
        </p>

        <p>
            <strong>Estado:</strong> {{ $diplomado->estado }}
        </p>

        <a href="{{ route('admin.diplomados.show', $diplomado) }}">
            Ver diplomado
        </a>
    </div>
@endforeach
