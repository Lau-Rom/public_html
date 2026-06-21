<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diplomado extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'duracion',
        'fecha_inicio',
        'fecha_fin',
        'imagen',
        'estado',
    ];

    public function modulos()
    {
        return $this->hasMany(ModuloDiplomado::class);
    }
}
