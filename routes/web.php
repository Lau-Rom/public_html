<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DocenteController;
use App\Http\Controllers\Admin\DiplomadoController;
use App\Http\Controllers\Admin\ModuloDiplomadoController;
use App\Http\Controllers\Admin\MaterialDiplomadoController;

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

Route::get('/docente/menu_docente', function () {
    if (session('tipo_usuario') !== 'docente') {
        return redirect()->route('login');
    }

    return view('docente.menu_docente');
})->name('docente.menu_docente');


// Panel administrador
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('docentes/buscar', [DocenteController::class, 'buscar'])
        ->name('docentes.buscar');

    Route::resource('docentes', DocenteController::class);
});

Route::prefix('admin/diplomados')->name('admin.diplomados.')->group(function () {
    Route::get('/', [DiplomadoController::class, 'index'])->name('index');
    Route::get('/crear', [DiplomadoController::class, 'create'])->name('create');
    Route::post('/guardar', [DiplomadoController::class, 'store'])->name('store');
    Route::get('/{diplomado}', [DiplomadoController::class, 'show'])->name('show');

    Route::post('/{diplomado}/modulos', [ModuloDiplomadoController::class, 'store'])->name('modulos.store');

    Route::post('/modulos/{modulo}/materiales', [MaterialDiplomadoController::class, 'store'])->name('materiales.store');
});

// Panel semillero


// Panel docente
