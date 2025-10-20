<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the existing enum constraint by changing to string temporarily
        Schema::table('project_user', function (Blueprint $table) {
            $table->string('role_in_project')->change();
        });

        // Update existing data to match new enum values
        DB::statement("UPDATE project_user SET role_in_project = CASE WHEN role_in_project = 'owner' THEN 'host' WHEN role_in_project = 'collaborator' THEN 'member' ELSE role_in_project END");

        // Then change to new enum
        Schema::table('project_user', function (Blueprint $table) {
            $table->enum('role_in_project', ['host', 'member'])->default('member')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the existing enum constraint by changing to string temporarily
        Schema::table('project_user', function (Blueprint $table) {
            $table->string('role_in_project')->change();
        });

        // Update existing data to match old enum values
        DB::statement("UPDATE project_user SET role_in_project = CASE WHEN role_in_project = 'host' THEN 'owner' WHEN role_in_project = 'member' THEN 'collaborator' ELSE role_in_project END");

        // Then change to old enum
        Schema::table('project_user', function (Blueprint $table) {
            $table->enum('role_in_project', ['owner', 'collaborator'])->default('collaborator')->change();
        });
    }
};
