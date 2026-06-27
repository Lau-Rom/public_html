<?php

namespace App\Http\Controllers\Semillero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Integrante;
use App\Models\Dotacion;
use App\Models\LenguaIndigena;

class IntegranteController extends Controller
{
    //muestra el formulario de registro de un nuevo integrante
    public function create()
    {
        $instrumentos = Dotacion::all();

        $lenguas = LenguaIndigena::all();

       $clave = 'SC/SNFM-AMC/BC-ES/';

$ultimoRegistro = Integrante::where(
    'folio_semillero',
    'like',
    $clave . '%'
)
->orderByDesc('folio_semillero')
->first();

if ($ultimoRegistro) {
    $ultimoNumero = intval(
        substr(
            $ultimoRegistro->folio_semillero,
            strlen($clave)
        )
    );

    $nuevoNumero = str_pad(
        $ultimoNumero + 1,
        2,
        '0',
        STR_PAD_LEFT
    );
} else {
    $nuevoNumero = '01';
}

$folioSemillero = $clave . $nuevoNumero;

        return view(
            'semillero.integrantes.agregar',
            compact(
                'instrumentos',
                'lenguas',
                'folioSemillero'
            )
        );
    }
        //resibe los datos al Guardar 
 public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required',
        'a_paterno' => 'required',
        'genero' => 'required',
        'nacionalidad' => 'required',
        'fecha_nacimiento' => 'required',
        'instrumento' => 'required',
    ]);
$clave = 'SC/SNFM-AMC/BC-ES/';

$ultimoRegistro = Integrante::where(
    'folio_semillero',
    'like',
    $clave . '%'
)
->orderByDesc('folio_semillero')
->first();

if ($ultimoRegistro) {
    $ultimoNumero = intval(
        substr(
            $ultimoRegistro->folio_semillero,
            strlen($clave)
        )
    );

    $nuevoNumero = str_pad(
        $ultimoNumero + 1,
        2,
        '0',
        STR_PAD_LEFT
    );
} else {
    $nuevoNumero = '01';
}

$folioSemillero = $clave . $nuevoNumero;

    Integrante::create([
        'folio_semillero' => $folioSemillero,
        'semillero' => 'Semillero Orquesta Sinfónica Comunitaria Forjadores del Sauzal',

        'nombre' => $request->nombre,
        'a_paterno' => $request->a_paterno,
        'a_materno' => $request->a_materno,

        'genero' => $request->genero,
        'nacionalidad' => $request->nacionalidad,
        'curp_id' => $request->curp_id ?? '',
        'fecha_nacimiento' => $request->fecha_nacimiento,

        'email' => $request->email ?? '',
        'tel' => $request->tel ?? '',

        'instrumento' => $request->instrumento,
        'estatus' => 'Activo',

        'nombre_escuela' => $request->nombre_escuela ?? '',
        'clave_escuela' => $request->clave_escuela ?? '',
        'dir_escuela' => $request->dir_escuela ?? '',
        'nivel_escuela' => $request->nivel_escuela ?? '',
        'grado_escuela' => $request->grado_escuela ?? '',
        'email_escuela' => $request->email_escuela ?? '',
        'tel_escuela' => $request->tel_escuela ?? '',

        'nombre_tutor' => $request->nombre_tutor ?? '',
        'parentesco_tutor' => $request->parentesco_tutor ?? '',
        'dir_tutor' => $request->dir_tutor ?? '',
        'poblacion_tutor' => $request->poblacion_tutor ?? '',
        'municipio_tutor' => $request->municipio_tutor ?? '',
        'cp_tutor' => $request->cp_tutor ?? '',
        'estado_tutor' => $request->estado_tutor ?? '',
        'tel_tutor' => $request->tel_tutor ?? '',
        'email_tutor' => $request->email_tutor ?? '',

        'origen' => $request->origen ?? 'No',
        'hablante' => $request->hablante ?? 'No',
        'lengua' => $request->lengua ?: null,

        'fecha_carga' => now()
    ]);

    return back()->with('success', 'Integrante guardado correctamente');
}
//muestra el formulario de edición de un integrante
        public function edit($folio_semillero)
{
    $folio_semillero = urldecode($folio_semillero);

    $integrante = Integrante::where(
        'folio_semillero',
        $folio_semillero
    )->firstOrFail();

    $instrumentos = Dotacion::all();

    $lenguas = LenguaIndigena::all();

    return view(
        'semillero.integrantes.editar',
        compact(
            'integrante',
            'instrumentos',
            'lenguas'
        )
    );
}
//actualiza los datos de un integrante
    public function update(Request $request, $folio_semillero)
{
    $folio_semillero = urldecode($folio_semillero);

    $integrante = Integrante::where(
        'folio_semillero',
        $folio_semillero
    )->firstOrFail();

    $request->validate([
        'nombre' => 'required',
        'a_paterno' => 'required',
        'genero' => 'required',
        'nacionalidad' => 'required',
        'fecha_nacimiento' => 'required',
        'instrumento' => 'required',
    ]);

    $integrante->update([
        'nombre' => $request->nombre,
        'a_paterno' => $request->a_paterno,
        'a_materno' => $request->a_materno,

        'genero' => $request->genero,
        'nacionalidad' => $request->nacionalidad,
        'curp_id' => $request->curp_id ?? '',
        'fecha_nacimiento' => $request->fecha_nacimiento,

        'email' => $request->email ?? '',
        'tel' => $request->tel ?? '',

        'instrumento' => $request->instrumento,
        'estatus' => $request->estatus,

        'nombre_escuela' => $request->nombre_escuela ?? '',
        'clave_escuela' => $request->clave_escuela ?? '',
        'dir_escuela' => $request->dir_escuela ?? '',
        'nivel_escuela' => $request->nivel_escuela ?? '',
        'grado_escuela' => $request->grado_escuela ?? '',
        'email_escuela' => $request->email_escuela ?? '',
        'tel_escuela' => $request->tel_escuela ?? '',

        'nombre_tutor' => $request->nombre_tutor ?? '',
        'parentesco_tutor' => $request->parentesco_tutor ?? '',
        'dir_tutor' => $request->dir_tutor ?? '',
        'poblacion_tutor' => $request->poblacion_tutor ?? '',
        'municipio_tutor' => $request->municipio_tutor ?? '',
        'cp_tutor' => $request->cp_tutor ?: 0,
        'estado_tutor' => $request->estado_tutor ?? '',
        'tel_tutor' => $request->tel_tutor ?? '',
        'email_tutor' => $request->email_tutor ?? '',

        'origen' => $request->origen ?? 'No',
        'hablante' => $request->hablante ?? 'No',
        'lengua' => $request->lengua ?: null,
    ]);

    return redirect()
        ->route('semillero.integrantes.buscar')
        ->with('success', 'Integrante actualizado correctamente');
}
//metodo para eliminar un integrante 
    public function destroy($folio_semillero)
{
    $folio_semillero = urldecode($folio_semillero);

    $integrante = Integrante::where(
        'folio_semillero',
        $folio_semillero
    )->firstOrFail();

    $integrante->delete();

    return redirect()
        ->route('semillero.integrantes.buscar')
        ->with('success', 'Integrante eliminado correctamente');
}
}
