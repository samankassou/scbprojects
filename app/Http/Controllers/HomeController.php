<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Process;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totals['processes'] = Process::count();
        $totals['projects'] = Project::count();
        $totals['active_projects'] = Project::where('status', 'en cours')->count();
        $totals['finished_projects'] = Project::where('status', 'terminé')->count();
        $totals['deleted_projects'] = Project::onlyTrashed()->count();
        $totals['deleted_processes'] = Process::onlyTrashed()->count();
        $totals['users'] = User::count();
        return view('dashboard', compact('totals'));
    }
}
