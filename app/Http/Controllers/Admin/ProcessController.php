<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pole;
use App\Models\Domain;
use App\Models\Entity;
use App\Models\Method;
use App\Models\Process;
use App\Models\Macroprocess;
use Illuminate\Http\Request;
use App\Exports\ProcessesExport;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreProcessRequest;
use App\Http\Requests\UpdateProcessRequest;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = Process::all();
        $poles = Pole::all();
        $macroprocesses = Macroprocess::all();
        $methods = Method::all();
        return view('admin.processes.index', compact('processes', 'poles', 'macroprocesses', 'methods'));
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted(Request $request)
    {
        $processes = Process::onlyTrashed()->get();
        return view('admin.processes.deleted.index', compact('processes'));
    }

    public function ajaxDeletedList(Request $request)
    {
        $processes = Process::onlyTrashed()->with(['method.macroprocess', 'deleter'])->get();
        $user = auth()->user();

        return Datatables::of($processes)
            ->addIndexColumn()
            ->addColumn('action', function($process) use($user){
                $actionBtns = "<a href=".route('admin.processes.deleted.show', $process->id)." class='btn btn-sm btn-primary' title='Détails'><i class='bi bi-eye'></i></a> ";
                if($user->isAbleTo('restore-process')){
                    $actionBtns .= "<button class='btn btn-sm btn-info' onclick='restoreProcess(".$process->id.")' title='Restaurer'><i class='bi bi-cloud-upload'></i></button> ";
                    $actionBtns .= "<button class='btn btn-sm btn-danger' onclick='showDeleteProcessModal(".$process->id.")' title='Supprimer'><i class='bi bi-trash'></i></button>";
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
    public function create()
    {
        $domains = Domain::all();
        $entities = Entity::all();
        return view('admin.processes.create', compact('domains', 'entities'));
    }

    public function export(Request $request)
    {
        $processes = $this->processQuery($request)->get();
        // $processes->load(['natures', 'modifications' => function($query){
        //     $query->latest()->first();
        // }]);
        $processes->load(['method.macroprocess']);
        $processes->each(function($process, $index){
            $process->index = $index + 1;
        });
        $fileName = 'liste_des_procedures_'.today()->format('d-m-Y').'.xlsx';
        return Excel::download(new ProcessesExport($processes), $fileName);
    }

    /**
     * list Macroprocesses related to a domain.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMacroprocesses(Request $request)
    {
        $macroprocesses = Macroprocess::where('domain_id', $request->id)->get();
        return response()->json(['macroprocesses' => $macroprocesses]);
    }

    /**
     * list Methods related to a Macroprocess.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMethods(Request $request)
    {
        $methods = Method::where('macroprocess_id', $request->id)->get();
        return response()->json(['methods' => $methods]);
    }


    public function showByRef(Request $request)
    {
        $process = Process::firstWhere('reference', $request->reference);
        abort_if(!$process, 404, 'Reférence incorrecte ou process inexistant');
        return view('admin.processes.show_by_ref', compact('process'));
    }

    public function ajaxList(Request $request)
    {
        $query = $this->processQuery($request);

        $processes = $query->get();
        $processes->load(['entities.pole', 'method.macroprocess']);

        return Datatables::of($processes)
            ->addIndexColumn()
            ->addColumn('action', function($process){
                $actionBtns = "<a href=".route('admin.processes.show', $process->id)." class='btn btn-sm btn-primary' title='Détails'><i class='bi bi-eye'></i></a> ";
                $actionBtns .= "<a href=".route('processes.pdf', $process->reference)." class='btn btn-sm btn-secondary' title='Imprimer'><i class='bi bi-printer'></i></a> ";
                $actionBtns .= "<a href=".route('admin.processes.edit', $process->id)." class='btn btn-sm btn-warning' title='Editer'><i class='bi bi-pencil'></i></a> ";
                $actionBtns .= "<button class='btn btn-sm btn-danger' onclick='showDeleteProcessModal(".$process->id.")' title='Supprimer'><i class='bi bi-trash'></i></button>";
                return $actionBtns;
            })
            ->rawColumns(['action'])
            ->make(true);
        
    }

    public function search(Request $request)
    {
        $process = Process::firstWhere('reference', $request->reference);
        $success = $process ? true : false;
        return response()->json([
            'success' => $success,
            'process' => $process
            ]);
    }

    public function exportPdf(Request $request)
    {
        $process = Process::firstWhere('reference', $request->reference);
        abort_if(!$process, 404, 'Reférence incorrecte ou procédure inexistante');
        $polesIds = $process->entities->pluck('pole_id')->unique();
        $poles = Pole::whereIn('id', $polesIds)->get();
        $pdf = App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('admin.processes.pdf.show', compact('process', 'poles'));
        $fileName = 'process_'.$process->reference.'_'.today()->format('d-m-Y').'.pdf';
        return $pdf->stream($fileName);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcessRequest $request)
    {
        $process                = new Process;
        $process->name          = $request->name;
        $process->reference     = $request->reference;
        $process->type          = $request->type;
        $process->version       = $request->version;
        $process->creation_date = $request->creation_date;
        $process->created_by    = $request->created_by;
        $process->state         = $request->state;
        $process->status        = $request->status;
        $process->method_id     = $request->method;

        if($request->writing_date){
            $process->writing_date = $request->writing_date;
            $process->written_by   = $request->written_by;
        }

        if($request->verification_date){
            $process->verification_date = $request->verification_date;
            $process->verified_by         = $request->verified_by;
        }

        if($request->date_of_approval){
            $process->date_of_approval = $request->date_of_approval;
            $process->approved_by      = $request->approved_by;
        }

        if($request->broadcasting_date){
            $process->broadcasting_date = $request->broadcasting_date;
        }

        if($request->reasons_for_creation){
            $process->reasons_for_creation = $request->reasons_for_creation;
        }

        if($request->reasons_for_modification){
            $process->reasons_for_modification = $request->reasons_for_modification;
        }

        if($request->modifications){
            $process->modifications = $request->modifications;
        }

        if($request->appendices){
            $process->appendices = $request->appendices;
        }

        $process->save();
        $process->entities()->attach($request->entities);

        return redirect()->route('admin.processes.index')->with('message', 'Procédure créée avec succès!');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Process $process)
    {
        if($request->ajax()){
            return response()->json(['process' => $process]);
        }
        $process->load(['entities.pole']);
        $polesIds = $process->entities->pluck('pole_id')->unique();
        $poles = Pole::whereIn('id', $polesIds)->get();
        return view('admin.processes.show', compact('process', 'poles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function edit(Process $process)
    {
        $process->load(['method.macroprocess']);
        $domains = Domain::all();
        $entities = Entity::all();
        return view('admin.processes.edit', compact('process', 'domains', 'entities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcessRequest $request, Process $process)
    {
        $process->update([
            "method_id"     => $request->method,
            "name"          => $request->name,
            "type"          => $request->type,
            "reference"     => $request->reference,
            "version"       => $request->version,
            "creation_date" => $request->creation_date,
            "created_by"    => $request->created_by,
            "state"         => $request->state,
            "status"        => $request->status,
            "modifications" => $request->modifications,
        ]);
        if($request->writing_date){
            $process->writing_date = $request->writing_date;
            $process->written_by   = $request->written_by;
        }

        if($request->verification_date){
            $process->verification_date = $request->verification_date;
            $process->verified_by         = $request->verified_by;
        }

        if($request->date_of_approval){
            $process->date_of_approval = $request->date_of_approval;
            $process->approved_by      = $request->approved_by;
        }

        if($request->broadcasting_date){
            $process->broadcasting_date = $request->broadcasting_date;
        }

        if($request->reasons_for_creation){
            $process->reasons_for_creation = $request->reasons_for_creation;
        }

        if($request->reasons_for_modification){
            $process->reasons_for_modification = $request->reasons_for_modification;
        }

        if($request->appendices){
            $process->appendices = $request->appendices;
        }

        $process->save();
        $process->entities()->sync($request->entities);

        return redirect()->route('admin.processes.index')->with('message', 'Procédure modifiée avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function destroy(Process $process)
    {
        $process->deleted_by = auth()->user()->id;
        $process->save();
        $process->delete();

        return response()->json(['message' => 'Process deleted!']);
    }

    public function processQuery($request)
    {
        $query = Process::query();
        $search = "%".$request->search."%";
        if($request->search_type == "all" && !empty($request->search))
        {
            $query->where('name', 'LIKE', $search);
            $query->orWhere('reference', 'LIKE', $search);
            $query->orWhere('state', 'LIKE', $search);
            $query->orWhere('status', 'LIKE', $search);
        }
        if($request->search_type == "reference" && !empty($request->search)){
            $query->where('reference', 'LIKE', $search);
        }
        if($request->search_type == "state" && !empty($request->search)){
            $query->where('state', $request->search);
        }
        if($request->search_type == "status" && !empty($request->search)){
            $query->where('status', $request->search);
        }
        if($request->search_type == "method" && !empty($request->search)){
            $query->where('method_id', $request->search);
        }
        if($request->search_type == "pole" && !empty($request->search)){
            $query->whereHas('entities', function($query) use($request){
                $query->where('pole_id', $request->search);
            });
        }
        if($request->search_type == "macroprocess" && !empty($request->search)){
            $query->whereHas('method', function($query) use($request){
                $query->where('macroprocess_id', $request->search);
            });
        }
        return $query;
    }
}
