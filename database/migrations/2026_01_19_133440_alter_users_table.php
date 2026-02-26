<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('email')->comment('Нужен для входа через Telegram'); // индекс users_username_unique
            $table->boolean('password_verified')->nullable()->after('password');
            $table->string('phone')->nullable()->unique()->after('email');
            $table->string('telegram')->nullable()->unique()->after('phone');

            $table->dropColumn('email_verified_at');
            $table->boolean('email_verified')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('password_verified');
            $table->dropColumn('phone');
            $table->dropColumn('telegram');

            $table->timestamp('email_verified_at')->nullable()->after('email');
            $table->dropColumn('email_verified');
        });
    }
};
