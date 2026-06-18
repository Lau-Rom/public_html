<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DocenteController;

// Redirigir al login al entrar al sistema
Route::redirect('/', '/login');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

//AQUI CAMBIAR AL NOMBRE REAL DE TU VISTA
Route::get('/semillero/ejemplo_panel', function () {
    if (session('tipo_usuario') !== 'semillero') {
        return redirect()->route('login');
    }

    return view('semillero.ejemplo_panel');
})->name('semillero.ejemplo_panel');


// Panel administrador
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('docentes', DocenteController::class);
});

// Panel semillero


// Panel docente
