@extends('layout.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">{{ $task->title }}</h1>
            <p class="text-gray-400">Task in {{ $project->title }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('user.project.tasks.edit', [$project, $task]) }}" class="bg-[#3498DB] hover:bg-[#2980B9] text-white px-4 py-2 rounded-lg font-medium transition">
                Edit Task
            </a>
            <form action="{{ route('user.project.tasks.destroy', [$project, $task]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this task?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition">
                    Delete Task
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Task Details -->
        <div class="lg:col-span-2">
            <div class="bg-[#292d30] rounded-xl p-6 border border-[#414548]">
                <h2 class="text-lg font-semibold text-white mb-4">Task Details</h2>

                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-300">Description</h3>
                        <p class="text-white mt-1">{{ $task->description ?: 'No description provided.' }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-300">Status</h3>
                            <span class="inline-block mt-1 px-3 py-1 rounded-full text-sm font-medium
                                @if($task->status === 'done') bg-green-600 text-white
                                @elseif($task->status === 'in_progress') bg-yellow-600 text-white
                                @else bg-gray-600 text-white @endif">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-300">Priority</h3>
                            <span class="inline-block mt-1 px-3 py-1 rounded-full text-sm font-medium
                                @if($task->priority === 'high') bg-red-600 text-white
                                @elseif($task->priority === 'medium') bg-yellow-600 text-white
                                @else bg-green-600 text-white @endif">
                                {{ ucfirst($task->priority) }}
                            </span>
                        </div>
                    </div>

                    @if($task->due_date)
                    <div>
                        <h3 class="text-sm font-medium text-gray-300">Due Date</h3>
                        <p class="text-white mt-1">{{ $task->due_date->format('F j, Y') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Project Info -->
            <div class="bg-[#292d30] rounded-xl p-6 border border-[#414548]">
                <h3 class="text-lg font-semibold text-white mb-4">Project</h3>
                <div class="space-y-2">
                    <p class="text-gray-300">{{ $project->title }}</p>
                    <a href="{{ route('user.project.show', $project) }}" class="text-[#3498DB] hover:text-[#5DADE2] text-sm transition">
                        View Project →
                    </a>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-[#292d30] rounded-xl p-6 border border-[#414548]">
                <h3 class="text-lg font-semibold text-white mb-4">Actions</h3>
                <div class="space-y-2">
                    <a href="{{ route('user.project.tasks.index', $project) }}" class="block text-[#3498DB] hover:text-[#5DADE2] transition">
                        ← Back to Tasks
                    </a>
                    <a href="{{ route('user.project.tasks.create', $project) }}" class="block text-[#2ECC71] hover:text-[#00ae56] transition">
                        + Create Another Task
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
