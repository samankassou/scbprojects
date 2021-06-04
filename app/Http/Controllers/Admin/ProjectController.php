<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProjectsExport;
use App\Models\Step;
use App\Models\Nature;
use App\Models\Project;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
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
        $projects = Project::all();
        $natures = Nature::all();
        $steps = Step::all();
        $years = array_unique(Arr::sort($projects->pluck('start_year')));
        return view('admin.projects.index', compact('projects', 'natures', 'years', 'steps'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted(Request $request)
    {
        $projects = Project::all();
        $natures = Nature::all();
        $steps = Step::all();
        $years = array_unique(Arr::sort($projects->pluck('start_year')));
        return view('admin.projects.deleted.index', compact('projects', 'natures', 'years', 'steps'));
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

    public function exportPdf(Request $request)
    {
        $project = Project::firstWhere('reference', $request->reference);
        abort_if(!$project, 404, 'Reférence incorrecte ou projet inexistant');
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('admin.projects.pdf.show', compact('project'));
        $fileName = 'projet_'.$project->reference.'_'.today()->format('d-m-Y').'.pdf';
        return $pdf->stream($fileName);

    }

    public function ajaxList(Request $request)
    {
        $query = $this->projectQuery($request);

        $projects = $query->get();
        $projects->each(function($project){
            $project->natures = $project->natures;
        });

        return Datatables::of($projects)
            ->addIndexColumn()
            ->addColumn('action', function($project){
                $actionBtns = "<a href=".route('admin.projects.show', $project->id)." class='btn btn-sm btn-primary' title='Détails'><i class='bi bi-eye'></i></a> ";
                $actionBtns .= "<a href=".route('projects.pdf', $project->reference)." class='btn btn-sm btn-secondary' title='Imprimer'><i class='bi bi-printer'></i></a> ";
                $actionBtns .= "<a href=".route('admin.projects.edit', $project->id)." class='btn btn-sm btn-warning' title='Editer'><i class='bi bi-pencil'></i></a> ";
                $actionBtns .= "<button class='btn btn-sm btn-danger' onclick='showDeleteProjectModal(".$project->id.")' title='Supprimer'><i class='bi bi-trash'></i></button>";
                return $actionBtns;
            })
            ->rawColumns(['action'])
            ->make(true);
        
    }

    public function ajaxDeletedList(Request $request)
    {
        // $query = $this->projectQuery($request);

        // $projects = $query->get();
        // $projects->each(function($project){
        //     $project->natures = $project->natures;
        // });
        $projects = Project::onlyTrashed()->with(['natures'])->get();
        

        return Datatables::of($projects)
            ->addIndexColumn()
            ->addColumn('action', function($project){
                $actionBtns = "<a href=".route('admin.projects.show', $project->id)." class='btn btn-sm btn-primary' title='Détails'><i class='bi bi-eye'></i></a> ";
                $actionBtns .= "<button class='btn btn-sm btn-secondary' onclick='restoreProject(".$project->id.")' title='Restaurer'><i class='bi bi-cloud-upload'></i></button> ";
                $actionBtns .= "<button class='btn btn-sm btn-danger' onclick='showDeleteProjectModal(".$project->id.")' title='Supprimer'><i class='bi bi-trash'></i></button>";
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
    public function export(Request $request)
    {
        $projects = $this->projectQuery($request)->get();
        $fileName = 'liste_des_projects_'.today()->format('d-m-Y').'.xlsx';
        return Excel::download(new ProjectsExport($projects), $fileName);
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
        //$project->natures()->detach();
        //$project->steps()->detach();
        $project->delete();

        return response()->json(['message' => 'Project deleted!']);
    }

    /**
     * Delete definitly the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $project = Project::withTrashed()
        ->firstWhere('id', $id);
        if($project){
            $project->natures()->detach();
            $project->steps()->detach();
            $project->forceDelete();
        }

        return response()->json(['message' => 'Project deleted!']);
    }


    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $project = Project::withTrashed()
        ->firstWhere('id', $id);
        if($project){
            $project->restore();
        }

        return response()->json(['message' => 'Project restored!']);
    }

    public function projectQuery($request)
    {
        $query = Project::query();
        $search = "%".$request->search."%";
        if($request->search_type == "all" && !empty($request->search))
        {
            $query->where('amoa', 'LIKE', $search);
            $query->orWhere('sponsor', 'LIKE', $search);
            $query->orWhere('reference', 'LIKE', $search);
            $query->orWhere('status', 'LIKE', $search);
            $query->orWhere('name', 'LIKE', $search);
            $query->orWhere(function($query) use($request){
                $query->WhereYear('start_date', $request->search);
            });
            $query->orWhere(function($query) use($search){
                $query->whereHas('natures', function($query) use($search){
                    $query->where('name', 'LIKE', $search);
                });
            });

        }
        if($request->search_type == "amoa" && !empty($request->search)){
            $query->where('amoa', 'LIKE', $search);
        }
        if($request->search_type == "sponsor" && !empty($request->search)){
            $query->where('sponsor', 'LIKE', $search);
        }
        if($request->search_type == "reference" && !empty($request->search)){
            $query->where('reference', 'LIKE', $search);
        }
        if($request->search_type == "status" && !empty($request->search)){
            $query->where('status', $request->search);
        }
        if($request->search_type == "year" && !empty($request->search)){
            $query->whereYear('start_date', $request->search);
        }
        if($request->search_type == "natures"){
            //get array of ids
            $natures = json_decode($request->search);
            if(!empty($natures)){
                //foreach($natures as $nature){
                    $query->whereHas('natures', function($query) use($natures){
                        $query->whereIn('natures.id', $natures);
                    }, '=');
                //}
                // $query = DB::table('projects')
                // ->where('natures.id', 1)
                // ->leftJoin('nature_project', 'projects.id', '=', 'nature_project.project_id')
                // ->leftJoin('natures', 'natures.id', '=', 'nature_project.nature_id')
                // ->select('projects.*', 'natures.*');


            }
        }
        return $query;
    }
}


