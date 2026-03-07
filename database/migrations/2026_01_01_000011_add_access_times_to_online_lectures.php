<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('online_lectures', function (Blueprint $table) {
            $table->datetime('open_access_at')->nullable()->after('scheduled_at');
            $table->datetime('close_access_at')->nullable()->after('open_access_at');
        });
    }

    public function down(): void
    {
        Schema::table('online_lectures', function (Blueprint $table) {
            $table->dropColumn(['open_access_at', 'close_access_at']);
        });
    }
};
