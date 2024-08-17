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
        Schema::create('driver_chip_card', static function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('customer_uuid');
            $table->string('card_serial', 16)->unique();
            $table->string('exchange_reason', 16)->nullable();
            $table->date('expiration_date');
            $table->timestamps();
            $table->foreign('customer_uuid')
                ->references('uuid')
                ->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_chip_card');
    }
};
