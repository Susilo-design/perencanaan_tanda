<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $project->title }} - Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 100%;
            margin: auto;
        }

        .header {
            background: #2ECC71;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 22px;
            margin: 0;
            font-weight: bold;
        }

        .subtitle {
            margin-top: 5px;
            font-size: 12px;
        }

        .task-section {
            margin-top: 25px;
        }

        .task-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
            border-left: 5px solid #2ECC71;
            padding-left: 10px;
        }

        .task-card {
            background: white;
            border: 1px solid #e1e5ea;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .task-card h4 {
            margin: 0 0 5px 0;
            font-size: 16px;
        }

        .task-info {
            font-size: 12px;
            margin-top: 5px;
        }

        .status {
            display: inline-block;
            padding: 3px 7px;
            border-radius: 3px;
            font-size: 11px;
            color: white;
        }

        .done {
            background: #27ae60;
        }

        .progress {
            background: #f1c40f;
            color: black;
        }

        .todo {
            background: #e74c3c;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <h1>{{ $project->title }}</h1>
            <div class="subtitle">Project Report - Generated on {{ now()->format('d F Y') }}</div>
        </div>

        <div class="task-section">
            <div class="task-title">Project Description</div>
            <div class="task-card">
                <p>{{ $project->description ?? 'No description available.' }}</p>
            </div>
        </div>

        <div class="task-section">
            <div class="task-title">Task List</div>

            @forelse ($project->tasks as $task)
                <div class="task-card">
                    <h4>{{ $task->title }}</h4>
                    <div class="task-info">
                        <strong>Status:</strong>
                        @if ($task->status === 'done')
                            <span class="status done">Done</span>
                        @elseif ($task->status === 'in_progress')
                            <span class="status progress">In Progress</span>
                        @else
                            <span class="status todo">To Do</span>
                        @endif
                    </div>

                    <div class="task-info">
                        <strong>Deadline:</strong>
                        {{ $task->due_date ?? null ? $task->due_date->format('F j, Y') : '-' }}
                    </div>

                    <div class="task-info" style="margin-top:6px;">
                        <strong>Description:</strong>
                        <p style="margin:4px 0 0 0;">{{ $task->description ?? '-' }}</p>
                    </div>
                </div>
            @empty
                <p>No tasks available.</p>
            @endforelse
        </div>
        <div class="section">
            <div class="section-title">Team Members: </div>
            <div class="members-list">
                @forelse ($users as $user)
                    @php
                        $role = $user->pivot->role_in_project ?? 'member';
                        $isHost = $role === 'host';
                    @endphp <div class="member-badge {{ $isHost ? 'host' : '' }}"> {{ $user->name }}
                    {{ $isHost ? '(Host)' : '' }} </div> @empty <div class="no-data">No team members</div>
                @endforelse
            </div>
        </div>
    </div>
</body>

</html>
