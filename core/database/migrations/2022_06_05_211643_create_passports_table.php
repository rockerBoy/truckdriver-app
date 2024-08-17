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
        Schema::create('passports', static function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('customer_uuid')->unique()->index();
            $table->string('passport_series')->nullable()->index();
            $table->unsignedBigInteger('passport_number')->unique()->index();
            $table->enum(
                'martial_status',
                [
                    'married',
                    'not_married',
                    'divorced',
                ]
            )->default('not_married');
            $table->date('issues_date')->nullable();
            $table->string('registrator');
            $table->date('registration_date')->nullable();
            $table->string('country');
            $table->string('address')->nullable();
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
        Schema::dropIfExists('passports');
    }
};
