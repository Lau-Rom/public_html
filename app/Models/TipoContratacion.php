<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoContratacion extends Model
{
    protected $table = 'tipo_contrataciones';

    protected $fillable = [
        'nombre'
    ];
}
