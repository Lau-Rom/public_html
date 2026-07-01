<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModuloDiplomado;
use App\Models\MaterialDiplomado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MaterialDiplomadoController extends Controller
{
    public function create(ModuloDiplomado $modulo)
    {
        return view('admin.diplomados.modulos.materiales.create', compact('modulo'));
    }

    public function store(Request $request, ModuloDiplomado $modulo)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tipo' => 'required|string',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png,webp,mp4,mov,avi|max:51200',
            'url' => 'nullable|url',
        ]);

        $archivoPath = null;

        if ($request->hasFile('archivo')) {
            $archivoPath = $request->file('archivo')->store('materiales_diplomados', 'public');
        }

        MaterialDiplomado::create([
            'modulo_diplomado_id' => $modulo->id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'archivo' => $archivoPath,
            'url' => $request->url,
        ]);

        return redirect()
            ->route('admin.diplomados.modulos.show', $modulo)
            ->with('success', 'Material agregado correctamente.');
    }

    public function destroy(MaterialDiplomado $material)
    {
        if ($material->archivo) {
            Storage::disk('public')->delete($material->archivo);
        }

        $material->delete();

        return back()->with('success', 'Material eliminado correctamente.');
    }

    public function edit(MaterialDiplomado $material)
    {
        return view(
            'admin.diplomados.modulos.materiales.edit',
            compact('material')
        );
    }

    public function update(Request $request, MaterialDiplomado $material)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tipo' => 'required|in:archivo,enlace,video,texto',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png,webp,mp4,mov,avi|max:51200',
            'url' => 'nullable|url',
        ]);

        $archivoPath = $material->archivo;
        $url = $request->url;

        if ($request->tipo === 'archivo') {
            $url = null;

            if ($request->hasFile('archivo')) {
                if ($material->archivo) {
                    Storage::disk('public')->delete($material->archivo);
                }

                $archivoPath = $request->file('archivo')
                    ->store('materiales_diplomados', 'public');
            }
        }

        if ($request->tipo === 'enlace' || $request->tipo === 'video') {
            if ($material->archivo) {
                Storage::disk('public')->delete($material->archivo);
            }

            $archivoPath = null;
            $url = $request->url;
        }

        if ($request->tipo === 'texto') {
            if ($material->archivo) {
                Storage::disk('public')->delete($material->archivo);
            }

            $archivoPath = null;
            $url = null;
        }

        $material->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'archivo' => $archivoPath,
            'url' => $url,
        ]);

        return redirect()
            ->route('admin.diplomados.modulos.show', $material->modulo)
            ->with('success', 'Material actualizado correctamente.');
    }
}
