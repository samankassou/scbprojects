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
                            <option value="all">dans tous les projets</option>
                            <option value="reference">par Reférence</option>
                            <option value="amoa">par AMOA</option>
                            <option value="sponsor">par Sponsor/MOA</option>
                            <option value="year">par Année de début</option>
                            <option value="status">par Statut</option>
                            <option value="natures">par Nature(s)</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <div class="search-container active">
                        <div class="choices">
                            <div class="choices__inner">
                                <input type="text" class="form-control all search choices__input" id="allSearch" placeholder="Rechercher un projet...">
                            </div>
                        </div>
                    </div>
                    <div class="search-container">
                        <div class="choices">
                            <div class="choices__inner">
                                <input class="form-control reference search choices__input" id="referenceSearch" type="text" placeholder="Entrez une reférence...">
                            </div>
                        </div>
                    </div>
                    <div class="search-container">
                        <div class="choices">
                            <div class="choices__inner">
                                <input class="form-control amoa search choices__input" id="amoaSearch" type="text" placeholder="AMOA...">
                            </div>
                        </div>
                    </div>
                    <div class="search-container">
                        <div class="choices">
                            <div class="choices__inner">
                                <input class="form-control sponsor search choices__input" id="sponsorSearch" type="text" placeholder="Sponsor/MOA...">
                            </div>
                        </div>
                    </div>
                    <div class="search-container">
                        <select id="yearSearch" class="form-select year search">
                            <option value="">Toutes</option>
                            @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-container">
                        <select id="statusSearch" class="form-select status search">
                            <option value="">Tous</option>
                            <option value="en cours">En cours</option>
                            <option value="inachevé">En stand-by</option>
                            <option value="en stand-by">inachevé</option>
                            <option value="terminé">Terminé</option>
                        </select>
                    </div>
                    <div class="search-container">
                        <select id="natureSearch" class="form-select natures search" multiple>
                            <option placeholder>Choisir une ou plusieurs nature(s)</option>
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
                    <button id="export-btn" class="btn btn-outline-primary m-2">
                        <i class='bi bi-file-spreadsheet'></i>
                        <span>Exporter(Excel)</span>
                    </button>
                    <button id="import-btn" class="btn btn-outline-primary m-2">
                        <i class='bi bi-download'></i>
                        <span>Importer(Excel)</span>
                    </button>
                </div>
                <div>
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus"></i> Créer</a>
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
                        <th style="width: 140px">Options</th>
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
                    <input type="hidden" id="projectId">
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
    let token = $('meta[name="csrf-token"]').attr('content');
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
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
                _token: token,
                search_type: function(){
                    return getData().search_type;
                },
                search: function(){
                    return getData().search;
                }
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
    $('#delete-project-btn').on('click', deleteProject);
    $('#export-btn').on('click', exportToExcel);
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
        let criteria = $(this).val();
        $('.'+criteria).closest('.search-container').addClass('active');
        table.ajax.reload(null, false);

    });
    $("input[type='text'].search").on('keyup', function(){
        table.ajax.reload(null, false);
    });
    $("select.search").on('change', function(){
        table.ajax.reload(null, false);
    });

    function getData()
    {
        let criteria = $('#criteria').val();
        let search_type = criteria;
        
        if(criteria == "all"){
            search = $('#allSearch').val();
        }
        if(criteria == "reference"){
            search = $('#referenceSearch').val();
        }
        if(criteria == "sponsor"){
            search = $('#sponsorSearch').val();
        }
        if(criteria == "amoa"){
            search = $('#amoaSearch').val();
        }
        if(criteria == "year"){
            search = yearSearch.getValue().value;
        }
        if(criteria == "status"){
            search = status = statusSearch.getValue().value;
        }
        if(criteria == "natures"){
            const natures = natureSearch.getValue().map(element => {
                return parseInt(element.value);
            });
            search = JSON.stringify(natures);
        }
            return {
            search_type: search_type,
            search: search};
    }

    function exportToExcel()
    {
        let search_type = getData().search_type,
        search = getData().search;
        window.location = "/admin/projects/export?search_type="+search_type+"&search="+search;
    }

    function showDeleteProjectModal(id)
    {
        $('#projectId').val(id);
        $('#delete-project-modal').modal('show');
    }

    function deleteProject()
    {
        $(this).addClass('disabled')
        .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Suppression...')
        .attr('disabled', true);
        let id = $('#projectId').val();
        $.ajax({
            url: "/admin/projects/"+id,
            method: "POST",
            data: {_method: "DELETE"},
            success: (response)=>{                
                table.ajax.reload(null, false);
                Toastify({
                    text: "Projet supprimée avec succès!",
                    duration: 3000,
                    close:true,
                    gravity:"top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
                
            },
            error: (response)=>{
                console.log(response);
            },
            complete: ()=>{
                $('#delete-project-btn').removeClass('disabled').text('Supprimer').attr('disabled', false);
                $('#delete-project-modal').modal('hide');
            }
        });
        return false;
    }
</script>
@endsection