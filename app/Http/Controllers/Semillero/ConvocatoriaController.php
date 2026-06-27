<?php

namespace App\Http\Controllers\Semillero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Convocatoria;
use App\Models\ArchivoConvocatoria;
use App\Models\Integrante;
use App\Models\Postulacion;
use App\Models\ArchivoPostulacion;
use DateTime;

class ConvocatoriaController extends Controller
{
    //muestra las convocatorias activas y usamos whereDate para filtrar las convocatorias que están activas en la fecha actual
   public function index()
{
    $convocatorias = Convocatoria::where('activo', true)
        ->whereDate('fecha_inicio', '<=', now())
        ->whereDate('fecha_fin', '>=', now())
        ->orderBy('fecha_inicio', 'desc')
        ->get();

    return view(
        'semillero.convocatorias.index',
        compact('convocatorias')
    );
}
//muestra los detalles de una convocatoria y sus documentos asociados
    public function show($id)
{
    $convocatoria = Convocatoria::findOrFail($id);

    $documentos = ArchivoConvocatoria::where(
        'id_convocatoria',
        $id
    )->get();

    return view(
        'semillero.convocatorias.show',
        compact(
            'convocatoria',
            'documentos'
        )
    );
}
//muestra el formulario de postulación a una convocatoria y filtra los integrantes del semillero que cumplen con los requisitos de edad y tiempo de pertenencia al semillero
    public function postular($id)
{
    $convocatoria = Convocatoria::findOrFail($id);
    

    $nombreAgrupacion = session('nombre_de_agrupacion')
     ?? 'Semillero Orquesta Sinfónica Comunitaria Forjadores del Sauzal';

    $alumnos = Integrante::where(
    'semillero',
    $nombreAgrupacion
)
    ->get()
    ->map(function ($alumno) {

        $hoy = new DateTime();

         $nacimiento = new DateTime($alumno->fecha_nacimiento);

         $fechaCarga = new DateTime($alumno->fecha_carga);

         $alumno->edad = $hoy->diff($nacimiento)->y;

         $alumno->meses_en_grupo =
            ($hoy->diff($fechaCarga)->y * 12)
            + $hoy->diff($fechaCarga)->m;
//en este apartado se define la elegibilidad del alumno según los criterios de edad y tiempo de pertenencia al semillero
         //$alumno->elegible =
         // $alumno->edad >= 10
         //&& $alumno->edad <= 17
        //&& $alumno->meses_en_grupo >= 6;

    return $alumno;
});
// Alumnos que ya se postularon apareceran deshabilitados en el select
 $foliosPostulados = Postulacion::where(
    'id_convocatoria',
    $id
)
->pluck('folio_semillero')
->toArray();
    return view(
     'semillero.convocatorias.postular',
         compact(
            'convocatoria',
            'alumnos',
            'foliosPostulados'
    )
);
}
public function guardarPostulacion(Request $request, $id)
{
    $request->validate([
        'folio_alumno' => 'required',
        'video_link' => 'required|url',
        'archivos' => 'required',
        'archivos.*' => 'file|mimes:pdf|max:5120',
    ],
    [
        'folio_alumno.required' => 'Debe seleccionar un integrante.',

        'video_link.required' => 'Debe ingresar el enlace del video de audición.',
        'video_link.url' => 'El enlace del video no tiene un formato válido.',

        'archivos.required' => 'Debe subir al menos un archivo PDF.',
        'archivos.*.mimes' => 'Solo se permiten archivos en formato PDF.',
        'archivos.*.max' => 'Cada archivo PDF no debe superar los 5 MB.',
    ]
);

    $convocatoria = Convocatoria::findOrFail($id);

    $folio = $request->folio_alumno;

    $alumno = Integrante::where(
        'folio_semillero',
        $folio
    )->firstOrFail();

    $yaPostulado = Postulacion::where('id_convocatoria', $id)
        ->where('folio_semillero', $folio)
        ->exists();

    if ($yaPostulado) {
        return back()->with(
            'error',
            'Este alumno ya se ha postulado a esta convocatoria.'
        );
    }

    $postulacion = Postulacion::create([
        'id_convocatoria' => $id,
        'nombre_de_agrupacion' =>
            session('nombre_de_agrupacion')
            ?? 'Semillero Orquesta Sinfónica Comunitaria Forjadores del Sauzal',
        'folio_semillero' => $folio,
        'fecha_postulacion' => now(),
    ]);

     $nombreConvocatoria = trim($convocatoria->titulo);

// Solo reemplazar caracteres inválidos para Windows y guardar el nombre de la convocatoria en una variable
        $nombreConvocatoria = str_replace(
         ['<', '>', ':', '"', '/', '\\', '|', '?', '*'],
            '-', $nombreConvocatoria);

        $folioCarpeta = trim($folio);

        $folioCarpeta = str_replace( ['<', '>', ':', '"', '/', '\\', '|', '?', '*'], '-',
        $folioCarpeta
        );

    foreach ($request->file('archivos') as $archivo) {
        $nombreOriginal = $archivo->getClientOriginalName();
//// Se reemplazan únicamente caracteres no permitidos en nombres de carpetas de Windows
    $nombreOriginal = str_replace(
    ['<', '>', ':', '"', '/', '\\', '|', '?', '*'],
    '-',
    $nombreOriginal);

    $nombreFinal =
    pathinfo($nombreOriginal, PATHINFO_FILENAME)
    .' - '
    .$alumno->nombre.' '
    .$alumno->a_paterno.'.'
    .$archivo->getClientOriginalExtension();


        $ruta = $archivo->storeAs(
            'postulaciones/'
            . $nombreConvocatoria
            . '/folio_'
            . $folioCarpeta,
            $nombreFinal,
            'public'
        );

        ArchivoPostulacion::create([
            'id_postulacion' => $postulacion->id,
            'nombre_archivo' => $nombreFinal,
            'ruta' =>  $ruta,
        ]);
    }

    ArchivoPostulacion::create([
        'id_postulacion' => $postulacion->id,
        'nombre_archivo' => 'Video de audición',
        'ruta' => $request->video_link,
    ]);

    return redirect()
        ->route('semillero.convocatorias.postular', $id)
        ->with('success', 'Postulación enviada correctamente.');
}
}
