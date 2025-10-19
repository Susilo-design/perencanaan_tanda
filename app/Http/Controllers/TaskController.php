<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * List semua task dari project tertentu
     */
    public function index(Project $project)
    {
        if (!$project->users->contains(Auth::id())) {
            abort(403, 'Unauthorized');
        }

        $tasks = $project->tasks()->get();
        return view('tasks.index', compact('project', 'tasks'));
    }

    /**
     * Form tambah task baru
     */
    public function create(Project $project)
    {
        if (!$project->users->contains(Auth::id())) {
            abort(403, 'Unauthorized');
        }

        return view('tasks.create', compact('project'));
    }

    /**
     * Simpan task baru
     */
    public function store(Request $request, Project $project)
    {
        if (!$project->users->contains(Auth::id())) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'nullable|in:todo,in_progress,done',
            'priority'    => 'nullable|in:low,medium,high',
            'due_date'    => 'nullable|date',
        ]);

        $project->tasks()->create($request->all());

        return redirect()->route('user.project.tasks.index', $project)->with('success', 'Task berhasil dibuat.');
    }

    /**
     * Detail task
     */
    public function show(Project $project, Task $task)
    {
        if (!$project->users->contains(Auth::id())) {
            abort(403, 'Unauthorized');
        }

        return view('tasks.show', compact('project', 'task'));
    }

    /**
     * Form edit task
     */
    public function edit(Project $project, Task $task)
    {
        if (!$project->users->contains(Auth::id())) {
            abort(403, 'Unauthorized');
        }

        return view('tasks.edit', compact('project', 'task'));
    }

    /**
     * Update task
     */
    public function update(Request $request, Project $project, Task $task)
    {
        if (!$project->users->contains(Auth::id())) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'nullable|in:todo,in_progress,done',
            'priority'    => 'nullable|in:low,medium,high',
            'due_date'    => 'nullable|date',
        ]);

        $task->update($request->all());

        return redirect()->route('user.project.tasks.index', $project)->with('success', 'Task berhasil diupdate.');
    }

    /**
     * Toggle task status (AJAX)
     */
    public function toggleStatus(Project $project, Task $task)
    {
        if (!$project->users->contains(Auth::id())) {
            abort(403, 'Unauthorized');
        }

        $task->status = $task->status === 'done' ? 'todo' : 'done';
        $task->save();

        return response()->json(['status' => $task->status]);
    }

    /**
     * Hapus task
     */
    public function destroy(Project $project, Task $task)
    {
        if (!$project->users->contains(Auth::id())) {
            abort(403, 'Unauthorized');
        }

        $task->delete();

        return redirect()->route('user.project.tasks.index', $project)->with('success', 'Task berhasil dihapus.');
    }
}
