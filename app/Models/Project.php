<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;



    protected $fillable = [
        'host_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'join_code',
        'status',
    ];

    // Relasi: project dimiliki oleh 1 user (host)
    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    // Alias for backward compatibility
    public function owner()
    {
        return $this->host();
    }

    // Relasi: project bisa punya banyak user yang join
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user')
            ->withPivot('role_in_project', 'joined_at');
    }

    // Relasi: project punya banyak project_user
    public function projectUsers()
    {
        return $this->hasMany(ProjectUser::class);
    }

    // Helper: generate join code
    public function generateJoinCode()
    {
        do {
            $code = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
        } while (self::where('join_code', $code)->exists());

        return $code;
    }

    // Relasi: project punya banyak tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Relasi: project punya banyak schedules
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }


}
