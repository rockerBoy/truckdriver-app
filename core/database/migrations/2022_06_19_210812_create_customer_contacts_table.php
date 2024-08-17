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
        Schema::create('customer_contacts', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('customer_uuid')->index();
            $table->string('contact_type');
            $table->string('contact_value');
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
        Schema::dropIfExists('customer_contacts');
    }
};
