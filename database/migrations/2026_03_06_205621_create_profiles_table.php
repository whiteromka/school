<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('gender')->nullable()->comment('Пол');
            $table->date('birthday')->nullable()->comment('Дата рождения');
            $table->string('country')->nullable()->default('РФ')->comment('Страна');
            $table->string('city')->nullable()->comment('Город');
            $table->string('industry')->nullable()->comment('Индустрия');
            $table->string('job')->nullable()->comment('Должность');
            $table->boolean('is_free_offer')->default(false)->comment('Могу бесплатно поработать');
            $table->boolean('is_money_offer')->default(false)->comment('Могу за деньги поработать');
            $table->tinyInteger('level')->nullable()->comment('Уровень');
            $table->text('obout')->nullable()->comment('О себе');
            $table->integer('years_experience')->nullable()->comment('Опыт работы в годах');
            $table->string('github')->nullable()->comment('GitHub ссылка');
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
