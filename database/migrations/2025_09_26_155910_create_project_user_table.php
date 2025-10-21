<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('project_user', function (Blueprint $table) {
            $table->id(); // Primary key untuk tabel pivot
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users (pengguna yang bergabung)
            $table->unsignedBigInteger('project_id'); // Foreign key ke tabel projects (proyek yang diikuti)
            $table->enum('role', ['owner', 'collaborator'])->default('collaborator'); // Role pengguna dalam proyek (untuk kolaborasi)
            $table->timestamp('joined_at')->useCurrent(); // Timestamp kapan pengguna bergabung
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint dengan cascade delete
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_user');
    }
};
