@extends('layout.app')



@section('content')
    <section class="">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold">User Management</h1>
            <div class="flex gap-3">
                <a href="{{ route('admin.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa-solid fa-plus"></i> Add User
                </a>
                <a href="{{ route('admin.trash') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa-solid fa-trash"></i> Recycle Bin
                </a>
                <a href="{{ route('export') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                     Export
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="px-4 py-2">User</th>
                        <th class="px-4 py-2">Role</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b hover:bg-gray-50 text-sm sm:text-base">
                            <!-- User Info -->
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $user->avatar
                                        ? asset('storage/' . $user->avatar)
                                        : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                        class="w-10 h-10 rounded-full object-cover flex-shrink-0" />

                                    <div class="min-w-0">
                                        <div class="font-medium truncate max-w-[150px] sm:max-w-none">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-gray-500 text-xs truncate max-w-[150px] sm:max-w-none">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Role -->
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap sm:flex-nowrap justify-start gap-3">
                                    <!-- View -->
                                    <a href="{{ route('admin.show', $user) }}" class="text-blue-500 hover:text-blue-700">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('admin.edit', $user) }}" class="text-green-500 hover:text-green-700">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.destroy', $user) }}" method="POST"
                                        id="deleteForm_{{ $user->id }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-red-500 hover:text-red-700 delete-user"
                                            data-id="{{ $user->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-6 text-gray-500">
                                No users found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.delete-user').forEach(button => {
                    button.addEventListener('click', function() {
                        const userId = this.getAttribute('data-id');
                        if (confirm('Are you sure you want to delete this user?')) {
                            document.getElementById(`deleteForm_${userId}`).submit();
                        }
                    });
                });
            });
        </script>
    </section>
@endsection
