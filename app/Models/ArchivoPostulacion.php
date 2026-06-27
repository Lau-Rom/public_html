<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchivoPostulacion extends Model
{
    protected $table = 'archivos_postulacion';

    public $timestamps = false;

    protected $guarded = [];
}