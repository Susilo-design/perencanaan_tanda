<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tanda</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @stack('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-[#1A1E21] text-[#e0e0e0]">

    @auth
        <nav class="bg-green-800 text-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">

                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('user.dashboard') }}" class="text-xl font-bold ">Tanda</a>
                    </div>

                    <!-- Nav Links & Profile -->
                    <div class="flex items-center space-x-6">
                        @auth
                            @if (Auth::check() && Auth::user()->role == 'admin')

                            @else
                                <a href="{{ route('user.dashboard') }}"
                                    class=" hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">
                                    Dashboard
                                </a>


                                <!-- Schedule Button -->
                                <a href="{{ route('user.schedules.index') }}"
                                    class=" hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">
                                    Schedule
                                </a>


                                <!-- Projects Button -->
                                <a href="{{ route('user.project.index') }}"
                                    class=" hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">
                                    Projects
                                </a>

                                <!-- Profile Dropdown -->
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open"
                                        class="flex items-center space-x-2 text-sm font-medium  hover:text-indigo-600 focus:outline-none">
                                        <img class="h-10 w-10 rounded-full object-cover shadow-lg"
                                            src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=128' }}"
                                            alt="Avatar">
                                        <span>{{ Auth::user()->name }}</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div x-show="open" @click.away="open = false"
                                        class="absolute right-0 mt-2 w-48 bg-black rounded-md shadow-lg py-2 z-50">
                                        <a href="{{ route('user.profile') }}"
                                            class="block px-4 py-2 text-sm  hover:bg-gray-100">Profile</a>
                                        <form method="POST" action="{{ route('user.logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="block w-full text-left px-4 py-2 text-sm  hover:bg-gray-100">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    @endauth






    @yield('content')
    @stack('scripts')
</body>

</html>
