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
        Schema::create('driver_trailer', static function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('customer_uuid')->index();
            $table->foreignId('trailer_id')->index();
            $table->timestamps();
            $table->foreign('customer_uuid')
                  ->references('uuid')
                  ->on('customers');
            $table->foreign('trailer_id')
                ->references('id')
                ->on('trailers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_trailer');
    }
};
