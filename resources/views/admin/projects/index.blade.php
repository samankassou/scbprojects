@extends('layouts.datatable', ['title' => 'Projets'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5>Rechercher:</h5>
            <div class="row">
                <div class="col-md-3">
                    <fieldset class="form-group">
                        <select class="form-select choices" id="criteria">
                            <option>dans tous les projets</option>
                            <option>par Reférence</option>
                            <option>par AMOA</option>
                            <option>par Sponsor/MOA</option>
                            <option>par Année de début</option>
                            <option>par Statut</option>
                            <option>par Nature</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control search" id="search" placeholder="Rechercher...">
                    <input class="form-control search" id="referenceSearch" type="text" placeholder="Entrez une reférence...">
                    <input class="form-control search" id="amoaSearch" type="text" placeholder="AMOA...">
                    <input class="form-control search" id="sponsorSearch" type="text" placeholder="Sponsor/MOA...">
                    <select id="yearSearch" class="form-select search">
                        <option value="">Toutes</option>
                        @foreach ($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                    <select id="statusSearch" class="form-select search">
                        <option value="">Tous</option>
                        <option value="1">En cours</option>
                        <option value="2">En stand-by</option>
                        <option value="3">inachevé</option>
                        <option value="4">Terminé</option>
                    </select>
                    <select id="natureSearch" class="form-select multiple-remove search" multiple>
                        <option value=""></option>
                        <option value="">Reglémentaire</option>
                        <option value="1">Business</option>
                        <option value="2">Gain de productivité</option>
                        <option value="3">Optimisation d'un process</option>
                        <option value="4">Réduction d'un risque</option>
                    </select>
                </div>
            </div>
            <div class="card-header d-flex justify-content-between">
                <h2>Liste des projets</h2>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <button class="btn btn-outline-primary m-2">Imprimer</button>
                    <button class="btn btn-outline-primary m-2">Exporter(Excel)</button>
                </div>
                <div>
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i> Créer</a>
                </div>
            </div>
            <table class="table table-striped" id="projects-datatable" style="width: 100%">
                <thead>
                    <tr>
                        <th>Ref.</th>
                        <th>Nom</th>
                        <th>AMOA</th>
                        <th>Sponsor/MOA</th>
                        <th>Statut</th>
                        <th>Année</th>
                        <th>Nature</th>
                        <th style="width: 120px">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <td></td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->amoa }}</td>
                            <td>{{ $project->sponsor }}</td>
                            <td>{{ $project->status }}</td>
                            <td>{{ $project->start_date->year }}</td>
                            <td>
                                @foreach ($project->natures as $nature)
                                    @if (!$loop->last)
                                    {{ $nature->name }},
                                    @else
                                    {{ $nature->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admin.projects.show', $project->id) }}" class='btn btn-sm btn-primary'><i class='bi bi-eye'></i></a>
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class='btn btn-sm btn-warning'><i class='bi bi-pencil'></i></a>
                                <button data-bs-toggle='modal' data-bs-target='#delete-project-modal' onclick="showDeleteProjectModal({{ $project->id }})" class='btn btn-sm btn-danger'><i class='bi bi-trash'></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">Aucun projet enregistré</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
{{-- Delete project modal --}}
<div class="modal-danger me-1 mb-1 d-inline-block">
    <!--Danger theme Modal -->
    <div class="modal fade text-left" id="delete-project-modal" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <form id="delete-project-form" class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel120">
                        Supprimer un projet
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    Voulez-vous vraiment supprimer?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Annuler</span>
                    </button>
                    <button id="delete-project-btn" type="button" class="btn btn-danger ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">supprimer</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--! Delete project modal --}}
@endsection
@section('scripts')
@parent
<script src="{{ asset('mazer/assets/vendors/choices.js/choices.min.js') }}"></script>
<script>
    var table = $('#projects-datatable').DataTable({
        searching: false,
        language: {
            url: "{{ asset('vendor/datatables/lang/French.json') }}"
        },
    });
    var selects = document.querySelectorAll('select.search');
    selects.forEach(function(element){
        element = new Choices(element);
    });
    $('#criteria').on('change', function(){
        $('.search').val('');
        selects.forEach(function(element){
            //element.setChoiceByValue('');
    });
    });
    $("input[type='text'].search, select.search").on('keyup', function(){
        console.log("ok");
    });
    $("select.search").on('change', function(){
        console.log("ok");
    });
</script>
@endsection