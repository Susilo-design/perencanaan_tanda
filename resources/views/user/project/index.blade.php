@extends('layout.app')

<body class="bg-[#1A1E21] text-[#e0e0e0]">
    @section('style')

    @endsection

    @section('content')
        <!-- ========== KONTEN UTAMA ========== -->
        <main class="max-w-7xl mx-auto px-4 py-8">
            <!-- Sambutan -->
            <div class="flex justify-between items-center   ">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2">Halo, <span class="text-[#2ECC71]">John!</span></h1>
                    <p class="text-gray-400">Berikut project & jadwal kamu hari ini</p>
                </div>
                <div>
                    <a class="group relative inline-block text-sm font-medium text-black focus:ring-3 focus:outline-hidden"
                        href="{{ route('projects.create') }}">
                        <span
                            class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-indigo-600 transition-transform group-hover:translate-x-0 group-hover:translate-y-0"></span>

                        <span class="relative block border border-current bg-white px-8 py-3"> Create Project </span>
                    </a>
                </div>
            </div>

            <!-- Quick Stats (statis) -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <!-- Card 1 -->
                <div class="bg-[#292d30] p-5 rounded-xl border border-[#414548] hover:border-[#2ECC71] transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Project Aktif</p>
                            <p class="text-2xl font-bold text-white mt-1">3</p>
                        </div>
                        <div class="w-10 h-10 bg-[#2ECC71]/20 rounded-lg grid place-items-center">
                            <svg class="w-5 h-5 text-[#2ECC71]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-[#292d30] p-5 rounded-xl border border-[#414548] hover:border-[#3498DB] transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Task Hari Ini</p>
                            <p class="text-2xl font-bold text-white mt-1">12</p>
                        </div>
                        <div class="w-10 h-10 bg-[#3498DB]/20 rounded-lg grid place-items-center">
                            <svg class="w-5 h-5 text-[#3498DB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-[#292d30] p-5 rounded-xl border border-[#414548] hover:border-[#00ae56] transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Selesai Bulan Ini</p>
                            <p class="text-2xl font-bold text-white mt-1">8</p>
                        </div>
                        <div class="w-10 h-10 bg-[#00ae56]/20 rounded-lg grid place-items-center">
                            <svg class="w-5 h-5 text-[#00ae56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-[#292d30] p-5 rounded-xl border border-[#414548] hover:border-[#006a18] transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Project</p>
                            <p class="text-2xl font-bold text-white mt-1">15</p>
                        </div>
                        <div class="w-10 h-10 bg-[#006a18]/20 rounded-lg grid place-items-center">
                            <svg class="w-5 h-5 text-[#006a18]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project cards dan jadwal lanjut seperti kode asli... -->
        </main>

        <!-- Modal Join with Code -->
        <div id="modalJoin" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
            <div class="bg-[#292d30] rounded-2xl p-6 w-full max-w-md border border-[#414548]">
                <h3 class="text-xl font-bold text-white mb-2">Gabung Project via Kode</h3>
                <p class="text-gray-400 text-sm mb-4">Masukkan 6-digit kode yang diberikan ketua project.</p>
                <form id="formJoin" action="#" method="POST">
                    <input type="text" name="code" placeholder="contoh: ABC123" maxlength="6" required
                        class="w-full px-4 py-3 bg-[#414548] text-white placeholder-gray-400 rounded-lg border-2 border-transparent focus:border-[#3498DB] focus:bg-[#292d30] focus:outline-none transition mb-4">
                    <div class="flex space-x-3">
                        <button type="submit"
                            class="flex-1 bg-[#2ECC71] hover:bg-[#00ae56] text-white py-2.5 rounded-lg font-medium transition">Gabung</button>
                        <button type="button" id="btnCancelJoin"
                            class="flex-1 bg-[#414548] hover:bg-[#292d30] text-gray-300 py-2.5 rounded-lg font-medium transition">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection



    @push('scripts')
        <script>
            // Toggle modal Join with Code
            const modal = document.getElementById('modalJoin');
            document.getElementById('btnJoinCode').addEventListener('click', () => modal.classList.remove('hidden'));
            document.getElementById('btnCancelJoin').addEventListener('click', () => modal.classList.add('hidden'));
        </script>
    @endpush
    <script></script>
</body>

</html>
