<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DocenteController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';


// Panel administrador
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('docentes', DocenteController::class);
});

// Panel semillero


// Panel docente
