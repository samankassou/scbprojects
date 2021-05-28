@extends('layouts.datatable', ['title' => 'Procédures'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/css/search.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-8 d-flex">
                    <p class="h4 mr-2">Rechercher: </p>
                    <div id="searchBar" class="input-group mb-3">
                        <button class="btn btn-primary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">dans toutes les procédures</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">dans toutes les procédures</a></li>
                            <li><a class="dropdown-item" href="#">par Intitulé</a></li>
                            <li><a class="dropdown-item" href="#">par Date de diffusion</a></li>
                            <li><a class="dropdown-item" href="#">par Domaine</a>
                            <li><a class="dropdown-item" href="#">par Macroprocessus</a>
                            <li><a class="dropdown-item" href="#">par Processus</a>
                            <li><a class="dropdown-item" href="#">par Pôle</a>
                            <li><a class="dropdown-item" href="#">par Entité</a>
                            </li>
                        </ul>
                        <input type="text" class="form-control"
                            aria-label="Rechercher une procédure" placeholder="Rechercher une procédure">
                    </div>
                </div>
                <div class="col-md-4 d-none">
                    <fieldset class="form-group">
                        <select class="form-select choices" id="searchType">
                            <option value="allSearch">dans toutes les procédures</option>
                            <option value="">par Intitulé</option>
                            <option value="">par Date de diffusion</option>
                            <option value="">par Statut</option>
                            <option value="">par Domaine</option>
                            <option value="">par Macroprocessus</option>
                            <option value="">par Processus</option>
                            <option value="">par Pôle</option>
                            <option value="">par Entité</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-md-6 d-none">
                    <div class="search-container active">
                        <input type="text" class="form-control search" id="allSearch" placeholder="Rechercher une procédure...">
                    </div>
                    <div class="search-container">
                        <input class="form-control search" id="referenceSearch" type="text" placeholder="Entrez une reférence...">
                    </div>
                    <div class="search-container">
                        <input class="form-control search" id="amoaSearch" type="text" placeholder="AMOA...">
                    </div>
                    <div class="search-container">
                        <input class="form-control search" id="sponsorSearch" type="text" placeholder="Sponsor/MOA...">
                    </div>
                    <div class="search-container">
                        <select id="statusSearch" class="form-select search">
                            <option value="">Tous</option>
                            <option value="1">En cours</option>
                            <option value="2">En stand-by</option>
                            <option value="3">inachevé</option>
                            <option value="4">Terminé</option>
                        </select>
                    </div>
                </div>
            </div>
            @if (session('message'))
                <div class="alert alert-light-success alert-dismissible color-success">
                    <i class="bi bi-check-circle"></i> {{ session('message') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-header d-flex justify-content-between">
                <h2>Liste des procédures</h2>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <button class="btn btn-outline-primary m-2">Exporter(Excel)</button>
                </div>
                <div>
                    <a href="{{ route('admin.processes.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i> Créer</a>
                </div>
            </div>
            <table class="table table-striped" id="processes-datatable" style="width: 100%">
                <thead>
                    <tr>
                        <th>Ref.</th>
                        <th>Version</th>
                        <th>Intitulé</th>
                        <th>Statut</th>
                        <th>Date de création</th>
                        <th>Pôle</th>
                        <th style="width: 120px">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($processes as $process)
                        <tr>
                            <td>{{ $process->reference }}</td>
                            <td>{{ $process->version }}</td>
                            <td>{{ $process->name }}</td>
                            <td>{{ $process->status }}</td>
                            <td>{{ $process->creation_date->format('d/m/Y') }}</td>
                            <td>{{ $process->entity->pole->name }}</td>
                            <td>
                                <a href="{{ route('admin.processes.show', $process->id) }}" class='btn btn-sm btn-primary'><i class='bi bi-eye'></i></a>
                                <a href="{{ route('admin.processes.edit', $process->id) }}" class='btn btn-sm btn-warning'><i class='bi bi-pencil'></i></a>
                                <button onclick="showDeleteProcessModal({{ $process->id }})" class='btn btn-sm btn-danger delete-btn'><i class='bi bi-trash'></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
{{-- Delete process modal --}}
<div class="modal-danger me-1 mb-1 d-inline-block">
    <!--Danger theme Modal -->
    <div class="modal fade text-left" id="delete-process-modal" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <form id="delete-process-form" class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel120">
                        Supprimer une procédure
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
                    <button id="delete-process-btn" type="button" class="btn btn-danger ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">supprimer</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--! Delete process modal --}}
@endsection
@section('scripts')
@parent
<script src="{{ asset('mazer/assets/vendors/choices.js/choices.min.js') }}"></script>
<script>
    $('#delete-process-btn').on('click', deleteProcess);
    $('#searchBar button, #searchBar li a').on('click', ()=>{
        console.log($(this).html());
    });
    const table = $('#processes-datatable').DataTable({
        searching: false,
        language: {
            url: "{{ asset('vendor/datatables/lang/French.json') }}"
        },
    });
    const yearSearch = new Choices(document.getElementById('yearSearch'));
    const statusSearch = new Choices(document.getElementById('statusSearch'));
    const natureSearch = new Choices(document.getElementById('natureSearch'), {
        removeItemButton: true
    });
    
    $('#searchType').on('change', function(){
        //reset all inputs search
        $("input[type='text'].search").val('');
        yearSearch.setChoiceByValue('');
        statusSearch.setChoiceByValue('');
        natureSearch.removeActiveItems();
        //remove the active search
        $('.search-container').removeClass('active');
        //set the new active box
        let element = $(this).val();
        $('#'+element).closest('.search-container').addClass('active');

    });
    $("input[type='text'].search").on('keyup', function(){
        //table.ajax.reload(null, false);
        console.log(getData());
    });
    $("select.search").on('change', function(){
        //table.ajax.reload(null, false);
        console.log(getData());
    });

    function getData()
    {
        const searchType = document.getElementById('searchType').value,
        all = document.getElementById('allSearch').value,
        year = yearSearch.getValue().value,
        reference = document.getElementById('referenceSearch').value,
        amoa = document.getElementById('amoaSearch').value;
        const natures = natureSearch.getValue().map(element => {
            return element.value;
        });
        const sponsor = document.getElementById('sponsorSearch').value,
        status = statusSearch.getValue().value;
        
        return {
            all: all,
            year: year,
            reference: reference,
            amoa: amoa,
            natures: natures,
            sponsor: sponsor,
            status: status
            };
            // return {
            //     search_type: searchType,
            //     value: value
            // };
    }

    function showDeleteProcessModal(id)
    {
        $('#delete-process-modal').modal('show');
    }

    function deleteProcess()
    {

    }
</script>
@endsection