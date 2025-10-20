<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
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
            <a href="{{ route('user.dashboard') }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                Dashboard
            </a>

            <a href="{{ route('user.profile.edit') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Edit Profile
            </a>

            <form method="POST" action="{{ route('user.logout') }}" class="inline">
                @csrf
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Logout
                </button>
            </form>
        </div>

        <div class="bg-gray-600 shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold     mb-4">Informasi Akun</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium ">Nama</dt>
                    <dd class="mt-1 ">{{ Auth::user()->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium ">Email</dt>
                    <dd class="mt-1 ">{{ Auth::user()->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium ">Bergabung sejak</dt>
                    <dd class="mt-1 ">{{ Auth::user()->created_at->format('d M Y') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</body>

</html>
