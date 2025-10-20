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
        'role_in_project',
        'joined_at',
    ];

    public $timestamps = false; // soalnya kita udah punya joined_at

    // Relasi: project_user belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: project_user belongs to project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
