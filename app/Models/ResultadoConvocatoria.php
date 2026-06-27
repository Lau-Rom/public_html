<?php
//modelo para la tabla resultados_convocatoria y para que el alumno pueda ver los resultados de la convocatoria a la que se postuló
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadoConvocatoria extends Model
{
    protected $table = 'resultados_convocatoria';

    public $timestamps = false;

    protected $guarded = [];
}