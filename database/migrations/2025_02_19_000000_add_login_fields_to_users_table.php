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
            // Add Jetstream columns (if not already added by Jetstream)
            if (!Schema::hasColumn('users', 'current_team_id')) {
                $table->foreignId('current_team_id')->nullable();
            }
            if (!Schema::hasColumn('users', 'profile_photo_path')) {
                $table->string('profile_photo_path', 2048)->nullable();
            }
            
            // Add login tracking columns
            if (!Schema::hasColumn('users', 'last_login_location')) {
                $table->string('last_login_location')->nullable();
            }
            if (!Schema::hasColumn('users', 'last_login_latitude')) {
                $table->decimal('last_login_latitude', 10, 8)->nullable();
            }
            if (!Schema::hasColumn('users', 'last_login_longitude')) {
                $table->decimal('last_login_longitude', 11, 8)->nullable();
            }
            if (!Schema::hasColumn('users', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [];
            
            if (Schema::hasColumn('users', 'last_login_at')) {
                $columns[] = 'last_login_at';
            }
            if (Schema::hasColumn('users', 'last_login_longitude')) {
                $columns[] = 'last_login_longitude';
            }
            if (Schema::hasColumn('users', 'last_login_latitude')) {
                $columns[] = 'last_login_latitude';
            }
            if (Schema::hasColumn('users', 'last_login_location')) {
                $columns[] = 'last_login_location';
            }
            
            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
            
            // Only drop Jetstream columns if they were added by this migration
            // (They might have been added by Jetstream installation)
            if (Schema::hasColumn('users', 'profile_photo_path')) {
                $table->dropColumn('profile_photo_path');
            }
            if (Schema::hasColumn('users', 'current_team_id')) {
                $table->dropColumn('current_team_id');
            }
        });
    }
};
