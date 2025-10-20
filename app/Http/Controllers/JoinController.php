<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoinController extends Controller
{
    public function join(Request $request)
    {
        $request->validate([
            'join_code' => 'required|string',
        ]);

        $project = Project::where('join_code', $request->join_code)->first();

        if (!$project) {
            return redirect()->back()->withErrors(['join_code' => 'Kode tidak valid.']);
        }

        // cek apakah user sudah join
        if ($project->users->contains(Auth::id())) {
            return redirect()->back()->withErrors(['join_code' => 'Kamu sudah join project ini.']);
        }

        $project->users()->attach(Auth::id(), [
            'role_in_project' => 'member',
            'joined_at' => now(),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Berhasil join project.');

    }
}
