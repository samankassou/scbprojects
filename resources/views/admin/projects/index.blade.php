@extends('layouts.datatable', ['title' => 'Projets'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/css/search.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5>Rechercher:</h5>
            <div class="row">
                <div class="col-md-4">
                    <fieldset class="form-group">
                        <select class="form-select choices" id="criteria">
                            <option value="allSearch">dans tous les projets</option>
                            <option value="referenceSearch">par Reférence</option>
                            <option value="amoaSearch">par AMOA</option>
                            <option value="sponsorSearch">par Sponsor/MOA</option>
                            <option value="yearSearch">par Année de début</option>
                            <option value="statusSearch">par Statut</option>
                            <option value="natureSearch">par Nature(s)</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <div class="search-container active">
                        <input type="text" class="form-control search" id="allSearch" placeholder="Rechercher un projet...">
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
                        <select id="yearSearch" class="form-select search">
                            <option value="">Toutes</option>
                            @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
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
                    <div class="search-container">
                        <select id="natureSearch" class="form-select search" multiple>
                            <option value=""></option>
                            @foreach ($natures as $nature)
                                <option value="{{ $nature->id }}">{{ $nature->name }}</option>
                            @endforeach
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
                <h2>Liste des projets</h2>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <div>
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
                        <th>Nature(s)</th>
                        <th style="width: 120px">Options</th>
                    </tr>
                </thead>
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
                    <input type="hidden" id="projrctId">
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
                    <button id="delete-project-btn" type="button" class="btn btn-danger ml-1">
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
    $('#delete-project-btn').on('click', deleteProject);
    const table = $('#projects-datatable').DataTable({
        searching: false,
        language: {
            url: "{{ asset('vendor/datatables/lang/French.json') }}"
        },
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/projects/list",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            {data: 'reference', name: 'reference'},
            {data: 'name', name: 'name'},
            {data: 'amoa', name: 'amoa'},
            {data: 'sponsor', name: 'sponsor'},
            {data: 'status', name: 'status'},
            {data: 'start_year', name: 'start_year'},
            {
                data: 'natures',
                name: 'natures',
                orderable: false, 
                searchable: false,
                render: function(natures){
                    let naturesNames = "";
                    if(natures.length){
                        for(nature of natures){
                            naturesNames += nature.name + ", ";
                        }
                        return naturesNames.slice(0, -1);
                    }
                    return "Aucune";
                }
            },
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false
            },
        ]
    });
    const yearSearch = new Choices(document.getElementById('yearSearch'));
    const statusSearch = new Choices(document.getElementById('statusSearch'));
    const natureSearch = new Choices(document.getElementById('natureSearch'), {
        removeItemButton: true
    });
    
    $('#criteria').on('change', function(){
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
        const criteria = document.getElementById('criteria').value,
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
    }

    function showDeleteProjectModal(id)
    {
        $('#projectId').val(id);
        $('#delete-project-modal').modal('show');
    }

    function deleteProject()
    {
        
    }
</script>
@endsection