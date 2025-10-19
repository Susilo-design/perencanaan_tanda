<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-[#1A1E21] text-[#e0e0e0]">
    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <a href="{{ route('user.profile') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                ← Kembali ke Profile
            </a>
        </div>

        <div class="bg-gray-600 shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Edit Profile</h2>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-600 text-white rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-600 text-white rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-2">Nama</label>
                    <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                        class="w-full px-3 py-2 bg-gray-700 border border-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="avatar" class="block text-sm font-medium mb-2">Avatar</label>
                    <input type="file" name="avatar" id="avatar" accept="image/*"
                        class="w-full px-3 py-2 bg-gray-700 border border-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <p class="text-sm text-gray-400 mt-1">Format: JPG, JPEG, PNG, SVG, WEBP. Maksimal 2MB.</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Preview Avatar</label>
                    <div class="flex items-center space-x-4">
                        <img id="avatar-preview" class="h-24 w-24 rounded-full object-cover shadow-lg"
                            src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=128' }}"
                            alt="Current Avatar">
                        <div>
                            <p class="text-sm text-gray-400">Ini adalah preview avatar Anda saat ini.</p>
                            <p class="text-sm text-gray-400">Pilih file baru untuk melihat preview.</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('avatar').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
