@extends('layout.app')

@section('content')
    {{-- Halaman untuk bergabung ke proyek menggunakan kode join dalam sistem kolaborasi --}}
    <div class="max-w-md mx-auto px-6 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-white">Join Project</h1>
            <p class="text-gray-400">Masukkan kode join untuk bergabung ke proyek</p> {{-- Instruksi untuk pengguna --}}
        </div>

        <div class="bg-[#292d30] rounded-xl p-6 border border-[#414548]">
            {{-- Form untuk submit kode join --}}
            <form action="{{ route('user.join') }}" method="POST">
                @csrf {{-- Token CSRF untuk keamanan --}}

                <div class="mb-4">
                    <label for="join_code" class="block text-sm font-medium text-gray-300 mb-2">Kode Join</label>
                    {{-- Label untuk input kode --}}
                    <input type="text" name="join_code" id="join_code" value="{{ old('join_code') }}" required
                        class="w-full px-3 py-2 bg-[#1A1E21] border border-[#414548] rounded-lg text-white placeholder-gray-400 focus:border-[#3498DB] focus:outline-none uppercase"
                        placeholder="Masukkan kode 6 karakter"> {{-- Input untuk kode join --}}
                    @error('join_code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p> {{-- Tampilkan error jika validasi gagal --}}
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('user.dashboard') }}"
                        class="px-4 py-2 bg-[#414548] hover:bg-[#292d30] text-gray-300 rounded-lg transition">
                        Batal {{-- Tombol untuk membatalkan --}}
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-[#2ECC71] hover:bg-[#00ae56] text-white rounded-lg font-medium transition">
                        Bergabung ke Proyek {{-- Tombol submit untuk join --}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
