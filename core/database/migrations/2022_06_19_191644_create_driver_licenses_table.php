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
        Schema::create('driver_license', static function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('customer_uuid')->nullable()->unique()->index();
            $table->string('number')->unique();
            $table->string('series');
            $table->string('registrator');
            $table->date('issues_date');
            $table->date('expiration_date');
            $table->boolean('have_adr');
            $table->boolean('have_95');
            $table->boolean('have_chip_card');
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
        Schema::dropIfExists('driver_license');
    }
};
