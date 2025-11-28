@extends('layout.app')

@section('content')
    <section class=" h-full">
        <div class="flex justify-center items-center h-[100vh] gap-5">
            <div class="mx-auto w-[100%] object-cover basis-210 h-full">
                <img class="w-full h-full  object-cover" src="{{ asset('images/Logo No B.png') }}" alt="">
            </div>
            <div class=" basis-140 h-[100dvh]">
                <div class="min-h-screen flex flex-col">
                    <div class="flex-1  px-6 py-12">
                        <div class="max-w-md mx-auto">
                            <h1 class="text-3xl font-normal text-white text-center mb-2">Register</h1>
                            <form method="POST" action="{{ route('register') }}"
                                class="space-y-8">
                                @csrf
                                <div>
                                    <label for="name"
                                        class="block text-white text-base font-medium mb-3">Nama</label>
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
                                        class="block text-white text-base font-medium mb-3">Email</label>
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
                                        class="block text-white text-base font-medium mb-3">Password</label>
                                    <input type="password" id="password" name="password" placeholder="Password"
                                        class="w-full px-0 py-3 text-gray-600 placeholder-gray-400 bg-transparent border-0 border-b border-gray-300 focus:border-gray-500 focus:outline-none focus:ring-0 transition-colors duration-200"
                                        required>
                                    @error('password')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-white text-base font-medium mb-3">Konfirmasi Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        placeholder="Konfirmasi Password"
                                        class="w-full px-0 py-3 text-gray-600 placeholder-gray-400 bg-transparent border-0 border-b border-gray-300 focus:border-gray-500 focus:outline-none focus:ring-0 transition-colors duration-200"
                                        required>
                                </div>
                                <div class="pt-8">
                                    <button type="submit"
                                        class="w-full bg-gray-300 hover:bg-gray-400 text-white font-medium py-4 px-6 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">Register</button>
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
