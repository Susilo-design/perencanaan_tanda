<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoinController extends Controller
{
    /**
     * Menangani permintaan bergabung ke proyek menggunakan kode join.
     * Metode ini memvalidasi kode join, memeriksa apakah proyek ada,
     * memastikan pengguna belum bergabung, dan menambahkan pengguna ke proyek
     * sebagai anggota dalam sistem kolaborasi proyek.
     */
    public function join(Request $request)
    {
        // Validasi input kode join: harus ada dan berupa string
        $request->validate([
            'join_code' => 'required|string',
        ]);

        // Cari proyek berdasarkan kode join yang diberikan (kode unik 6 karakter untuk kolaborasi)
        $project = Project::where('join_code', $request->join_code)->first();

        // Jika tidak ada proyek dengan kode tersebut, kembalikan error
        if (!$project) {
            return redirect()->back()->withErrors(['join_code' => 'Kode tidak valid.']);
        }

        // Periksa apakah pengguna yang terautentikasi sudah menjadi anggota proyek ini
        // untuk mencegah bergabung duplikat dalam kolaborasi
        if ($project->users->contains(Auth::id())) {
            return redirect()->back()->withErrors(['join_code' => 'Kamu sudah join project ini.']);
        }

        // Lampirkan pengguna ke proyek melalui relasi many-to-many
        // Tetapkan role sebagai 'member' dan catat timestamp bergabung untuk pelacakan kolaborasi
        $project->users()->attach(Auth::id(), [
            'role_in_project' => 'member',
            'joined_at' => now(),
        ]);

        // Alihkan ke dashboard dengan pesan sukses setelah bergabung berhasil
        return redirect()->route('user.dashboard')->with('success', 'Berhasil join project.');
    }
}
