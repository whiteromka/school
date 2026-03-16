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
        Schema::create('active_modules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->string('name')->nullable();
            $table->timestamp('started_at')->nullable()->comment('Дата начала');
            $table->timestamp('ended_at')->nullable()->comment('Приблизительная дата конца');
            $table->string('status')->default('open'); // open | started_free | started_full | finished
            $table->timestamps();

            $table->index(['module_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_modules');
    }
};
