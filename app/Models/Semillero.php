<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semillero extends Model
{
    protected $table = 'semilleros';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'num',
        'sistema',
        'nombre_de_agrupacion',
        'tipo_agrupacion',
        'estado',
        'municipio',
        'localidad',
        'estatus',
        'usuario',
        'contrasena',
        'clave',
        'ultima_actividad',
    ];

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'docente_semillero');
    }
}
