<x-app-layout>
    <div class="buscar-docentes-dashboard">
        <div class="buscar-docentes-content">

            <div class="docentes-header">
                <div class="docentes-header-text">
                    <h1>Buscar docente</h1>
                    <p>Consulta docentes registrados por CURP, correo, usuario o nombre.</p>
                </div>

                <div class="docentes-header-actions">
                    <span class="docentes-total">
                        Total: {{ $totalDocentes }} docentes
                    </span>

                    <a href="{{ route('admin.docentes.index') }}" class="btn-atras">
                        Salir
                    </a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
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
                            <th>Acciones</th>
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

                                <td class="docentes-actions">
                                    <a href="{{ route('admin.docentes.show', $docente->id) }}" class="btn-ver">
                                        Ver
                                    </a>

                                    <a href="{{ route('admin.docentes.edit', $docente->id) }}" class="btn-editar">
                                        Editar
                                    </a>

                                    <form action="{{ route('admin.docentes.destroy', $docente->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-eliminar"
                                            onclick="return confirm('¿Seguro que deseas eliminar este docente?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="docentes-empty">
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
