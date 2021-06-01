<?php

namespace App\Http\Controllers\Admin;

use App\Models\Step;
use App\Models\Nature;
use App\Models\Project;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Yajra\DataTables\DataTables;

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
            if($request->all && ($request->all != ''))
            {
                $word = '%'.$request->all.'%';
                $query->where('amoa', 'LIKE', $word);
                $query->orWhere('sponsor', 'LIKE', $word);
                $query->orWhere('reference', 'LIKE', $word);
                $query->orWhere('status', 'LIKE', $word);
                $query->orWhere('name', 'LIKE', $word);

            }else{
                if($request->amoa && ($request->amoa != '')){
                    $query->where('amoa', 'LIKE', '%'.$request->amoa.'%');
                }
                if($request->sponsor && ($request->sponsor != '')){
                    $query->where('sponsor', 'LIKE', '%'.$request->sponsor.'%');
                }
                if($request->reference && ($request->reference != '')){
                    $query->where('reference', 'LIKE', '%'.$request->reference.'%');
                }
                if($request->status && ($request->status != '')){
                    $query->where('status', $request->status);
                }
                if($request->year && ($request->year != '')){
                    $query->whereYear('start_date', $request->year);
                }
                if($request->natures && (count($request->natures) != 0)){
                    $natures = $request->natures;
                    $query->whereHas('natures', function(Builder $q) use($natures){
                        $q->whereIn('id', $natures);
                    });
                }
            }
            $projects = $query->get();

            return Datatables::of($projects)
                ->addIndexColumn()
                ->addColumn('action', function($project){
                    $actionBtns = "<button class='btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#edit-classroom-modal' onclick='showEditClassroomModal(".$project->id.")'><i class='bi bi-pencil'></i></button>";
                    $actionBtns .= "<button class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#delete-project-modal' onclick='showDeleteprojectModal(".$project->id.")'><i class='bi bi-trash'></i></button>";
                    return $actionBtns;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $projects = Project::all();
        $natures = Nature::all();
        $steps = Step::all();
        $years = array_unique(Arr::sort($projects->pluck('start_year')));
        return view('admin.projects.index', compact('projects', 'natures', 'years', 'steps'));
    }

    public function showByRef(Request $request)
    {
        $project = Project::firstWhere('reference', $request->reference);
        abort_if(!$project, 404, 'Reférence incorrecte ou projet inexistant');
        return view('admin.projects.show_by_ref', compact('project'));
    }

    public function search(Request $request)
    {
        $project = Project::firstWhere('reference', $request->reference);
        $success = $project ? true : false;
        return response()->json([
            'success' => $success,
            'project' => $project
            ]);
    }

    public function ajaxList(Request $request)
    {
        $query = Project::query();
        if($request->all && ($request->all != ''))
        {
            $word = '%'.$request->all.'%';
            $query->where('amoa', 'LIKE', $word);
            $query->orWhere('sponsor', 'LIKE', $word);
            $query->orWhere('reference', 'LIKE', $word);
            $query->orWhere('status', 'LIKE', $word);
            $query->orWhere('name', 'LIKE', $word);

        }else{
            if($request->amoa && ($request->amoa != '')){
                $query->where('amoa', 'LIKE', '%'.$request->amoa.'%');
            }
            if($request->sponsor && ($request->sponsor != '')){
                $query->where('sponsor', 'LIKE', '%'.$request->sponsor.'%');
            }
            if($request->reference && ($request->reference != '')){
                $query->where('reference', 'LIKE', '%'.$request->reference.'%');
            }
            if($request->status && ($request->status != '')){
                $query->where('status', $request->status);
            }
            if($request->year && ($request->year != '')){
                $query->whereYear('start_date', $request->year);
            }
            if($request->natures && (count($request->natures) != 0)){
                $natures = $request->natures;
                $query->whereHas('natures', function(Builder $q) use($natures){
                    $q->whereIn('id', $natures);
                });
            }
        }
        //$projects = $query->get();
        $projects = Project::with(['natures'])->get();

        return Datatables::of($projects)
            ->addIndexColumn()
            ->addColumn('action', function($project){
                $actionBtns = "<a href=".route('admin.projects.show', $project->id)." class='btn btn-sm btn-primary'><i class='bi bi-eye'></i></a> ";
                $actionBtns .= "<a href=".route('admin.projects.edit', $project->id)." class='btn btn-sm btn-warning'><i class='bi bi-pencil'></i></a> ";
                $actionBtns .= "<button class='btn btn-sm btn-danger' onclick='showDeleteProjectModal(".$project->id.")'><i class='bi bi-trash'></i></button>";
                return $actionBtns;
            })
            ->rawColumns(['action'])
            ->make(true);
        
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
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'sponsor'       => $request->sponsor,
            'initiative'    => $request->initiative,
            'amoa'          => $request->amoa,
            'moe'           => $request->moe,
            'progress'      => $request->progress,
            'manager'       => $request->manager,
            'cost'          => $request->cost,
            'status'        => $request->status,
            'benefits'      => $request->benefits
        ]);
        if($request->documentation){
            $project->documentation = $request->documentation;
        }
        if($request->bills){
            $project->bills = $request->bills;
        }
        $project->reference = Str::upper(Str::random(3)).'-'.$project->start_year.'-'.$project->id;
        $project->save();
        $project->natures()->attach($request->natures);
       
        $project->steps()->attach($request->steps);
        
        
        return redirect()->route('admin.projects.index')->with('message', 'Projet crée avec succès!');
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
        $projects = Project::all();
        $natures = Nature::all();
        $years = array_unique(Arr::sort($projects->pluck('start_year')));
        return view('admin.projects.edit', compact('project', 'natures', 'years'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'sponsor'       => $request->sponsor,
            'initiative'    => $request->initiative,
            'amoa'          => $request->amoa,
            'moe'           => $request->moe,
            'manager'       => $request->manager,
            'cost'          => $request->cost,
            'status'        => $request->status,
            'benefits'      => $request->benefits
        ]);
        if($request->documentation){
            $project->documentation = $request->documentation;
        }
        if($request->bills){
            $project->bills = $request->bills;
        }
        if($request->progress){
            $project->progress = $request->progress;
        }
        $project->save();
        $project->natures()->sync($request->natures);
        return redirect()->route('admin.projects.index')->with('message', 'Projet modifié avec succès!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->natures()->detach();
        $project->steps()->detach();
        $project->delete();

        return response()->json(['message' => 'Project deleted!']);
    }
}
