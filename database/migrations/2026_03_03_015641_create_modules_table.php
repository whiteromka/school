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
        // Таблица модулей
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('Back | Front | Eng');
            $table->integer('number')->nullable()->comment('Порядок');
            $table->string('name');
            $table->integer('level')->comment('Уровень сложности');
            $table->string('description')->nullable();
            $table->string('description2')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
        });

        // Таблица технологий
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
        });

        // Связующая таблица
        Schema::create('module_technology', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained()->onDelete('cascade');
            $table->foreignId('technology_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['module_id', 'technology_id']); // уникальные пары
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_technology');
        Schema::dropIfExists('technologies');
        Schema::dropIfExists('modules');
    }
};
