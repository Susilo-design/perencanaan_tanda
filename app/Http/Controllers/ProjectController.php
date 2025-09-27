<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Tampilkan semua project user yang login
     */
    public function index()
    {
        $projects = Project::all();
        return view('user.project.index', compact('projects'));
    }

    public function dashboard()
    {
        $projects = Project::all();
        return view('user.project.dashboard', compact('projects'));
    }

    /**
     * Form tambah project baru
     */
    public function create()
    {
        return view('user.project.create');
    }

    /**
     * Simpan project baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
        ]);

        $project = Project::create([
            'owner_id'    => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'join_code'   => Str::random(8), // kode unik untuk join project
        ]);

        // otomatis owner masuk ke pivot table
        $project->users()->attach(Auth::id(), [
            'role' => 'owner',
            'joined_at' => now(),
        ]);

        return redirect()->route('projects.dashboard')->with('success', 'Project berhasil dibuat.');
    }

    /**
     * Detail project
     */
    public function show(Project $project)
    {
        // pastikan user hanya bisa lihat project yang dia ikuti
        if (!$project->users->contains(Auth::id())) {
            abort(403, 'Unauthorized');
        }

        return view('user.project.index', compact('project'));
    }

    /**
     * Form edit project
     */
    public function edit(Project $project)
    {
        if ($project->owner_id !== Auth::id()) {
            abort(403, 'Hanya owner yang bisa edit project');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Update project
     */
    public function update(Request $request, Project $project)
    {
        if ($project->owner_id !== Auth::id()) {
            abort(403, 'Hanya owner yang bisa update project');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
        ]);

        $project->update([
            'title'       => $request->title,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
        ]);

        return redirect()->route('projects.show', $project)->with('success', 'Project berhasil diupdate.');
    }

    /**
     * Hapus project
     */
    public function destroy(Project $project)
    {
        if ($project->owner_id !== Auth::id()) {
            abort(403, 'Hanya owner yang bisa menghapus project');
        }

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus.');
    }

    /**
     * Join project pakai join_code
     */
    public function join(Request $request)
    {
        $request->validate([
            'join_code' => 'required|string|exists:projects,join_code',
        ]);

        $project = Project::where('join_code', $request->join_code)->first();

        // cek apakah user sudah join
        if ($project->users->contains(Auth::id())) {
            return redirect()->route('projects.dashboard')->with('info', 'Kamu sudah join project ini.');
        }

        $project->users()->attach(Auth::id(), [
            'role' => 'collaborator',
            'joined_at' => now(),
        ]);

        return redirect()->route('projects.show', $project)->with('success', 'Berhasil join project.');
    }
}
