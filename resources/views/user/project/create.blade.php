@extends('layout.app')

@section('content')
    <!-- Sticky Header -->

    <!-- Main Content -->
    <main class="max-w-3xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between space-x-3">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Buat Project Baru</h1>
                <p class="text-gray-400">Isi detail project untuk memulai kolaborasi tim</p>
            </div>

            <a href="/home" class="text-gray-400 hover:text-white transition">← Kembali</a>
        </div>

        <!-- Form Create Project -->
        <div class="bg-[#292d30] rounded-xl p-8 border border-[#414548]">
            <form action="{{ route('projects.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Project Name -->
                <div>
                    <label for="title" class="block text-sm font-medium text-white mb-2">Nama Project *</label>
                    <input type="text" name="title" id="title" required
                        class="w-full px-4 py-3 bg-[#414548] text-white rounded-lg border-2 border-transparent focus:border-[#2ECC71] focus:bg-[#292d30] focus:outline-none transition"
                        placeholder="Contoh: Website E-Commerce">
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-white mb-2">Deskripsi Project</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-3 bg-[#414548] text-white rounded-lg border-2 border-transparent focus:border-[#2ECC71] focus:bg-[#292d30] focus:outline-none transition resize-none"
                        placeholder="Jelaskan tujuan dan ruang lingkup project..."></textarea>
                </div>

                <!-- Date Range -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-white mb-2">Tanggal Mulai *</label>
                        <input type="date" name="start_date" id="start_date" required
                            class="w-full px-4 py-3 bg-[#414548] text-white rounded-lg border-2 border-transparent focus:border-[#2ECC71] focus:bg-[#292d30] focus:outline-none transition">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-white mb-2">Tanggal Selesai *</label>
                        <input type="date" name="end_date" id="end_date" required
                            class="w-full px-4 py-3 bg-[#414548] text-white rounded-lg border-2 border-transparent focus:border-[#2ECC71] focus:bg-[#292d30] focus:outline-none transition">
                    </div>
                </div>

                <!-- Priority -->
                <div>
                    <label for="priority" class="block text-sm font-medium text-white mb-2">Prioritas *</label>
                    <select name="priority" id="priority" required
                        class="w-full px-4 py-3 bg-[#414548] text-white rounded-lg border-2 border-transparent focus:border-[#2ECC71] focus:bg-[#292d30] focus:outline-none transition">
                        <option value="">Pilih Prioritas</option>
                        <option value="low">Rendah</option>
                        <option value="medium">Sedang</option>
                        <option value="high">Tinggi</option>
                        <option value="urgent">Segera</option>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-white mb-2">Status Project *</label>
                    <select name="status" id="status" required
                        class="w-full px-4 py-3 bg-[#414548] text-white rounded-lg border-2 border-transparent focus:border-[#2ECC71] focus:bg-[#292d30] focus:outline-none transition">
                        <option value="">Pilih Status</option>
                        <option value="planning">Perencanaan</option>
                        <option value="active">Aktif</option>
                        <option value="on_hold">Tertunda</option>
                        <option value="completed">Selesai</option>
                    </select>
                </div>

                <!-- Join Code (Auto Generated) -->
                <div>
                    <label for="join_code" class="block text-sm font-medium text-white mb-2">Kode Bergabung</label>
                    <div class="flex space-x-3">
                        <input type="text" name="join_code" id="join_code" readonly value="ABC123"
                            class="flex-1 px-4 py-3 bg-[#414548] text-white rounded-lg border-2 border-[#414548] focus:outline-none">
                        <button type="button" onclick="generateCode()"
                            class="px-6 py-3 bg-[#3498DB] hover:bg-[#004079] text-white rounded-lg font-medium transition">
                            Generate
                        </button>
                    </div>
                    <p class="text-gray-400 text-xs mt-2">Kode ini digunakan anggota tim untuk bergabung ke project</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-6">
                    <a href="/home"
                        class="px-6 py-3 bg-[#414548] hover:bg-[#292d30] text-gray-300 rounded-lg font-medium transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-[#2ECC71] to-[#00ae56] hover:from-[#00ae56] hover:to-[#006a18] text-white rounded-lg font-medium transition">
                        Buat Project
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('script')
    <script>
        function generateCode() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let code = '';
            for (let i = 0; i < 6; i++) {
                code += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('join_code').value = code;
        }
    </script>
@endpush

</body>

</html>
