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
        Schema::create('driver_license_category', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('card_uuid');
            $table->string('category', 3);
            $table->timestamps();
            $table->foreign('card_uuid')
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
        Schema::dropIfExists('driver_license_category');
    }
};
