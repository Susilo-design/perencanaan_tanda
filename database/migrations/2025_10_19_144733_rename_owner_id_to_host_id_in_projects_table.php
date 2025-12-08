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
        // Status enum migration - add more granular status values
        Schema::table('projects', function (Blueprint $table) {
            // This migration is a placeholder - status is already handled
            // by the add_status_to_projects_table migration
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No changes to revert
    }
};
