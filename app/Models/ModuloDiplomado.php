<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuloDiplomado extends Model
{
    protected $fillable = [
        'diplomado_id',
        'titulo',
        'descripcion',
        'orden',
    ];

    public function diplomado()
    {
        return $this->belongsTo(Diplomado::class);
    }

    public function materiales()
    {
        return $this->hasMany(MaterialDiplomado::class, 'modulo_diplomado_id');
    }
}
