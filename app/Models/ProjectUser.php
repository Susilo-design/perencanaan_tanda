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
        'role_in_project', // Role pengguna user di project
        'joined_at', // Nandain kapan user itu join ke project
    ];

    public $timestamps = false; 
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi ke project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
