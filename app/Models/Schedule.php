<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'location',
        'start_time',
        'end_time',
        'priority',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];


    // public function user()
    // {
    //     return $this->belongsTo(User::class, '');
    // }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getColorAttribute()
    {
        return match ($this->priority) {
            'high' => '#EF4444', // red
            'medium' => '#F59E0B', // yellow
            'low' => '#10B981', // green
            default => '#3B82F6', // blue
        };
    }
}
