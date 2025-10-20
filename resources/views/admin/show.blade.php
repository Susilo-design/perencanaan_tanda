@extends('layout.app')

@section('content')
    <section class="">
        <div class="max-w-2xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">User Details</h1>
                <div class="flex gap-3">
                    <a href="{{ route('admin.edit', $user) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fa-solid fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Back to List
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex items-center gap-4 mb-6">
                    <img src="{{ $user->avatar
                        ? asset('storage/' . $user->avatar)
                        : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                        class="w-20 h-20 rounded-full object-cover" />
                    <div>
                        <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <p class="mt-1 text-sm text-gray-900">{{ ucfirst($user->role) }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Created At</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Updated At</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
