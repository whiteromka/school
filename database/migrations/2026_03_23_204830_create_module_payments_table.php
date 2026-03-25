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
        Schema::create('module_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('active_module_id');
            $table->string('payment_status')->comment('pending, paid, failed, cancelled');
            $table->string('payment_type')->comment('card, sbp, yandex_money, cash, etc.');
            $table->decimal('amount', 10, 2)->default(0)->comment('Payment amount');
            $table->string('currency', 3)->default('RUB')->comment('Payment currency');
            $table->string('transaction_id')->nullable()->comment('External payment system transaction ID');
            $table->string('payment_method')->nullable()->comment('Payment method/code');
            $table->timestamp('paid_at')->nullable()->comment('Actual payment date');
            $table->text('description')->nullable()->comment('Payment description/comment');
            $table->json('meta_data')->nullable()->comment('Additional payment metadata');
            $table->timestamps();

            $table->index('payment_id');
            $table->index('user_id');
            $table->index('active_module_id');
            $table->index(['user_id', 'payment_status']);
            $table->index(['active_module_id', 'payment_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_payments');
    }
};
