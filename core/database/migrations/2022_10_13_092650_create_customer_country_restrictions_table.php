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
        Schema::create('customer_country_restrictions', static function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('customer_uuid');
            $table->foreignId('country_id');
            $table->date('ban_expiration_date')->nullable();
            $table->timestamps();
            $table->foreign('customer_uuid')
                  ->references('uuid')
                  ->on('customers');
            $table->foreign('country_id')
                    ->references('id')
                    ->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_country_restrictions');
    }
};
