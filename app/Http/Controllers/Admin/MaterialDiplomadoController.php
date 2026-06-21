<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModuloDiplomado;
use Illuminate\Http\Request;

class MaterialDiplomadoController extends Controller
{
    public function store(Request $request, ModuloDiplomado $modulo)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tipo' => 'required|in:pdf,infografia,video,documento,link',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp,mp4,doc,docx,ppt,pptx|max:51200',
            'url' => 'nullable|url',
        ]);

        $data = $request->except('archivo');

        if ($request->hasFile('archivo')) {
            $data['archivo'] = $request->file('archivo')->store('materiales_diplomados', 'public');
        }

        $modulo->materiales()->create($data);

        return back()->with('success', 'Material agregado correctamente.');
    }
}
