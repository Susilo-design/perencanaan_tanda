@extends('layout.app')

@section('title', isset($project) ? 'Detail Project' : 'Projects')

@section('content')
    @if (isset($project))
        <!-- Detail Project View -->
        <main class="max-w-5xl mx-auto px-6 py-8 grid gap-8">

            <!-- Project Header -->
            <section class="bg-[#292d30] rounded-xl p-6 border border-[#414548]">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-[#2ECC71]">{{ $project->title }}</h1>
                        <p class="text-[#e0e0e0] mt-2 max-w-2xl">
                            {{ $project->description ?? 'No description provided.' }}
                        </p>
                    </div>
                    @php
                        $statusLabel = $project->status === 'completed' ? 'Completed' : 'On Progress';
                        $statusClass =
                            $project->status === 'completed'
                                ? 'bg-[#006a18] text-[#2ECC71] border-[#2ECC71]'
                                : 'bg-[#7D6608] text-[#F7DC6F] border-[#F7DC6F]';
                    @endphp
                    <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }} border">
                        {{ $statusLabel }}
                    </span>
                </div>


                    <!-- Meta row -->
                    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <h3 class="text-[#3498DB] text-xs uppercase tracking-wide">Start</h3>
                            <p class="text-white mt-1">
                                {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d M Y') : 'Not set' }}
                            </p>
                        </div>
                        <div>
                            <h3 class="text-[#3498DB] text-xs uppercase tracking-wide">Deadline</h3>
                            <p class="text-white mt-1">
                                {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : 'Not set' }}
                            </p>
                        </div>
                        <div>
                            <h3 class="text-[#3498DB] text-xs uppercase tracking-wide">Join Code</h3>
                            <p class="text-white mt-1 font-mono">{{ $project->join_code }}</p>
                        </div>
                        <div>
                            <h3 class="text-[#3498DB] text-xs uppercase tracking-wide">Owner</h3>
                            <p class="text-white mt-1">{{ $project->owner->name }}</p>
                        </div>
                    </div>
            </section>


            <!-- Task List -->
            <section class="bg-[#292d30] rounded-xl p-6 border border-[#414548]">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-[#2ECC71]">Tasks</h2>
                    <a href="{{ route('user.project.tasks.create', $project) }}"
                        class="px-3 py-1.5 rounded-lg text-sm bg-[#006a18] hover:bg-[#00ae56] transition text-white">+ Add
                        Task</a>
                </div>

                @if ($project->tasks->count() > 0)
                    <ul class="space-y-3">
                        @foreach ($project->tasks as $task)
                            <li
                                class="flex items-center justify-between p-3 rounded-lg bg-[#1A1E21] border border-[#414548]">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" {{ $task->status === 'done' ? 'checked' : '' }}
                                        class="task-checkbox w-4 h-4 rounded bg-[#292d30] border-[#414548] text-[#2ECC71] focus:ring-0"
                                        data-task-id="{{ $task->id }}" data-project-id="{{ $project->id }}" />
                                    <a href="{{ route('user.project.tasks.show', [$project, $task]) }}"
                                        class="{{ $task->status === 'done' ? 'line-through text-[#e0e0e0]' : 'text-white' }} hover:text-[#3498DB] transition">{{ $task->title }}</a>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if ($task->priority)
                                        <span
                                            class="px-2 py-1 rounded text-xs {{ $task->priority === 'high' ? 'bg-red-600' : ($task->priority === 'medium' ? 'bg-yellow-600' : 'bg-green-600') }}">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    @endif
                                    <span
                                        class="text-xs text-[#e0e0e0]">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-4 flex gap-4">
                        <a href="{{ route('user.project.tasks.index', $project) }}"
                            class="text-[#3498DB] hover:text-[#5DADE2] text-sm transition">View All Tasks →</a>
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-[#e0e0e0] mb-4">No tasks yet.</p>
                        <a href="{{ route('user.project.tasks.create', $project) }}"
                            class="px-4 py-2 bg-[#2ECC71] hover:bg-[#00ae56] text-white rounded-lg font-medium transition">Create
                            First Task</a>
                    </div>
                @endif
            </section>

            <!-- Action Buttons -->
            <section class="flex flex-wrap gap-3">
                @if ($project->host_id === Auth::id() && $project->status !== 'completed')
                    <form action="{{ route('user.project.update', $project) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit"
                            class="px-5 py-2 rounded-lg bg-[#00ae56] hover:bg-[#2ECC71] text-white font-medium transition">
                            Mark as Complete
                        </button>
                    </form>
                @endif
                <a href="{{ route('user.dashboard') }}"
                    class="px-5 py-2 rounded-lg bg-[#292d30] hover:bg-[#414548] text-[#e0e0e0] font-medium transition border border-[#414548]">
                    Back to Dashboard
                </a>
            </section>

        </main>

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
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({})
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Update the visual state
                                const taskLink = this.nextElementSibling;
                                if (data.status === 'done') {
                                    taskLink.classList.add('line-through', 'text-[#e0e0e0]');
                                    taskLink.classList.remove('text-white');
                                } else {
                                    taskLink.classList.remove('line-through', 'text-[#e0e0e0]');
                                    taskLink.classList.add('text-white');
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
    @else
        <!-- List Projects View -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <h1 class="text-3xl font-bold text-white mb-6">My Projects</h1>

                @if ($projects->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($projects as $project)
                            <div
                                class="bg-[#292d30] rounded-xl p-6 border border-[#414548] hover:border-[#2ECC71] transition">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <h2 class="text-xl font-bold text-[#2ECC71]">{{ $project->title }}</h2>
                                        <p class="text-[#e0e0e0] mt-1 text-sm">
                                            {{ $project->description ?? 'No description provided.' }}
                                        </p>
                                    </div>
                                    @php
                                        $statusLabel = $project->status === 'completed' ? 'Completed' : 'On Progress';
                                        $statusClass =
                                            $project->status === 'completed'
                                                ? 'bg-[#006a18] text-[#2ECC71] border-[#2ECC71]'
                                                : 'bg-[#7D6608] text-[#F7DC6F] border-[#F7DC6F]';
                                    @endphp
                                    <span
                                        class="inline-block px-2 py-1 rounded-full text-xs font-medium {{ $statusClass }} border">
                                        {{ $statusLabel }}
                                    </span>
                                </div>

                                <div class="space-y-2 text-sm text-[#e0e0e0]">
                                    <div class="flex justify-between">
                                        <span>Start:</span>
                                        <span>{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d M Y') : 'Not set' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Deadline:</span>
                                        <span>{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : 'Not set' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Tasks:</span>
                                        <span>{{ $project->tasks->count() }}</span>
                                    </div>
                                </div>

                                <div class="mt-4 flex gap-2">
                                    <a href="{{ route('user.project.show', $project) }}"
                                        class="flex-1 px-3 py-2 bg-[#2ECC71] hover:bg-[#00ae56] text-white rounded-lg font-medium transition text-center text-sm">
                                        View Details
                                    </a>
                                    @if ($project->host_id === Auth::id())
                                        <a href="{{ route('user.project.edit', $project) }}"
                                            class="px-3 py-2 bg-[#3498DB] hover:bg-[#5DADE2] text-white rounded-lg font-medium transition text-sm">
                                            Edit
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-[#e0e0e0] mb-4">You haven't created any projects yet.</p>
                        <a href="{{ route('user.project.create') }}"
                            class="px-6 py-3 bg-[#2ECC71] hover:bg-[#00ae56] text-white rounded-lg font-medium transition">
                            Create Your First Project
                        </a>
                    </div>
                @endif
            </div>
        </main>
    @endif
@endsection
