<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function userSchedules()
    {
        // Ambil semua project yang dimiliki atau diikuti user
        $user = auth()->user();
        $projects = $user->projects()->with('schedules')->get();
        $joinedProjects = $user->joinedProjects()->with('schedules')->get();

        // Gabungkan semua schedules dari project-project tersebut
        $allSchedules = collect();
        $projects->each(function ($project) use (&$allSchedules) {
            $project->schedules->each(function ($schedule) use (&$allSchedules, $project) {
                $schedule->project = $project;
                $allSchedules->push($schedule);
            });
        });
        $joinedProjects->each(function ($project) use (&$allSchedules) {
            $project->schedules->each(function ($schedule) use (&$allSchedules, $project) {
                $schedule->project = $project;
                $allSchedules->push($schedule);
            });
        });

        return view('user.schedules.index', compact('allSchedules', 'projects', 'joinedProjects'));
    }
}
