<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-black">
   <x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="flex items-center space-x-6 mb-8">
            <img class="h-24 w-24 rounded-full object-cover shadow-lg"
                 src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=128' }}"
                 alt="Avatar">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h1>
                <p class="text-gray-600">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-4 mb-10">
            <a href="{{ route('profile.edit') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Edit Profil
            </a>

            <a href="{{ route('password.change') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                Ganti Password
            </a>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Logout
                </button>
            </form>
        </div>

        <!-- Info Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Akun</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                    <dd class="mt-1 text-gray-900">{{ Auth::user()->name }}</dd>l
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-gray-900">{{ Auth::user()->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Bergabung sejak</dt>
                    <dd class="mt-1 text-gray-900">{{ Auth::user()->created_at->format('d M Y') }}</dd>
                </div>
            </dl>
        </div>

    </div>
</x-app-layout>
</body>

</html>
