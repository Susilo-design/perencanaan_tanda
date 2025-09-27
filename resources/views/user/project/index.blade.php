<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Detail Project</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Scrollbar kustom gelap */
    ::-webkit-scrollbar{width:8px;height:8px}
    ::-webkit-scrollbar-track{background:#1A1E21}
    ::-webkit-scrollbar-thumb{background:#414548;border-radius:4px}
    ::-webkit-scrollbar-thumb:hover{background:#292d30}
  </style>
</head>
<body class="bg-[#1A1E21] text-[#FFFFFF] min-h-screen">

  <!-- Top Navigation -->
  <header class="sticky top-0 z-20 bg-[#1A1E21]/80 backdrop-blur border-b border-[#292d30]">
    <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
      <button class="text-[#e0e0e0] hover:text-[#2ECC71] transition">&larr; Back</button>
      <div class="flex items-center gap-3">
        <button class="px-3 py-1.5 rounded-lg text-sm bg-[#292d30] hover:bg-[#414548] transition">Edit</button>
        <button class="px-3 py-1.5 rounded-lg text-sm bg-[#004079] text-[#3498DB] hover:bg-[#3498DB] hover:text-white transition">Delete</button>
      </div>
    </div>
  </header>

  <main class="max-w-5xl mx-auto px-6 py-8 grid gap-8">

    <!-- Project Header -->
    <section class="bg-[#292d30] rounded-xl p-6 border border-[#414548]">
      <div class="flex items-start justify-between">
        <div>
          <h1 class="text-3xl font-bold text-[#2ECC71]">Project Alpha</h1>
          <p class="text-[#e0e0e0] mt-2 max-w-2xl">
            Pengembangan sistem manajemen inventaris berbasis web untuk meningkatkan efisiensi pergudangan.
          </p>
        </div>
        <span class="px-4 py-2 rounded-full text-sm font-medium
                     bg-[#006a18] text-[#2ECC71] border border-[#2ECC71]">
          On Progress
        </span>
      </div>

      <!-- Meta row -->
      <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
        <div>
          <h3 class="text-[#3498DB] text-xs uppercase tracking-wide">Start</h3>
          <p class="text-white mt-1">28 Sep 2025</p>
        </div>
        <div>
          <h3 class="text-[#3498DB] text-xs uppercase tracking-wide">Deadline</h3>
          <p class="text-white mt-1">15 Dec 2025</p>
        </div>
        <div>
          <h3 class="text-[#3498DB] text-xs uppercase tracking-wide">Priority</h3>
          <p class="text-white mt-1">High</p>
        </div>
        <div>
          <h3 class="text-[#3498DB] text-xs uppercase tracking-wide">Owner</h3>
          <p class="text-white mt-1">Tim DevOps</p>
        </div>
      </div>
    </section>


    <!-- Task List -->
    <section class="bg-[#292d30] rounded-xl p-6 border border-[#414548]">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-[#2ECC71]">Tasks</h2>
        <button class="px-3 py-1.5 rounded-lg text-sm bg-[#006a18] hover:bg-[#00ae56] transition">+ Add Task</button>
      </div>

      <ul class="space-y-3">
        <li class="flex items-center justify-between p-3 rounded-lg bg-[#1A1E21] border border-[#414548]">
          <div class="flex items-center gap-3">
            <input type="checkbox" class="w-4 h-4 rounded bg-[#292d30] border-[#414548] text-[#2ECC71] focus:ring-0"/>
            <span class="text-white">Setup repositori & CI/CD</span>
          </div>
          <span class="text-xs text-[#e0e0e0]">Selesai</span>
        </li>
        <li class="flex items-center justify-between p-3 rounded-lg bg-[#1A1E21] border border-[#414548]">
          <div class="flex items-center gap-3">
            <input type="checkbox" checked class="w-4 h-4 rounded bg-[#292d30] border-[#414548] text-[#2ECC71] focus:ring-0"/>
            <span class="text-[#e0e0e0] line-through">Membuat database schema</span>
          </div>
          <span class="text-xs text-[#e0e0e0]">Selesai</span>
        </li>
        <li class="flex items-center justify-between p-3 rounded-lg bg-[#1A1E21] border border-[#414548]">
          <div class="flex items-center gap-3">
            <input type="checkbox" class="w-4 h-4 rounded bg-[#292d30] border-[#414548] text-[#2ECC71] focus:ring-0"/>
            <span class="text-white">Implementasi API</span>
          </div>
          <span class="text-xs text-[#e0e0e0]">50%</span>
        </li>
      </ul>
    </section>

    <!-- Action Buttons -->
    <section class="flex flex-wrap gap-3">
      <button class="px-5 py-2 rounded-lg bg-[#00ae56] hover:bg-[#2ECC71] text-white font-medium transition">
        Mark as Complete
      </button>
      <button class="px-5 py-2 rounded-lg bg-[#292d30] hover:bg-[#414548] text-[#e0e0e0] font-medium transition border border-[#414548]">
        Archive Project
      </button>
    </section>

  </main>
</body>
</html>
