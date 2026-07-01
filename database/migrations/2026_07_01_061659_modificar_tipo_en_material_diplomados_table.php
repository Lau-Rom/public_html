<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE material_diplomados MODIFY tipo ENUM('archivo','enlace','video','texto') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE material_diplomados MODIFY tipo VARCHAR(50) NOT NULL");
    }
};
