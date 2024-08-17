<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('driver_license_95_code', static function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('driver_license_uuid');
            $table->string('95_code_region', 2)
                  ->nullable();
            $table->date('expiration_date');
            $table->timestamps();
            $table->foreign('driver_license_uuid')
                  ->references('uuid')
                ->on('driver_license');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_license_95_code');
    }
};
