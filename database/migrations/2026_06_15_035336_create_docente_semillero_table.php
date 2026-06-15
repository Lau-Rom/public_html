<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docente_semillero', function (Blueprint $table) {
            $table->id();

            $table->foreignId('docente_id')
                ->constrained('docentes')
                ->onDelete('cascade');

            $table->unsignedInteger('semillero_id');

            $table->foreign('semillero_id')
                ->references('id')
                ->on('semilleros')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docente_semillero');
    }
};
