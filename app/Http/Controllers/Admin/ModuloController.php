<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diplomado;
use App\Models\ModuloDiplomado;
use Illuminate\Http\Request;

class ModuloController extends Controller
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

        return redirect()->back()->with('success', 'Módulo creado correctamente.');
    }

    public function show(ModuloDiplomado $modulo)
    {
        $modulo->load('materiales', 'diplomado');

        return view('admin.diplomados.modulos.show', compact('modulo'));
    }
    public function destroy(ModuloDiplomado $modulo)
    {
        $diplomado = $modulo->diplomado;

        $modulo->delete();

        return redirect()
            ->route('admin.diplomados.show', $diplomado)
            ->with('success', 'Módulo eliminado correctamente.');
    }
    public function edit(ModuloDiplomado $modulo)
    {
        return view('admin.diplomados.modulos.edit', compact('modulo'));
    }
    public function update(Request $request, ModuloDiplomado $modulo)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'orden' => 'nullable|integer',
        ]);

        $modulo->update($request->only('titulo', 'descripcion', 'orden'));

        return redirect()
            ->route('admin.diplomados.show', $modulo->diplomado)
            ->with('success', 'Módulo actualizado correctamente.');
    }
}
