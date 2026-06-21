<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diplomado;
use Illuminate\Http\Request;

class DiplomadoController extends Controller
{
    public function index()
    {
        $diplomados = Diplomado::latest()->get();

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
}
