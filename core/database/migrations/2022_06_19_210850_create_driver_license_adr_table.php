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
        Schema::create('driver_license_adr', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('customer_uuid')
                  ->index();
            $table->foreignUuid('driver_license_uuid')
                  ->index();
            $table->integer('adr_code');
            $table->timestamps();
            $table->foreign('customer_uuid')
                ->references('uuid')
                ->on('customers');
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
        Schema::dropIfExists('driver_license_adr');
    }
};
