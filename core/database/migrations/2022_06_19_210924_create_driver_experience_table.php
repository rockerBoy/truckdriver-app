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
        Schema::create('customer_experience', static function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('customer_uuid')->index();
            $table->enum('general_exp', [
                'one',
                'over_one',
                'two_three',
                'three_five',
                'over_five',
            ]);
            $table->string('work_places')->nullable();
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
        Schema::dropIfExists('customer_experience');
    }
};
