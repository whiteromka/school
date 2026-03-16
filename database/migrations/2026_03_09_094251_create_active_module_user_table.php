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
        Schema::create('active_module_to_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('active_module_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('joined_at')->nullable()->comment('Дата присоединения');
            $table->timestamps();

            $table->index('user_id', 'idx_user_id');
            $table->index('active_module_id', 'idx_active_module_id');
            // Уникальная пара: пользователь может быть в активном модуле один раз
            $table->unique(['user_id', 'active_module_id'], 'unique_user_active_module');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_module_to_user');
    }
};
