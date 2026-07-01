<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('material_diplomados', function (Blueprint $table) {
            $table->longText('descripcion')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('material_diplomados', function (Blueprint $table) {
            $table->text('descripcion')->nullable()->change();
        });
    }
};
