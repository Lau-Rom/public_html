<x-app-layout>

    <div style="padding:40px;">

        <a href="{{ route('admin.diplomados.show', $modulo->diplomado) }}">
            ← Volver al diplomado
        </a>

        <h1>Módulo {{ $modulo->orden }}: {{ $modulo->titulo }}</h1>

        <p>{{ $modulo->descripcion }}</p>

        <h2>Materiales del módulo</h2>

        @foreach ($modulo->materiales as $material)
            <div>
                <strong>{{ $material->titulo }}</strong>
                <br>
                Tipo: {{ $material->tipo }}
            </div>
            <br>
        @endforeach

    </div>

</x-app-layout>
