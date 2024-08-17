<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("UPDATE trailers SET trailer_title = REPLACE(trailer_title, 'Силус', 'Силос')");
        DB::statement("UPDATE trailers SET trailer_title = REPLACE(trailer_title, 'Штори', 'Тент')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
