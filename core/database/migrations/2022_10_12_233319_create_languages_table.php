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
        Schema::create('languages', static function (Blueprint $table) {
            $table->id();
            $table->string('language');
        });

        DB::table('languages')->insert($this->prepareLangList());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }

    /**
     * @return array
     */
    private function prepareLangList(): array
    {
        $languagesList = [
            'Англійська',
            'Німецька',
            'Французька',
            'Італійська',
            'Іспанська',
            'Польська',
            'Румунська',
            'Нідерландська',
            'Угорська',
            'Португальська',
            'Чеська',
            'Шведська',
            'Грецька',
            'Болгарська',
            'Словацька',
            'Данська',
            'Фінська',
            'Литовська',
            'Словенська',
            'Естонська',
            'Ірландська',
            'Латиська',
            'Мальтійська',
        ];

        return array_map(static fn ($language) =>  ['language' => $language], $languagesList);
    }
};
