<?php

namespace App\Http\Controllers\Admin;

use App\Models\Step;
use App\Models\Nature;
use App\Models\Project;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\ProjectsExport;
use Yajra\DataTables\DataTables;
use App\Models\ProjectModification;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

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
        $years = $projects->pluck('start_year')->sort()->unique();
        return view('admin.projects.index', compact('projects', 'natures', 'years', 'steps'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted(Request $request)
    {
        return view('admin.projects.deleted.index');
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
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('admin.projects.pdf.show', compact('project'));
        $fileName = 'projet_' . $project->reference . '_' . today()->format('d-m-Y') . '.pdf';
        return $pdf->stream($fileName);
    }

    public function ajaxList(Request $request)
    {
        $query = $this->projectQuery($request);

        $projects = $query->get();
        $projects->load(['writer']);

        $projects->each(function ($project) {
            $project->displayedNatures = implode(", ", $project->natures->pluck('name')->toArray());
        });

        return Datatables::of($projects)
            ->addIndexColumn()
            ->addColumn('action', function ($project) {
                $actionBtns = "<a href=" . route('admin.projects.show', $project->id) . " class='btn btn-sm btn-primary' title='Détails'><i class='bi bi-eye'></i></a> ";
                $actionBtns .= "<a target='_blank' href=" . route('projects.pdf', $project->reference) . " class='btn btn-sm btn-secondary' title='Imprimer'><i class='bi bi-printer'></i></a> ";
                $actionBtns .= "<a href=" . route('admin.projects.edit', $project->id) . " class='btn btn-sm btn-warning' title='Editer'><i class='bi bi-pencil'></i></a> ";
                $actionBtns .= "<button class='btn btn-sm btn-danger' onclick='showDeleteProjectModal(" . $project->id . ")' title='Supprimer'><i class='bi bi-trash'></i></button>";
                return $actionBtns;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function ajaxDeletedList(Request $request)
    {
        $projects = Project::onlyTrashed()->with(['natures', 'deleter'])->get();
        $user = auth()->user();


        return Datatables::of($projects)
            ->addIndexColumn()
            ->addColumn('action', function ($project) use ($user) {
                $actionBtns = "<a href=" . route('admin.projects.deleted.show', $project->id) . " class='btn btn-sm btn-primary' title='Détails'><i class='bi bi-eye'></i></a> ";
                if ($user->isAbleTo('restore-project')) {
                    $actionBtns .= "<button class='btn btn-sm btn-info' onclick='restoreProject(" . $project->id . ")' title='Restaurer'><i class='bi bi-cloud-upload'></i></button> ";
                    $actionBtns .= "<button class='btn btn-sm btn-danger' onclick='showDeleteProjectModal(" . $project->id . ")' title='Supprimer'><i class='bi bi-trash'></i></button>";
                }
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
        $projects->load(['natures', 'modifications' => function ($query) {
            $query->latest()->first();
        }]);
        $projects->each(function ($project, $index) {
            $project->index = $index + 1;
        });
        $fileName = 'liste_des_projects_' . today()->format('d-m-Y') . '.xlsx';
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
            'name'        => $request->name,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'sponsor'     => $request->sponsor,
            'initiative'  => $request->initiative,
            'amoa'        => $request->amoa,
            'progress'    => $request->progress,
            'manager'     => $request->manager,
            'status'      => $request->status,
            'benefits'    => $request->benefits,
            'saved_by'    => auth()->user()->id,
        ]);

        if ($request->end_date) {
            $project->end_date = $request->end_date;
        }

        if ($request->cost) {
            $project->cost = $request->cost;
        }

        if ($request->steps) {
            $project->steps()->attach($request->steps);
        }

        if ($request->moe) {
            $project->moe = $request->moe;
        }
        if ($request->documentation) {
            $project->documentation = $request->documentation;
        }
        if ($request->bills) {
            $project->bills = $request->bills;
        }
        $project->reference = castNumberId($project->id) . '-' . Str::upper(Str::random(2)) . '-' . $project->start_year;
        $project->save();
        $project->natures()->attach($request->natures);


        return redirect()->route('admin.projects.index')->with('message', 'Projet créé avec succès!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project->load(['modifications' => function ($query) {
            $query->latest();
        }]);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function showDeleted($id)
    {
        $project = Project::onlyTrashed()
            ->firstWhere('id', $id);
        return view('admin.projects.deleted.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $natures = Nature::all();
        $steps = Step::all();
        return view('admin.projects.edit', compact('project', 'natures', 'steps'));
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
            'sponsor'       => $request->sponsor,
            'initiative'    => $request->initiative,
            'amoa'          => $request->amoa,
            'manager'       => $request->manager,
            'status'        => $request->status,
            'benefits'      => $request->benefits
        ]);

        if ($request->end_date) {
            $project->end_date = $request->end_date;
        }

        if ($request->cost) {
            $project->cost = $request->cost;
        }

        if ($request->steps) {
            $project->steps()->attach($request->steps);
        }

        if ($request->documentation) {
            $project->documentation = $request->documentation;
        }
        if ($request->moe) {
            $project->moe = $request->moe;
        }
        if ($request->bills) {
            $project->bills = $request->bills;
        }
        if ($request->progress) {
            $project->progress = $request->progress;
        }
        $project->save();
        ProjectModification::create([
            'user_id' => auth()->user()->id,
            'project_id' => $project->id,
        ]);
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
        $project->deleted_by = auth()->user()->id;
        $project->save();
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
        $project = Project::onlyTrashed()
            ->firstWhere('id', $id);
        if ($project) {
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
        Project::onlyTrashed()
            ->findOrFail($id)->restore();

        return response()->json(['message' => 'Project restored!']);
    }

    public function projectQuery($request)
    {
        $query = Project::query();
        $search = "%" . $request->search . "%";
        if ($request->search_type == "all" && !empty($request->search)) {
            $query->where('amoa', 'LIKE', $search);
            $query->orWhere('sponsor', 'LIKE', $search);
            $query->orWhere('reference', 'LIKE', $search);
            $query->orWhere('status', 'LIKE', $search);
            $query->orWhere('name', 'LIKE', $search);
            $query->orWhere(function ($query) use ($request) {
                $query->WhereYear('start_date', $request->search);
            });
            $query->orWhere(function ($query) use ($search) {
                $query->whereHas('natures', function ($query) use ($search) {
                    $query->where('name', 'LIKE', $search);
                });
            });
        }
        if ($request->search_type == "amoa" && !empty($request->search)) {
            $query->where('amoa', 'LIKE', $search);
        }
        if ($request->search_type == "sponsor" && !empty($request->search)) {
            $query->where('sponsor', 'LIKE', $search);
        }
        if ($request->search_type == "reference" && !empty($request->search)) {
            $query->where('reference', 'LIKE', $search);
        }
        if ($request->search_type == "status" && !empty($request->search)) {
            $query->where('status', $request->search);
        }
        if ($request->search_type == "year" && !empty($request->search)) {
            $query->whereYear('start_date', $request->search);
        }
        if ($request->search_type == "natures") {
            //get array of ids
            $natures = json_decode($request->search);
            if (!empty($natures)) {
                $query->whereHas('natures', function ($query) use ($natures) {
                    $query->whereIn('natures.id', $natures);
                });
            }
        }
        return $query;
    }
}
