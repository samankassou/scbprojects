<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pole;
use App\Models\Domain;
use App\Models\Entity;
use App\Models\Method;
use App\Models\Process;
use App\Models\Macroprocess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
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
        return view('admin.processes.index', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $domains = Domain::all();
        $poles = Pole::all();
        return view('admin.processes.create', compact('domains', 'poles'));
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

    /**
     * list Entities related to a Pole.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEntities(Request $request)
    {
        $entities = Entity::where('pole_id', $request->id)->get();
        return response()->json(['entities' => $entities]);
    }

    public function showByRef(Request $request)
    {
        $process = Process::firstWhere('reference', $request->reference);
        abort_if(!$process, 404, 'Reférence incorrecte ou process inexistant');
        return view('admin.processes.show_by_ref', compact('process'));
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
        $pdf = App::make('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('admin.processes.pdf.show', compact('process'));
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
        dd($request->all());
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
        return view('admin.processes.show', compact('process'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function edit(Process $process)
    {
        $domains = Domain::all();
        $poles = Pole::all();
        return view('admin.processes.edit', compact('process', 'domains', 'poles'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function destroy(Process $process)
    {
        //
    }
}
