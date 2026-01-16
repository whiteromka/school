<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('oauth_accounts', function (Blueprint $table) {
            $table->timestamp('refresh_token_expires_at')->nullable()->after('expires_at');
        });
    }

    public function down(): void
    {
        Schema::table('oauth_accounts', function (Blueprint $table) {
            $table->dropColumn('refresh_token_expires_at');
        });
    }
};
