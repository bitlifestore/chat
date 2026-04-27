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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('name')->nullable();
            $table->string('phone')->unique()->after('email')->nullable();
            $table->string('avatar')->nullable()->after('password');
            $table->enum('online_status', ['online', 'offline', 'busy', 'away'])->default('offline')->after('avatar');
            $table->timestamp('last_seen')->nullable()->after('online_status');
            $table->text('bio')->nullable()->after('last_seen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'phone', 'avatar', 'online_status', 'last_seen', 'bio']);
        });
    }
};
