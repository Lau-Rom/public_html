<x-app-layout>
    <div class="buscar-docentes-dashboard">
        <div class="buscar-docentes-content">

            <div class="docentes-header">
                <div>
                    <h1>Buscar docente</h1>
                    <p>Consulta docentes registrados por CURP, correo, usuario o nombre.</p>
                </div>

                <span class="docentes-total">
                    Total de docentes: {{ $totalDocentes }}
                </span>
            </div>

            <form method="GET" action="{{ route('admin.docentes.buscar') }}" class="docentes-search-form">
                <input type="text" name="buscar" value="{{ $busqueda }}" placeholder="Buscar..."
                    class="docentes-search-input">

                <button type="submit" class="docentes-search-btn">
                    Buscar
                </button>

                @if ($busqueda)
                    <a href="{{ route('admin.docentes.buscar') }}" class="docentes-clear-btn">
                        Limpiar
                    </a>
                @endif
            </form>

            <div class="docentes-table-box">
                <table class="docentes-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido paterno</th>
                            <th>Apellido materno</th>
                            <th>CURP</th>
                            <th>Correo</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($docentes as $docente)
                            <tr>
                                <td>{{ $docente->nombre }}</td>
                                <td>{{ $docente->apellido_paterno }}</td>
                                <td>{{ $docente->apellido_materno }}</td>
                                <td>{{ $docente->curp }}</td>
                                <td>{{ $docente->correo }}</td>
                                <td>{{ $docente->usuario }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="docentes-empty">
                                    No se encontraron docentes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
