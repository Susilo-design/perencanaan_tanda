<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // Relasi: 1 User punya banyak Project
    public function projects()
    {
        return $this->hasMany(Project::class, 'owner_id');
    }

    // Relasi: user bisa join banyak project
    public function joinedProjects()
    {
        return $this->belongsToMany(Project::class, 'project_user')
            ->withPivot('role', 'joined_at');
    }

    // Relasi: user punya banyak project_user
    public function projectUsers()
    {
        return $this->hasMany(ProjectUser::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



}
