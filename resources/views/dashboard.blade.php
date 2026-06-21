<x-app-layout>

    <div class="admin-dashboard">

        <div class="admin-layout">
            <div class="admin-welcome-card">
                <h1>Bienvenido</h1>
                <p>{{ Auth::user()->name }}</p>
                <p>{{ Auth::user()->rol }}</p>
            </div>

            <aside>
                @include('admin.menu')
            </aside>


        </div>

    </div>

</x-app-layout>
