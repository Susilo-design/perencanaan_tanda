@extends('layout.app')

@section('content')
    <section class="px-10 py-20"    >
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Recycle Bin - Deleted Users</h1>
            <a href="{{ route('admin.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fa-solid fa-arrow-left"></i> Back to Users
            </a>
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
                        <th class="px-4 py-2">Deleted At</th>
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

                            <!-- Deleted At -->
                            <td class="px-4 py-3">
                                {{ $user->deleted_at->format('d M Y, H:i') }}
                            </td>

                            <!-- Actions -->
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap sm:flex-nowrap justify-start gap-3">
                                    <!-- Restore -->
                                    <form action="{{ route('admin.restore', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-500 hover:text-green-700"
                                            onclick="return confirm('Are you sure you want to restore this user?')">
                                            <i class="fa-solid fa-undo"></i>
                                        </button>
                                    </form>

                                    <!-- Force Delete -->
                                    <form action="{{ route('admin.force-delete', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700"
                                            onclick="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone!')">
                                            <i class="fa-solid fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">
                                No deleted users found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
