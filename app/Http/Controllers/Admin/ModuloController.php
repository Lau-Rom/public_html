<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modulo;

class ModuloController extends Controller
{
    public function show(Modulo $modulo)
    {
        $modulo->load('materiales', 'diplomado');

        return view('admin.modulos.show', compact('modulo'));
    }
}
