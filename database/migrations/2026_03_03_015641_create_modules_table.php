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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable(false)->comment('Back | Front | Eng');
            $table->integer('number')->nullable()->comment('Порядок');
            $table->string('name')->nullable(false);
            $table->integer('level')->nullable(false)->comment('Уровень сложности');
            $table->string('description')->nullable();
            $table->string('description2')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
        });

        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained();
            $table->string('name')->nullable(false);
            $table->string('description')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technologies');
        Schema::dropIfExists('modules');
    }
};
