@extends('layout.app')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white">Create New Task</h1>
        <p class="text-gray-400">Add a task to {{ $project->title }}</p>
    </div>

    <div class="bg-[#292d30] rounded-xl p-6 border border-[#414548]">
        <form action="{{ route('user.project.tasks.store', $project) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Task Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       class="w-full px-3 py-2 bg-[#1A1E21] border border-[#414548] rounded-lg text-white placeholder-gray-400 focus:border-[#3498DB] focus:outline-none">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full px-3 py-2 bg-[#1A1E21] border border-[#414548] rounded-lg text-white placeholder-gray-400 focus:border-[#3498DB] focus:outline-none">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                    <select name="status" id="status"
                            class="w-full px-3 py-2 bg-[#1A1E21] border border-[#414548] rounded-lg text-white focus:border-[#3498DB] focus:outline-none">
                        <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ old('status') === 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-300 mb-2">Priority</label>
                    <select name="priority" id="priority"
                            class="w-full px-3 py-2 bg-[#1A1E21] border border-[#414548] rounded-lg text-white focus:border-[#3498DB] focus:outline-none">
                        <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-300 mb-2">Due Date</label>
                    <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"
                           class="w-full px-3 py-2 bg-[#1A1E21] border border-[#414548] rounded-lg text-white focus:border-[#3498DB] focus:outline-none">
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('user.project.tasks.index', $project) }}" class="px-4 py-2 bg-[#414548] hover:bg-[#292d30] text-gray-300 rounded-lg transition">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-[#2ECC71] hover:bg-[#00ae56] text-white rounded-lg font-medium transition">
                    Create Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
