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
        Schema::create('customer_additional_information', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('customer_uuid')->nullable()->unique()->index();
            $table->boolean('is_sick')->default(false);
            $table->boolean('has_entry_ban')->default(false);
            $table->boolean('know_foreign_language')->default(false);
            $table->text('issues_description')->nullable();
            $table->text('certificates')->default('');
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
        Schema::dropIfExists('customer_additional_information');
    }
};
