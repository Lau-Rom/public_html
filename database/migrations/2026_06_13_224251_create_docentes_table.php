<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('curp')->unique();
            $table->date('fecha_nacimiento');
            $table->string('clave_trabajo')->nullable();

            $table->foreignId('nacionalidad_id')->constrained('nacionalidades');
            $table->foreignId('genero_id')->constrained('generos');
            $table->foreignId('actividad_id')->constrained('actividades');
            $table->foreignId('especialidad_id')->constrained('especialidades');

            $table->unsignedInteger('semillero_id');

            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();

            $table->foreignId('tipo_contratacion_id')->constrained('tipo_contratacions');
            $table->foreignId('tabulador_id')->constrained('tabulador');
            $table->foreignId('horas_semana_id')->constrained('horas_semanas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
