<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'curp',
        'fecha_nacimiento',
        'clave_trabajo',
        'nacionalidad_id',
        'genero_id',
        'actividad_id',
        'especialidad_id',
        'telefono',
        'correo',
        'tipo_contratacion_id',
        'tabulador_id',
        'horas_semana_id',
        'usuario',
        'contrasena',
    ];

    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class);
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }


    public function semilleros()
    {
        return $this->belongsToMany(Semillero::class, 'docente_semillero');
    }

    public function tipoContratacion()
    {
        return $this->belongsTo(TipoContratacion::class);
    }

    public function tabulador()
    {
        return $this->belongsTo(Tabulador::class);
    }

    public function horasSemana()
    {
        return $this->belongsTo(HorasSemana::class);
    }
}
