<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totals['processes'] = Process::count();
        $totals['projects'] = Project::count();
        return view('dashboard', compact('totals'));
    }
}
