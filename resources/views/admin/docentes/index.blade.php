<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success alert-fixed">
            {{ session('success') }}
        </div>
    @endif

    <div class="docentes-dashboard">

        <div class="docentes-container">

            <div class="docentes-header">
                <h1>Panel de Docentes</h1>
                <p>Selecciona la acción que deseas realizar.</p>
            </div>

            <div class="docentes-menu-grid">

                <a href="{{ route('admin.docentes.create') }}" class="docentes-menu-card">
                    <span>+</span>
                    <h3>Agregar docente</h3>
                    <p>Registrar un nuevo docente en el sistema.</p>
                </a>

                <a href="{{ route('admin.docentes.buscar') }}" class="docentes-menu-card">
                    <span>🔍</span>
                    <h3>Buscar docente</h3>
                    <p>Consultar docentes registrados.</p>
                </a>

                <a href="#" class="docentes-menu-card">
                    <span>✏️</span>
                    <h3>Modificar docente</h3>
                    <p>Actualizar información de un docente.</p>
                </a>

                <a href="#" class="docentes-menu-card">
                    <span>🗑️</span>
                    <h3>Eliminar docente</h3>
                    <p>Dar de baja o eliminar un docente.</p>
                </a>

                <a href="#" class="docentes-menu-card">
                    <span>📋</span>
                    <h3>Pase de lista</h3>
                    <p>Consultar la asistencia de los docentes.</p>
                </a>

            </div>

        </div>

    </div>

</x-app-layout>
