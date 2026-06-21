<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modulo_diplomados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diplomado_id')->constrained('diplomados')->onDelete('cascade');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->integer('orden')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulo_diplomados');
    }
};
