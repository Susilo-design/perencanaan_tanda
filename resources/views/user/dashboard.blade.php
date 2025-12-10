@extends('layout.app')

@section('content')
    <main class="max-w-7xl mx-auto px-4 py-8">
        @if (Session::get('success'))
            <div class="alert alert-success w-100">
                {{ Session::get('success') }}
                <b>Selamat datang, {{ Auth::user()->name }}</b>
            </div>
        @endif
        <div class="flex justify-between items-center">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Halo, <span
                        class="text-[#2ECC71]">{{ Auth::user()->name }}!</span></h1>
                <p class="text-gray-400">Berikut project & jadwal kamu hari ini</p>
            </div>
            <div class="flex gap-3">
                <a class="group relative inline-block text-sm font-medium text-black focus:ring-3 focus:outline-hidden"
                    href="{{ route('user.project.create') }}">
                    <span
                        class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-white transition-transform group-hover:translate-x-0 group-hover:translate-y-0"></span>

                    <span class="relative block border border-current bg-green-800 px-8 text-white py-3"> Create Project
                    </span>
                </a>
                <a href="{{ route('user.joinForm') }}"
                    class="group relative inline-block text-sm font-medium text-black focus:ring-3 focus:outline-hidden">
                    <span
                        class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-white  transition-transform group-hover:translate-x-0 group-hover:translate-y-0"></span>
                    <span class="relative block border border-current  bg-green-800 text-white px-8 py-3"> Join Project
                    </span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">

            <div class="grid grid-cols-1 gap-y-6 ">
                <div class="bg-[#292d30] p-5 rounded-xl border border-[#414548] hover:border-[#3498DB] transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Tasks</p>

                            <p class="text-2xl font-bold text-white mt-1">
                                {{ $projects->sum(function ($project) {return $project->tasks->count();}) }}</p>
                        </div>
                        <div class="w-10 h-10 bg-[#3498DB]/20 rounded-lg grid place-items-center">
                            <svg class="w-5 h-5 text-[#3498DB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>



                <!-- Card 4 -->
                <div class="bg-[#292d30] p-5 rounded-xl border border-[#414548] hover:border-[#006a18] transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Project</p>
                            <p class="text-2xl font-bold text-white mt-1">{{ $projects->count() }}</p>
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

            <div class="">
                <div class="bg-[#292d30] p-6 rounded-xl border border-[#414548]">
                    <h3 class="text-white text-sm font-medium mb-3">Tasks by Status</h3>
                    <div class="w-48 mx-auto h-48">
                        <canvas id="tasksByStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($projects as $project)
                <div class="max-w-sm mx-auto mt-10">
                    <div class="rounded-xl shadow-2xl overflow-hidden bg-[#1A1E21] text-[#FFFFFF] border border-[#292d30]">

                        <!-- Header Section -->
                        <div class="px-6 pt-5 pb-4 bg-[#292d30] border-b border-[#414548]">
                            <h1 class="text-xl font-bold text-[#2ECC71]">{{ $project->title }}</h1>
                            <p class="text-sm text-[#e0e0e0] mt-2">
                                {{ Str::limit($project->description, 100) }}
                            </p>
                        </div>

                        <!-- Content Section -->
                        <div class="px-6 pb-6 pt-5 space-y-4">
                            <!-- Dates Row -->
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <h3 class="text-[#3498DB] font-semibold text-xs uppercase tracking-wide">Start Date
                                    </h3>
                                    <p class="text-[#FFFFFF] mt-1 font-medium">{{ $project->start_date }}</p>
                                </div>
                                <div>
                                    <h3 class="text-[#3498DB] font-semibold text-xs uppercase tracking-wide">End Date
                                    </h3>
                                    <p class="text-[#FFFFFF] mt-1 font-medium">{{ $project->end_date }}</p>
                                </div>
                            </div>

                            <div class="border-t border-[#414548] my-3">
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-sm">

                                <div>
                                    <h3 class="text-[#3498DB] font-semibold text-xs uppercase tracking-wide">Status</h3>
                                    @php
                                        $statusLabel = $project->status === 'completed' ? 'Completed' : 'On Progress';
                                        $statusClass =
                                            $project->status === 'completed'
                                                ? 'bg-[#006a18] text-[#2ECC71] border-[#2ECC71]'
                                                : 'bg-[#7D6608] text-[#F7DC6F] border-[#F7DC6F]';
                                    @endphp
                                    <span
                                        class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }} border">
                                        {{ $statusLabel }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-[#292d30] border-t border-[#414548]">
                            <a href="{{ route('user.project.show', $project->id) }}"
                                class="w-full py-2 px-4 rounded-lg text-sm font-medium bg-[#00ae56] hover:bg-[#2ECC71] text-white transition-colors duration-200">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </main>

    @push('scripts')
        <script>
            let statusLabels = null;
            let statusData = null;

            $(function() {
                $.ajax({
                    url: "{{ route('user.tasks.chart') }}",
                    method: "GET",
                    success: function(response) {

                        statusLabels = response.labels;
                        statusData = response.data;
                        chartTasksStatus();
                    },
                    error: function() {
                        alert('Gagal mengambil data chart tasks!');
                    }
                });
            });

            const ctxTasks = document.getElementById('tasksByStatusChart');

            function chartTasksStatus() {
                new Chart(ctxTasks, {
                    type: 'doughnut',
                    data: {
                        labels: statusLabels,
                        datasets: [{
                            data: statusData,
                            backgroundColor: ['#F59E0B', '#60A5FA', '#34D399'],
                            borderColor: ['#FFF', '#FFF', '#FFF'],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
        </script>
    @endpush
@endsection
