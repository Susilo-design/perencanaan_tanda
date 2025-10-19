@extends('layout.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Tasks for {{ $project->title }}</h1>
            <p class="text-gray-400">Manage your project tasks</p>
        </div>
        <a href="{{ route('user.project.tasks.create', $project) }}" class="bg-[#2ECC71] hover:bg-[#00ae56] text-white px-4 py-2 rounded-lg font-medium transition">
            + Add Task
        </a>
    </div>

    <div class="bg-[#292d30] rounded-xl p-6 border border-[#414548]">
        @if($tasks->count() > 0)
            <div class="space-y-4">
                @foreach($tasks as $task)
                <div class="flex items-center justify-between p-4 bg-[#1A1E21] rounded-lg border border-[#414548]">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" {{ $task->status === 'done' ? 'checked' : '' }} class="task-checkbox w-4 h-4 rounded bg-[#292d30] border-[#414548] text-[#2ECC71] focus:ring-0" data-task-id="{{ $task->id }}" data-project-id="{{ $project->id }}">
                            <span class="{{ $task->status === 'done' ? 'line-through text-gray-500' : 'text-white' }}">{{ $task->title }}</span>
                        </div>
                        <div class="flex flex-row gap-2 items-center text-sm text-gray-400">
                            @if($task->priority)
                                <span class="px-2 py-1 rounded text-xs {{ $task->priority === 'high' ? 'bg-red-600' : ($task->priority === 'medium' ? 'bg-yellow-600' : 'bg-green-600') }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            @endif
                            @if($task->due_date)
                                Due: {{ $task->due_date->format('M d, Y') }}
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('user.project.tasks.show', [$project, $task]) }}" class="text-[#3498DB] hover:text-[#5DADE2] transition">View</a>
                        <a href="{{ route('user.project.tasks.edit', [$project, $task]) }}" class="text-[#2ECC71] hover:text-[#00ae56] transition">Edit</a>
                        <form action="{{ route('user.project.tasks.destroy', [$project, $task]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-400 transition">Delete</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-400 mb-4">No tasks yet.</p>
                <a href="{{ route('user.project.tasks.create', $project) }}" class="bg-[#2ECC71] hover:bg-[#00ae56] text-white px-4 py-2 rounded-lg font-medium transition">
                    Create First Task
                </a>
            </div>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('user.project.show', $project) }}" class="text-[#3498DB] hover:text-[#5DADE2] transition">&larr; Back to Project</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      const checkboxes = document.querySelectorAll('.task-checkbox');

      checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
          const taskId = this.getAttribute('data-task-id');
          const projectId = this.getAttribute('data-project-id');
          const isChecked = this.checked;

          fetch(`/user/project/${projectId}/tasks/${taskId}/toggle`, {
            method: 'PATCH',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({})
          })
          .then(response => response.json())
          .then(data => {
            // Update the visual state
            const taskSpan = this.nextElementSibling;
            if (data.status === 'done') {
              taskSpan.classList.add('line-through', 'text-gray-500');
              taskSpan.classList.remove('text-white');
            } else {
              taskSpan.classList.remove('line-through', 'text-gray-500');
              taskSpan.classList.add('text-white');
            }
          })
          .catch(error => {
            console.error('Error:', error);
            // Revert checkbox state on error
            this.checked = !isChecked;
          });
        });
      });
    });
  </script>
@endsection
