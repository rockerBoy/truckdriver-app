<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'customer_additional_information';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(self::TABLE, static function (Blueprint $table) {
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(self::TABLE, static function (Blueprint $table) {
            $table->dropColumn('notes');
        });
    }
};
