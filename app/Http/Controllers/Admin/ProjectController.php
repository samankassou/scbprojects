<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nature;
use App\Models\Project;
use App\Models\Step;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query = Project::query();
            if($request->amoa && ($request->amoa != '')){
                $query->where('amoa', 'LIKE', '%'.$request->amoa.'%');
            }
            if($request->sponsor && ($request->sponsor != '')){
                $query->where('sponsor', 'LIKE', '%'.$request->sponsor.'%');
            }
            if($request->reference && ($request->reference != '')){
                $query->where('reference', 'LIKE', '%'.$request->reference.'%');
            }
            if($request->statut && ($request->statut != '')){
                $query->where('statut', $request->statut);
            }
            if($request->year && ($request->year != '')){
                $query->whereYear('start_date', $request->year);
            }
            if($request->nature && ($request->nature != '')){
                $natures = $request->nature;
                $query->whereHas('natures', function(Builder $q) use($natures){
                    $q->whereIn('id', [$natures]);
                });
            }
            $projects = $query->get();
        }
        $projects = Project::all();
        $natures = Nature::all();
        $years = Arr::sort($projects->pluck('start_year'));
        return view('admin.projects.index', compact('projects', 'natures', 'years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $natures = Nature::all();
        $steps = Step::all();
        return view('admin.projects.create', compact('natures', 'steps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
