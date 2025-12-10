<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function tasksChart()
    {
        $projects = Auth::user()->joinedProjects()->with('tasks')->get();

        $allTasks = $projects->pluck('tasks')->flatten();

        $data = [
            $allTasks->where('status', 'pending')->count(),
            $allTasks->where('status', 'in_progress')->count(),
            $allTasks->where('status', 'done')->count()
        ];

        return response()->json([
            'labels' => ['To Do', 'In Progress', 'Done'],
            'data' => $data
        ]);
    }



    /**
     * List semua task dari project tertentu
     */
    public function index(Project $project)
    {
        if (!$project->users->contains(Auth::id())) {
            abort(403, 'Unauthorized');
        }

        $userRole = $project->users()->where('user_id', Auth::id())->first()->pivot->role_in_project;

        if ($userRole === 'member') {
            $tasks = $project->tasks()->where('assigned_to', Auth::id())->get();
        } else {
            $tasks = $project->tasks()->get();
        }

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

        $userRole = $project->users()->where('user_id', Auth::id())->first()->pivot->role_in_project;

        if ($userRole === 'member') {
            abort(403, 'Members cannot create tasks.');
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

        $userRole = $project->users()->where('user_id', Auth::id())->first()->pivot->role_in_project;

        if ($userRole === 'member') {
            abort(403, 'Members cannot create tasks.');
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'nullable|in:pending,in_progress,done',
            'priority'    => 'nullable|in:low,medium,high',
            'due_date'    => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
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

        $userRole = $project->users()->where('user_id', Auth::id())->first()->pivot->role_in_project;

        if ($userRole === 'member' && $task->assigned_to !== Auth::id()) {
            abort(403, 'Members can only view their own tasks.');
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

        $userRole = $project->users()->where('user_id', Auth::id())->first()->pivot->role_in_project;

    

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

        $userRole = $project->users()->where('user_id', Auth::id())->first()->pivot->role_in_project;

        if ($userRole === 'member') {
            // Members can only update status to 'done'
            $request->validate([
                'status' => 'required|in:done',
            ]);
            $task->update(['status' => $request->status]);
        } else {
            // Hosts can update all fields
            $request->validate([
                'title'       => 'required|string|max:255',
                'description' => 'nullable|string',
                'status'      => 'nullable|in:todo,in_progress,done',
                'priority'    => 'nullable|in:low,medium,high',
                'due_date'    => 'nullable|date',
                'assigned_to' => 'nullable|exists:users,id',
            ]);
            $task->update($request->all());
        }

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

        $userRole = $project->users()->where('user_id', Auth::id())->first()->pivot->role_in_project;

        if ($userRole === 'member') {
            if ($task->assigned_to === Auth::id() && $task->status !== 'done') {
                $task->status = 'done';
                $task->save();
            } else {
                abort(403, 'Members can only mark their own tasks as done.');
            }
        } else {
            $task->status = $task->status === 'done' ? 'todo' : 'done';
            $task->save();
        }

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

        $userRole = $project->users()->where('user_id', Auth::id())->first()->pivot->role_in_project;

        if ($userRole === 'member') {
            abort(403, 'Members cannot delete tasks.');
        }

        $task->delete();

        return redirect()->route('user.project.tasks.index', $project)->with('success', 'Task berhasil dihapus.');
    }
}
