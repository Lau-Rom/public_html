<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DocenteController;
use App\Http\Controllers\Admin\DiplomadoController;
use App\Http\Controllers\Admin\ModuloController;
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

// PANEL SEMILLERO
use App\Http\Controllers\Semillero\DashboardController;
use App\Http\Controllers\Semillero\IntegranteController;
use App\Http\Controllers\Semillero\BuscarController;
use App\Http\Controllers\Semillero\ConvocatoriaController;
use App\Http\Controllers\Semillero\MensajeController;

//agrega automaticamente semillero a las URl
Route::prefix('semillero')
    ->name('semillero.')
    ->group(
        function () {
            //ruta para el dashboard del semillero
            Route::get(
                '/dashboard',
                [DashboardController::class, 'index']
            )->name('dashboard');
            //ruta para mostrar el formulario de registro de un nuevo integrante
            Route::get(
                '/integrantes/agregar',
                [IntegranteController::class, 'create']
            )->name('integrantes.agregar');
            //ruta para recibir los datos del formulario de registro de un nuevo integrante
            Route::post(
                '/integrantes/agregar',
                [IntegranteController::class, 'store']
            )->name('integrantes.store');
            //ruta para buscar integrantes registrados en el sistema
            Route::get(
                '/integrantes/buscar',
                [BuscarController::class, 'index']
            )->name('integrantes.buscar');
            //ruta para ver los detalles de un integrante
            Route::get(
                '/integrantes/ver/{folio}',
                [BuscarController::class, 'ver']
            )->where('folio', '.*')
                ->name('integrantes.ver');
            //ruta para editar los detalles de un integrante
            Route::get(
                '/integrantes/{folio_semillero}/editar',
                [IntegranteController::class, 'edit']
            )->where('folio_semillero', '.*')
                ->name('integrantes.edit');
            //ruta para actualizar los detalles de un integrante que ya se encuentra registrado en el sistema y los guarda en la base de datos
            Route::put(
                '/integrantes/{folio_semillero}',
                [IntegranteController::class, 'update']
            )->where('folio_semillero', '.*')
                ->name('integrantes.update');
            //ruta para eliminar un integrante 
            Route::delete(
                '/integrantes/{folio_semillero}',
                [IntegranteController::class, 'destroy']
            )->where('folio_semillero', '.*')
                ->name('integrantes.destroy');
            //ruta para mostrar las convocatorias activas
            Route::get(
                '/convocatorias',
                [ConvocatoriaController::class, 'index']
            )->name('convocatorias');
            //ruta para mostrar los detalles de una convocatoria
            Route::get(
                '/convocatorias/{id}',
                [ConvocatoriaController::class, 'show']
            )->name('convocatorias.show');
            //ruta para mostrar el formulario de postulación a una convocatoria
            Route::get(
                '/convocatorias/{id}/postular',
                [ConvocatoriaController::class, 'postular']
            )->name('convocatorias.postular');

            Route::post(
                '/convocatorias/{id}/postular',
                [ConvocatoriaController::class, 'guardarPostulacion']
            )->name('convocatorias.guardarPostulacion');
            //ruta para mostrar los mensajes del semillero
            Route::get('/mensajes', function () {
                return view('semillero.mensajes.index');
            })->name('mensajes');

            Route::get(
                '/mensajes',
                [MensajeController::class, 'index']
            )->name('mensajes');
        }
    );

// Panel administrador
Route::prefix('admin')->name('admin.')->group(function () {

    // Buscar docentes
    Route::get('/docentes/buscar', [DocenteController::class, 'buscar'])
        ->name('docentes.buscar');

    // Descargar PDF
    Route::get('/docentes/{docente}/pdf', [DocenteController::class, 'pdf'])
        ->name('docentes.pdf');

    // CRUD completo
    Route::resource('docentes', DocenteController::class);
});

Route::prefix('admin/diplomados')->name('admin.diplomados.')->group(function () {

    Route::get('/', [DiplomadoController::class, 'index'])->name('index');

    Route::get('/crear', [DiplomadoController::class, 'create'])->name('create');

    Route::post('/guardar', [DiplomadoController::class, 'store'])->name('store');

    Route::get('/{diplomado}/edit', [DiplomadoController::class, 'edit'])->name('edit');

    Route::put('/{diplomado}', [DiplomadoController::class, 'update'])->name('update');

    Route::delete('/{diplomado}', [DiplomadoController::class, 'destroy'])->name('destroy');

    Route::post('/{diplomado}/modulos', [ModuloController::class, 'store'])->name('modulos.store');

    Route::get('/modulos/{modulo}', [ModuloController::class, 'show'])->name('modulos.show');

    Route::get('/modulos/{modulo}/edit', [ModuloController::class, 'edit'])->name('modulos.edit');

    Route::put('/modulos/{modulo}', [ModuloController::class, 'update'])->name('modulos.update');

    Route::delete('/modulos/{modulo}', [ModuloController::class, 'destroy'])->name('modulos.destroy');

    Route::get('/modulos/{modulo}/materiales/create', [MaterialDiplomadoController::class, 'create'])
        ->name('modulos.materiales.create');


    Route::post('/modulos/{modulo}/materiales', [MaterialDiplomadoController::class, 'store'])
        ->name('modulos.materiales.store');

    Route::delete('/materiales/{material}', [MaterialDiplomadoController::class, 'destroy'])
        ->name('modulos.materiales.destroy');
    Route::get('/materiales/{material}/edit', [MaterialDiplomadoController::class, 'edit'])
        ->name('modulos.materiales.edit');

    Route::put('/materiales/{material}', [MaterialDiplomadoController::class, 'update'])
        ->name('modulos.materiales.update');

    Route::get('/{diplomado}', [DiplomadoController::class, 'show'])
        ->name('show');
});

// Panel docente
