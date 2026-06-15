<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Especialidad extends Model
{
    protected $table = 'especialidades';
    use HasFactory;

    protected $guarded = [];
}
