@if (Auth::user()->rol == 'super-admin')
    <div class="admin-menu-box">

        <h3>Menú</h3>

        <ul>
            <a href="#">Crear administradores</a>
            <a href="#">Crear semilleros</a>
            <a href="{{ route('admin.docentes.index') }}">Crear docentes</a>
            <a href="#">Convocatorias</a>
            <a href="#">Estadísticas</a>
            <a href="{{ route('admin.diplomados.index') }}">Diplomados</a>
        </ul>

    </div>
@elseif(Auth::user()->rol == 'admin')
    <div class="admin-menu-box">

        <h3>Menú</h3>

        <ul>
            <li><a href="#">Estadísticas</a></li>
        </ul>

    </div>
@endif
