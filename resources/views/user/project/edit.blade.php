    @extends('layout.app')

    @section('content')
        <!-- Main Content -->
        <main class="max-w-3xl mx-auto px-4 py-8">
            <div class="flex items-center justify-between space-x-3">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2">Edit Project</h1>
                    <p class="text-gray-400">Update detail project Anda</p>
                </div>

                <a href="{{ route('user.project.show', $project) }}" class="text-gray-400 hover:text-white transition">←
                    Kembali</a>
            </div>

            <!-- Form Edit Project -->
            <div class="bg-[#292d30] rounded-xl p-8 border border-[#414548]">
                <form action="{{ route('user.project.update', $project) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Project Name -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-white mb-2">Nama Project *</label>
                        <input type="text" name="title" id="title" required value="{{ old('title', $project->title) }}"
                            class="w-full px-4 py-3 bg-[#414548] text-white rounded-lg border-2 border-transparent focus:border-[#2ECC71] focus:bg-[#292d30] focus:outline-none transition"
                            placeholder="Contoh: Website E-Commerce">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-white mb-2">Deskripsi Project</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-3 bg-[#414548] text-white rounded-lg border-2 border-transparent focus:border-[#2ECC71] focus:bg-[#292d30] focus:outline-none transition resize-none"
                            placeholder="Jelaskan tujuan dan ruang lingkup project...">{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date Range -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-white mb-2">Tanggal Mulai *</label>
                            <input type="date" name="start_date" id="start_date" required
                                value="{{ old('start_date', $project->start_date ? $project->start_date->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-3 bg-[#414548] text-white rounded-lg border-2 border-transparent focus:border-[#2ECC71] focus:bg-[#292d30] focus:outline-none transition">
                            @error('start_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-white mb-2">Tanggal Selesai *</label>
                            <input type="date" name="end_date" id="end_date" required
                                value="{{ old('end_date', $project->end_date ? $project->end_date->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-3 bg-[#414548] text-white rounded-lg border-2 border-transparent focus:border-[#2ECC71] focus:bg-[#292d30] focus:outline-none transition">
                            @error('end_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-white mb-2">Status Project *</label>
                        <select name="status" id="status" required
                            class="w-full px-4 py-3 bg-[#414548] text-white rounded-lg border-2 border-transparent focus:border-[#2ECC71] focus:bg-[#292d30] focus:outline-none transition">
                            <option hidden disabled selected>Pilih Status</option>
                            <option value="on_progress"
                                {{ old('status', $project->status) === 'on_progress' ? 'selected' : '' }}>Aktif</option>
                            <option value="completed" {{ old('status', $project->status) === 'completed' ? 'selected' : '' }}>
                                Selesai</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Project Info Section -->
                    <div class="bg-[#1A1E21] rounded-lg p-4 border border-[#414548]">
                        <h3 class="text-sm font-medium text-[#2ECC71] mb-3">Informasi Project</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-400">ID Project:</span>
                                <span class="text-white font-mono">{{ $project->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Kode Bergabung:</span>
                                <span class="text-white font-mono">{{ $project->join_code }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Dibuat pada:</span>
                                <span class="text-white">{{ $project->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Terakhir diubah:</span>
                                <span class="text-white">{{ $project->updated_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between pt-6 border-t border-[#414548]">
                        <div class="flex gap-3">
                            <a href="{{ route('user.project.show', $project) }}"
                                class="px-6 py-3 bg-[#414548] hover:bg-[#1A1E21] text-gray-300 rounded-lg font-medium transition">
                                Batal
                            </a>
                        </div>
                        <div class="flex gap-3">
                            <form action="{{ route('user.project.destroy', $project) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus project ini? Semua data akan dihapus.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">
                                    Hapus Project
                                </button>
                            </form>
                            <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-[#2ECC71] to-[#00ae56] hover:from-[#00ae56] hover:to-[#006a18] text-white rounded-lg font-medium transition">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Danger Zone -->
            @if ($project->status !== 'completed')
                <div class="max-w-3xl mx-auto mt-8 bg-red-950 rounded-xl p-6 border border-red-800">
                    <h3 class="text-lg font-semibold text-red-400 mb-2">Selesaikan Project</h3>
                    <p class="text-red-200 text-sm mb-4">Saat project ditandai selesai, anggota tidak dapat membuat atau
                        mengubah task baru.</p>
                    <form action="{{ route('user.project.update', $project) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">
                            Tandai Selesai
                        </button>
                    </form>
                </div>
            @else
                <div class="max-w-3xl mx-auto mt-8 bg-green-950 rounded-xl p-6 border border-green-800">
                    <h3 class="text-lg font-semibold text-green-400 mb-2">✓ Project Selesai</h3>
                    <p class="text-green-200 text-sm">Project ini telah ditandai selesai pada
                        {{ $project->updated_at->format('d M Y H:i') }}</p>
                </div>
            @endif
        </main>
    @endsection
