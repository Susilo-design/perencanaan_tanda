<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;

    protected $table = 'project_user';

    protected $fillable = [
        'user_id',
        'project_id',
        'role_in_project', // Role pengguna dalam proyek (misalnya 'member' untuk kolaborasi)
        'joined_at', // Timestamp kapan pengguna bergabung ke proyek
    ];

    public $timestamps = false; // Tidak menggunakan created_at/updated_at default karena sudah ada joined_at

    // Relasi: ProjectUser belongs to User (pengguna yang bergabung)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: ProjectUser belongs to Project (proyek yang diikuti)
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
