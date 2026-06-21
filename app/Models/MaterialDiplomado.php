<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialDiplomado extends Model
{
    protected $fillable = [
        'modulo_diplomado_id',
        'titulo',
        'descripcion',
        'tipo',
        'archivo',
        'url',
    ];

    public function modulo()
    {
        return $this->belongsTo(ModuloDiplomado::class, 'modulo_diplomado_id');
    }
}
