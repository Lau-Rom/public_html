<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nacionalidad;
use App\Models\Genero;
use App\Models\Actividad;
use App\Models\Especialidad;
use App\Models\Semillero;
use App\Models\TipoContratacion;
use App\Models\Tabulador;
use App\Models\HorasSemana;
use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        return view('admin.docentes.index');
    }

    public function create()
    {
        $nacionalidades = Nacionalidad::orderBy('nombre')->get();
        $generos = Genero::orderBy('nombre')->get();
        $actividades = Actividad::orderBy('nombre')->get();
        $especialidades = Especialidad::orderBy('nombre')->get();
        $semilleros = Semillero::orderBy('nombre_de_agrupacion')->get();
        $tipoContrataciones = TipoContratacion::orderBy('nombre')->get();
        $tabuladores = Tabulador::orderBy('nombre')->get();
        $horasSemana = HorasSemana::orderBy('nombre')->get();

        return view('admin.docentes.create', compact(
            'nacionalidades',
            'generos',
            'actividades',
            'especialidades',
            'semilleros',
            'tipoContrataciones',
            'tabuladores',
            'horasSemana'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'curp' => 'required|string|max:255|unique:docentes,curp',
            'fecha_nacimiento' => 'required|date',
            'clave_trabajo' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'correo' => 'nullable|email|max:255',

            'nacionalidad_id' => 'required|exists:nacionalidades,id',
            'genero_id' => 'required|exists:generos,id',
            'actividad_id' => 'required|exists:actividades,id',
            'especialidad_id' => 'required|exists:especialidades,id',
            'tipo_contratacion_id' => 'required|exists:tipo_contrataciones,id',
            'tabulador_id' => 'required|exists:tabulador,id',
            'horas_semana_id' => 'required|exists:horas_semanas,id',

            'semilleros' => 'nullable|array',
            'semilleros.*' => 'exists:semilleros,id',
        ]);

        $docente = Docente::create([
            'nombre' => $validated['nombre'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'],
            'curp' => $validated['curp'],
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
            'clave_trabajo' => $validated['clave_trabajo'] ?? null,
            'telefono' => $validated['telefono'] ?? null,
            'correo' => $validated['correo'] ?? null,

            'nacionalidad_id' => $validated['nacionalidad_id'],
            'genero_id' => $validated['genero_id'],
            'actividad_id' => $validated['actividad_id'],
            'especialidad_id' => $validated['especialidad_id'],
            'tipo_contratacion_id' => $validated['tipo_contratacion_id'],
            'tabulador_id' => $validated['tabulador_id'],
            'horas_semana_id' => $validated['horas_semana_id'],
        ]);

        if ($request->filled('semilleros')) {
            $docente->semilleros()->sync($request->semilleros);
        }

        return redirect()
            ->route('admin.docentes.index')
            ->with('success', 'Docente registrado correctamente.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        return view('admin.docentes.edit');
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
