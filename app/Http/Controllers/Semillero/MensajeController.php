<?php
//nos permite mostrar los mensajes del semillero en la vista de mensajes
//este controlador consulta los resultados publicados que aun no han expirado y los muestra en la vista de mensajes del semillero
namespace App\Http\Controllers\Semillero;

use App\Http\Controllers\Controller;
use App\Models\ResultadoConvocatoria;

class MensajeController extends Controller
{
    public function index()
    {
        $resultados = ResultadoConvocatoria::where(
                'fecha_expiracion',
                '>',
                now()
            )
            ->orderBy('fecha_subida', 'desc')
            ->get();

        return view(
            'semillero.mensajes.index',
            compact('resultados')
        );
    }
}