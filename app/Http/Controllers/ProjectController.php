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
        $projects = Auth::user()->joinedProjects()->with('tasks')->get();
        return view('user.project.index', compact('projects'));
    }

    public function dashboard()
    {
        $projects = Auth::user()->joinedProjects()->with('tasks')->get();
        return view('user.dashboard', compact('projects'));
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

        $project = new Project([
            'host_id'     => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'join_code'   => strtoupper(Str::random(8)),
        ]);

        $project->save();

        // tambahkan host ke tabel project_user dengan role_in_project = 'host'
        $project->users()->attach(Auth::id(), [
            'role_in_project' => 'host',
            'joined_at' => now(),
        ]);

        // Create default schedule based on project dates
        if ($request->start_date && $request->end_date) {
            $project->schedules()->create([
                'title' => 'Project Timeline',
                'description' => 'Default schedule for project timeline',
                'start_time' => $request->start_date . ' 09:00:00',
                'end_time' => $request->end_date . ' 17:00:00',
                'priority' => 'medium',
            ]);
        }

        return redirect()->route('user.dashboard')->with('success', 'Project berhasil dibuat.');
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

        $project->load('tasks');
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

        return view('user.project.edit', compact('project'));
    }

    /**
     * Update project
     */
    public function update(Request $request, Project $project)
    {
        if ($project->owner_id !== Auth::id()) {
            abort(403, 'Hanya owner yang bisa update project');
        }

        if ($request->has('status') && $request->status === 'completed') {
            $project->update(['status' => 'completed']);
            return redirect()->route('user.project.show', $project)->with('success', 'Project marked as completed.');
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

        return redirect()->route('user.project.show', $project)->with('success', 'Project berhasil diupdate.');
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
     * Form join project
     */
    public function joinForm()
    {
        return view('user.project.join');
    }

    /**
     * Join project pakai join_code
     */
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

        return redirect()->route('user.project.show', $project)->with('success', 'Berhasil join project.');
    }
}
