<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_diplomados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modulo_diplomado_id')->constrained('modulo_diplomados')->onDelete('cascade');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->enum('tipo', ['pdf', 'documento', 'presentacion', 'video', 'infografia', 'link'])->default('pdf');
            $table->string('archivo')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_diplomados');
    }
};
