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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('modules_id')->nullable();
            $table->tinyInteger('stars')
                ->nullable(false)
                ->unsigned();
            $table->string('status')
                ->default('new')
                ->comment('new, approved, rejected');
            $table->string('name')->nullable();
            $table->string('course')->nullable();
            $table->text('message')->nullable(false);
            $table->timestamps();

            $table->index('user_id');
            $table->index('modules_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
