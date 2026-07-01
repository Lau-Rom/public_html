<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diplomado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DiplomadoController extends Controller
{

    public function index()
    {
        $diplomados = Diplomado::withCount('modulos')
            ->latest()
            ->get();

        return view('admin.diplomados.index', compact('diplomados'));
    }
    public function create()
    {
        return view('admin.diplomados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'duracion' => 'nullable|string|max:100',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
            'estado' => 'required|in:activo,inactivo',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except('imagen');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('diplomados', 'public');
        }

        Diplomado::create($data);

        return redirect()
            ->route('admin.diplomados.index')
            ->with('success', 'Diplomado creado correctamente.');
    }

    public function show(Diplomado $diplomado)
    {
        $diplomado->load('modulos.materiales');

        return view('admin.diplomados.show', compact('diplomado'));
    }

    public function edit(Diplomado $diplomado)
    {
        return view('admin.diplomados.edit', compact('diplomado'));
    }

    public function update(Request $request, Diplomado $diplomado)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'duracion' => 'nullable|string|max:255',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:activo,inactivo',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('diplomados', 'public');
        }

        $diplomado->update($datos);

        return redirect()
            ->route('admin.diplomados.index')
            ->with('success', 'Diplomado actualizado correctamente.');
    }
    public function destroy(Diplomado $diplomado)
    {
        if ($diplomado->imagen && Storage::disk('public')->exists($diplomado->imagen)) {
            Storage::disk('public')->delete($diplomado->imagen);
        }

        $diplomado->delete();

        return redirect()
            ->route('admin.diplomados.index')
            ->with('success', 'Diplomado eliminado correctamente.');
    }
}
