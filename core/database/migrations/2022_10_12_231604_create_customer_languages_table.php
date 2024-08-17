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
        Schema::create('customer_languages', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->nullable();
            $table->foreignUuid('customer_uuid')->nullable()->index();
            $table->enum('experience_level', [
               'no_experience',
               'intermediate',
               'advanced',
            ]);
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
        Schema::dropIfExists('customer_languages');
    }
};
