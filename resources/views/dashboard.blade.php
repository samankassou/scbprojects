@extends('layouts.app', ['title' => 'Tableau de bord'])
@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="row">
                @role('admin')
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldUser"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Utilisateurs</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totals['users'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endrole
                @permission('view-projects')
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldCalendar"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Projets</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totals['projects'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldCalendar"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Projets en cours</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totals['active_projects'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldCalendar"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Projets terminés</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totals['finished_projects'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endpermission
                @permission('view-processes')
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldDocument"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Procédures</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totals['processes'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endpermission
                @permission('restore-process')
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldDelete"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Procédures supprimées</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totals['deleted_processes'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endpermission
                @permission('restore-project')
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldDelete"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Projets supprimés</h6>
                                    <h6 class="font-extrabold mb-0">{{ $totals['deleted_projects'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endpermission
            </div>
        </div>
    </div>
</section>
@endsection