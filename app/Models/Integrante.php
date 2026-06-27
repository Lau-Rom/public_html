<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Integrante extends Model
{
    protected $table = 'db_gral';

    public $timestamps = false;

    protected $fillable = [
        'folio_semillero',
        'semillero',
        'nombre',
        'a_paterno',
        'a_materno',
        'genero',
        'nacionalidad',
        'curp_id',
        'fecha_nacimiento',
        'email',
        'tel',
        'instrumento',
        'estatus',
        'nombre_escuela',
        'clave_escuela',
        'dir_escuela',
        'nivel_escuela',
        'grado_escuela',
        'email_escuela',
        'tel_escuela',
        'nombre_tutor',
        'parentesco_tutor',
        'dir_tutor',
        'poblacion_tutor',
        'municipio_tutor',
        'cp_tutor',
        'estado_tutor',
        'tel_tutor',
        'email_tutor',
        'origen',
        'hablante',
        'lengua',
        'fecha_carga'
    ];
}