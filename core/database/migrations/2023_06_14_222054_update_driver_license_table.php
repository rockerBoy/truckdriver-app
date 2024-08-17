<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const TABLE = 'driver_license';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(self::TABLE, static function (Blueprint $table) {
            $table->string('number')->nullable()->change();
            $table->string('series')->nullable()->change();
            $table->string('registrator')->nullable()->change();
            $table->boolean('have_adr')->nullable()->change();
            $table->boolean('have_95')->nullable()->change();
            $table->boolean('have_chip_card')->nullable()->change();

            $table->date('issues_date')->nullable()->change();
            $table->date('expiration_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(self::TABLE, static function (Blueprint $table) {
            $table->string('number')->nullable(false)->change();
            $table->string('series')->nullable(false)->change();
            $table->string('registrator')->nullable(false)->change();
            $table->date('issues_date')->nullable(false)->change();
            $table->date('expiration_date')->nullable(false)->change();
            $table->boolean('have_adr')->nullable(false)->change();
            $table->boolean('have_95')->nullable(false)->change();
            $table->boolean('have_chip_card')->nullable(false)->change();

            $table->date('issues_date')->nullable(false)->change();
            $table->date('expiration_date')->nullable(false)->change();
        });
    }
};
