@extends('layout.app')


@section('content')
    <section>
        <div class="flex justify-center items-center h-[100%] gap-5  ">
            <!-- Left image -->
            <div class="mx-auto w-[100%] basis-210 h-full bg-[#1A1E21] text-[#e0e0e0]">
                <img class="w-[100%] h-[100%]" src="{{ asset('images/Logo') }}" alt="">
            </div>

            <!-- Right form -->
            <div class=" basis-140 h-[100dvh] bg-[#1A1E21] text-[#e0e0e0]">
                <div class="min-h-screen flex flex-col">

                    <!-- Header with back arrow -->
                    <div class="px-4 py-3">
                        <a href="{{ url()->previous() }}" class="inline-flex items-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                        </a>
                    </div>

                    <!-- Main content -->
                    <div class="flex-1 bg-[#1A1E21] text-[#e0e0e0]  px-6 py-12">
                        <div class="max-w-md mx-auto">
                            <!-- Login Title -->
                            <h1 class="text-3xl font-normal text-gray-800 text-center mb-12">
                                Login
                            </h1>

                            <!-- Login Form -->
                            <form method="POST" action="{{ route('login') }}" class="space-y-8">
                                @csrf
                                <!-- Email Field -->
                                <div class="">
                                    <label for="email" class="block text-white text-base font-medium mb-3">
                                        Email
                                    </label>
                                    <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}"
                                        class="w-full px-0 py-3 text-gray-600 placeholder-gray-400 bg-transparent border-0 border-b border-gray-300 focus:border-gray-500 focus:outline-none focus:ring-0 transition-colors duration-200"
                                        required autocomplete="username">
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password Field -->
                                <div>
                                    <label for="password" class="block text-white text-base font-medium mb-3">
                                        Password
                                    </label>
                                    <input type="password" id="password" name="password" placeholder="Password"
                                        class="w-full px-0 py-3 text-white placeholder-gray-400 bg-transparent border-0 border-b border-gray-300 focus:border-gray-500 focus:outline-none focus:ring-0 transition-colors duration-200"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>


                                <!-- reCAPTCHA -->
                                <div class="mt-4">
                                    <div class="">
                                    </div>
                                    @error('g-recaptcha-response')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>


                                <!-- Login Button -->
                                <div class="pt-8">
                                    <button type="submit"
                                        class="w-full bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-4 px-6 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">
                                        Login
                                    </button>
                                </div>

                                <div class="mt-8 text-center space-y-2">
                                    <p class="text-gray-600 text-sm">
                                        Belum punya akun?
                                        <a href="{{ route('register') }}"
                                            class="text-green-600 hover:text-green-700 font-medium">
                                            Register di sini
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
