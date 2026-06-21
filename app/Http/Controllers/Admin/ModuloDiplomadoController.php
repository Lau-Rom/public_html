<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diplomado;
use App\Models\ModuloDiplomado;
use Illuminate\Http\Request;

class ModuloDiplomadoController extends Controller
{
    public function store(Request $request, Diplomado $diplomado)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'orden' => 'nullable|integer',
        ]);

        $diplomado->modulos()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'orden' => $request->orden ?? 1,
        ]);

        return back()->with('success', 'Módulo agregado correctamente.');
    }
}
