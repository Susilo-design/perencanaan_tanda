<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-[#1A1E21] text-[#e0e0e0]">
    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <div class="flex items-center space-x-6 mb-8">
            <img class="h-24 w-24 rounded-full object-cover shadow-lg"
                src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=128' }}"
                alt="Avatar">
            <div>
                <h1 class="text-2xl font-bold ">{{ Auth::user()->name }}</h1>
                <p class="">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="flex flex-wrap gap-4 mb-10">
            <a href="{{ route('user.profile') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                Back to Profile
            </a>
        </div>

        <div class="bg-gray-600 shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Edit Profile</h2>

            <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium ">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-700 text-white"
                        required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="avatar" class="block text-sm font-medium ">Avatar</label>
                    <input type="file" name="avatar" id="avatar" accept="image/*"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-700 text-white">
                    @error('avatar')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
