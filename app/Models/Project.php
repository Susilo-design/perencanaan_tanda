<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'owner_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'join_code',
    ];

    // Relasi: project dimiliki oleh 1 user (owner)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Relasi: project bisa punya banyak user yang join
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user')
            ->withPivot('role', 'joined_at');
    }
}
