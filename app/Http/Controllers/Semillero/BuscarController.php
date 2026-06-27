<?php
//buscar integrantes registrados en el sistema
namespace App\Http\Controllers\Semillero;

use App\Http\Controllers\Controller;
use App\Models\Integrante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuscarController extends Controller
{
    public function index(Request $request)
    {
        $nombreAgrupacion =
            session('nombre_de_agrupacion')
            ?? 'Semillero Orquesta Sinfónica Comunitaria Forjadores del Sauzal';

        $buscar = $request->buscar;

        $query = Integrante::leftJoin(
            'dotacion',
            'db_gral.instrumento',
            '=',
            'dotacion.ID'
        )
        ->select(
            'db_gral.*',
            'dotacion.INSTRUMENTO as instrumento_nombre'
        )
        ->where(
            'db_gral.semillero',
            $nombreAgrupacion
        );

        if (!empty($buscar)) {
            $query->where(
                'db_gral.folio_semillero',
                $buscar
            );
        }

        $integrantes = $query->get();

        return view(
            'semillero.integrantes.buscar',
            compact(
                'integrantes',
                'buscar'
            )
        );
    }

    public function ver($folio)
    {
        $folio = urldecode($folio);

        $integrante = DB::table('db_gral')
            ->leftJoin(
                'dotacion',
                'db_gral.instrumento',
                '=',
                'dotacion.ID'
            )
            ->leftJoin(
                'lenguas_indigenas',
                'db_gral.lengua',
                '=',
                'lenguas_indigenas.id'
            )
            ->select(
                'db_gral.*',
                'dotacion.INSTRUMENTO as instrumento_nombre',
                'lenguas_indigenas.lengua as lengua_nombre'
            )
            ->where(
                'db_gral.folio_semillero',
                $folio
            )
            ->first();

        if (!$integrante) {
            abort(404);
        }

        return view(
            'semillero.integrantes.ver',
            compact('integrante')
        );
    }
}