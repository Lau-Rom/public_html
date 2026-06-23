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
use Illuminate\Support\Facades\Hash;

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
        $nacionalidad = Nacionalidad::find($request->nacionalidad_id);

        $esMexicana = $nacionalidad &&
            mb_strtolower($nacionalidad->nombre, 'UTF-8') === 'mexicano';

        $validated = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'
            ],

            'apellido_paterno' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'
            ],

            'apellido_materno' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'
            ],

            'curp' => [
                $esMexicana ? 'required' : 'nullable',
                'size:18',
                'unique:docentes,curp',
                'regex:/^[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[A-Z0-9]{2}$/'
            ],

            'fecha_nacimiento' => [
                $esMexicana ? 'required' : 'nullable',
                'date',
                'before:today'
            ],

            'clave_trabajo' => [
                'nullable',
                'string',
                'max:255',
            ],

            'telefono' => [
                'required',
                'digits:10'
            ],

            'correo' => [
                'required',
                'email',
                'max:255',
                'unique:docentes,correo'
            ],

            'usuario' => [
                'required',
                'string',
                'alpha_dash',
                'min:4',
                'max:50',
                'unique:docentes,usuario',
            ],

            'contrasena' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'nacionalidad_id' => 'required|exists:nacionalidades,id',
            'genero_id' => 'required|exists:generos,id',
            'actividad_id' => 'required|exists:actividades,id',
            'especialidad_id' => 'required|exists:especialidades,id',
            'tipo_contratacion_id' => 'required|exists:tipo_contrataciones,id',
            'tabulador_id' => 'required|exists:tabulador,id',
            'horas_semana_id' => 'required|exists:horas_semanas,id',
            'semilleros' => 'required|array|min:1',
            'semilleros.*' => 'exists:semilleros,id',
        ]);

        $validated['nombre'] = $this->formatoNombre($validated['nombre']);
        $validated['apellido_paterno'] = $this->formatoNombre($validated['apellido_paterno']);

        $validated['apellido_materno'] = !empty($validated['apellido_materno'])
            ? $this->formatoNombre($validated['apellido_materno'])
            : null;

        $validated['curp'] = !empty($validated['curp'])
            ? strtoupper(trim($validated['curp']))
            : null;

        $validated['correo'] = strtolower(trim($validated['correo']));

        $validated['telefono'] = preg_replace('/\D/', '', $validated['telefono']);

        $validated['clave_trabajo'] = !empty($validated['clave_trabajo'])
            ? mb_strtoupper(trim($validated['clave_trabajo']), 'UTF-8')
            : null;

        $validated['usuario'] = strtolower(trim($validated['usuario']));

        $docente = Docente::create([
            'nombre' => $validated['nombre'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'],
            'curp' => $validated['curp'],
            'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
            'clave_trabajo' => $validated['clave_trabajo'],
            'telefono' => $validated['telefono'],
            'correo' => $validated['correo'],

            'usuario' => $validated['usuario'],
            'contrasena' => Hash::make($validated['contrasena']),

            'nacionalidad_id' => $validated['nacionalidad_id'],
            'genero_id' => $validated['genero_id'],
            'actividad_id' => $validated['actividad_id'],
            'especialidad_id' => $validated['especialidad_id'],
            'tipo_contratacion_id' => $validated['tipo_contratacion_id'],
            'tabulador_id' => $validated['tabulador_id'],
            'horas_semana_id' => $validated['horas_semana_id'],
        ]);

        $docente->semilleros()->sync($validated['semilleros'] ?? []);

        return redirect()
            ->route('admin.docentes.index')
            ->with(
                'success',
                'El docente ' .
                    $docente->nombre . ' ' .
                    $docente->apellido_paterno .
                    ' fue registrado correctamente.'
            );
    }

    private function formatoNombre($texto)
    {
        $texto = trim($texto);
        $texto = preg_replace('/\s+/', ' ', $texto);

        return mb_convert_case(
            mb_strtolower($texto, 'UTF-8'),
            MB_CASE_TITLE,
            'UTF-8'
        );
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
