<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('hh_id')->unique()->comment('ID вакансии в HeadHunter');
            $table->string('type')->comment('Тип'); // PHP JS Gamedev
            $table->string('name')->comment('Название вакансии');
            $table->text('description')->nullable()->comment('Описание вакансии');
            $table->string('area_id')->nullable()->comment('ID региона');
            $table->string('area_name')->nullable()->comment('Название региона');
            $table->decimal('salary_from', 10, 2)->nullable()->comment('Зарплата от');
            $table->decimal('salary_to', 10, 2)->nullable()->comment('Зарплата до');
            $table->string('salary_currency')->nullable()->comment('Валюта');
            $table->boolean('salary_gross')->nullable()->comment('Зарплата до вычета налогов');
            $table->text('requirement')->nullable()->comment('Требования');
            $table->text('responsibility')->nullable()->comment('Обязанности');
            $table->integer('responses_count')->nullable()->comment('Количество откликов');
            $table->string('experience')->nullable()->comment('Требуемый опыт');
            $table->string('employment_name')->nullable()->comment('Тип занятости');
            $table->json('key_skills')->nullable()->comment('Ключевые навыки');
            $table->timestamp('published_at')->nullable()->comment('Дата публикации');
            $table->timestamp('archived_at')->nullable()->comment('Дата архивации');
            $table->string('url')->nullable()->comment('Ссылка на вакансию');
            $table->timestamps();

            // Индексы для быстрого поиска
            $table->index('hh_id');
            $table->index('type');
            $table->index('published_at');
        });

        DB::statement('ALTER TABLE vacancies ADD UNIQUE vacancies_name_responsibility_unique(name(255), responsibility(255))');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
