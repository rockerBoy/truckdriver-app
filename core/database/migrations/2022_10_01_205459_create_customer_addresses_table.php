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
        Schema::create('customer_addresses', static function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('customer_uuid')->nullable()->unique()->index();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('street')->nullable();
            $table->string('building')->nullable();
            $table->string('house')->nullable();
            $table->string('apartment')->nullable();
            $table->string('zip')->nullable();
            $table->boolean('has_additional_zip')->default(false);
            $table->string('additional_zip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};
