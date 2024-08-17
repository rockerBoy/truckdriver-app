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
        Schema::create('customers', static function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('passport_uuid')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('first_name_en');
            $table->string('last_name_en');
            $table->date('birth_date');
            $table->string('patronymic');
            $table->string('email')->nullable()->unique();
            $table->string('phone_number')->unique();
            $table->string('phone_messengers');
            $table->string('phone_number_alt')->nullable()->unique();
            $table->string('phone_alt_messengers');
            $table->timestamps();

            $table->foreign('passport_uuid')
                ->references('uuid')
                ->on('passports')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
