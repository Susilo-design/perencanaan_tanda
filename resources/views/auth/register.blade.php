@extends('layout.app')

@section('content')
    <section class="bg-white">
        <div class="flex justify-center items-center h-[100vh] gap-5">
            <div class="mx-auto w-[100%] basis-210 h-full">
                <img class="w-[100%] h-[100%] object-cover" src="{{ asset('images/Logo No B.png') }}" alt="">
            </div>
            <div class="bg-[#ECECEC] basis-140 h-[100dvh]">
                <div class="min-h-screen flex flex-col">
                    <div class="px-4 py-3">
                        <a href="{{ url()->previous() }}" class="inline-flex items-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <div class="flex-1 bg-gray-100 px-6 py-12">
                        <div class="max-w-md mx-auto">
                            <h1 class="text-3xl font-normal text-gray-800 text-center mb-12">Register</h1>
                            <form method="POST" action="{{ route('register') }}"
                                class="space-y-8">
                                @csrf
                                <div>
                                    <label for="name"
                                        class="block text-gray-700 text-base font-medium mb-3">Nama</label>
                                    <input type="text" id="name" name="name" placeholder="Nama"
                                        value="{{ old('name') }}"
                                        class="w-full px-0 py-3 text-gray-600 placeholder-gray-400 bg-transparent border-0 border-b border-gray-300 focus:border-gray-500 focus:outline-none focus:ring-0 transition-colors duration-200"
                                        required>
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email"
                                        class="block text-gray-700 text-base font-medium mb-3">Email</label>
                                    <input type="email" id="email" name="email" placeholder="Email"
                                        value="{{ old('email') }}"
                                        class="w-full px-0 py-3 text-gray-600 placeholder-gray-400 bg-transparent border-0 border-b border-gray-300 focus:border-gray-500 focus:outline-none focus:ring-0 transition-colors duration-200"
                                        required>
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="password"
                                        class="block text-gray-700 text-base font-medium mb-3">Password</label>
                                    <input type="password" id="password" name="password" placeholder="Password"
                                        class="w-full px-0 py-3 text-gray-600 placeholder-gray-400 bg-transparent border-0 border-b border-gray-300 focus:border-gray-500 focus:outline-none focus:ring-0 transition-colors duration-200"
                                        required>
                                    @error('password')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-gray-700 text-base font-medium mb-3">Konfirmasi Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        placeholder="Konfirmasi Password"
                                        class="w-full px-0 py-3 text-gray-600 placeholder-gray-400 bg-transparent border-0 border-b border-gray-300 focus:border-gray-500 focus:outline-none focus:ring-0 transition-colors duration-200"
                                        required>
                                </div>
                                <div class="pt-8">
                                    <button type="submit"
                                        class="w-full bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-4 px-6 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Register</button>
                                </div>
                                <div class="mt-8 text-center space-y-2">
                                    <p class="text-gray-600 text-sm">
                                        Sudah punya akun?
                                        <a href="{{ route('login') }}"
                                            class="text-green-600 hover:text-green-700 font-medium">Login di sini</a>
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
