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
        Schema::create('trailers', static function (Blueprint $table) {
            $table->id();
            $table->string('trailer_title');
            $table->timestamps();
        });

        $this->fillDriverTrailersTable();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('trailers');
    }

    private function fillDriverTrailersTable(): void
    {
        DB::table('trailers')->insert([
            [
                'trailer_title' => 'Штори',
                'created_at' => 'NOW()',
                'updated_at' => 'NOW()',
            ],
            [
                'trailer_title' => 'Контейнер',
                'created_at' => 'NOW()',
                'updated_at' => 'NOW()',
            ],
            [
                'trailer_title' => 'Бочка',
                'created_at' => 'NOW()',
                'updated_at' => 'NOW()',
            ],
            [
                'trailer_title' => 'Силус',
                'created_at' => 'NOW()',
                'updated_at' => 'NOW()',
            ],
            [
                'trailer_title' => 'Негабарит',
                'created_at' => 'NOW()',
                'updated_at' => 'NOW()',
            ],
            [
                'trailer_title' => 'Автовоз',
                'created_at' => 'NOW()',
                'updated_at' => 'NOW()',
            ],
            [
                'trailer_title' => 'Спецперевезення',
                'created_at' => 'NOW()',
                'updated_at' => 'NOW()',
            ],
        ]);
    }
};
