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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        DB::table('countries')->insert($this->prepareCountriesList());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }

    private function prepareCountriesList(): array
    {
        $countriesList = [
            'Австрія',
            'Бельгія',
            'Данія',
            'Фінляндія',
            'Франція',
            'Греція',
            'Іспанія',
            'Люксембург',
            'Нідерланди',
            'Німеччина',
            'Португалія',
            'Швеція',
            'Італія',
            'Естонія',
            'Латвія',
            'Литва',
            'Мальта',
            'Польща',
            'Чехія',
            'Словаччина',
            'Словенія',
            'Угорщина',
            'Норвегія',
            'Ісландія',
            'Швейцарія',
            'Болгарія',
            'Ірландія',
            'Румунія',
            'Великобританія',
        ];

        return array_map(static fn ($country) =>  ['name' => $country], $countriesList);
    }
};
