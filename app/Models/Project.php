<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $casts = [
    'start_date' => 'date',
    'end_date' => 'date',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
];


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

    // Relasi: proyek bisa memiliki banyak pengguna yang bergabung untuk kolaborasi
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user')
            ->withPivot('role_in_project', 'joined_at'); // Mengambil kolom tambahan dari tabel pivot untuk role dan waktu bergabung
    }

    // Relasi: project punya banyak project_user
    public function projectUsers()
    {
        return $this->hasMany(ProjectUser::class);
    }

    // Helper: menghasilkan kode join unik untuk kolaborasi proyek
    public function generateJoinCode()
    {
        do {
            $code = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6)); // Buat kode 6 karakter huruf besar menggunakan MD5 dan uniqid
        } while (self::where('join_code', $code)->exists()); // Pastikan kode belum ada di database untuk keunikan

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
