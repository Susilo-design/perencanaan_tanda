@extends('layout.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h1 class="text-3xl font-bold text-white mb-6">Jadwal Saya</h1>

        <div class="bg-gray-800 p-4 rounded-lg">
            <div id="calendar"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: {!! json_encode($allSchedules->map(function ($schedule) {
            return [
                'id' => $schedule->id,
                'title' => $schedule->title . ' (' . $schedule->project->title . ')',
                'start' => $schedule->start_time->toIso8601String(),
                'end' => $schedule->end_time->toIso8601String(),
                'color' => $schedule->color,
                'extendedProps' => [
                    'description' => $schedule->description,
                    'priority' => $schedule->priority,
                    'project' => $schedule->project->title,
                ],
            ];
        })->toArray()) !!},
        eventClick: function(info) {
            alert('Event: ' + info.event.title + '\n' +
                  'Project: ' + info.event.extendedProps.project + '\n' +
                  'Description: ' + (info.event.extendedProps.description || 'N/A') + '\n' +
                  'Priority: ' + info.event.extendedProps.priority);
        }
    });
    calendar.render();
});
</script>
@endpush
