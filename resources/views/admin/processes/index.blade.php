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
            <h5>Rechercher:</h5>
            <div class="row">
                <div class="col-md-4">
                    <fieldset class="form-group">
                        <select class="form-select choices" id="criteria">
                            <option value="all">dans tous les process</option>
                            <option value="amoa">par Nom</option>
                            <option value="reference">par Etat</option>
                            <option value="sponsor">par Statut</option>
                            <option value="year">par Pôle</option>
                            <option value="status">par Macroprocessus</option>
                            <option value="year">par Processus</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <div class="search-container active">
                        <div class="choices">
                            <div class="choices__inner">
                                <input type="text" class="form-control all search choices__input" id="allSearch" placeholder="Rechercher une procédure...">
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
                        <select id="statusSearch" class="form-select status search">
                            <option value="">Tous</option>
                            <option value="en cours">En cours</option>
                            <option value="inachevé">En stand-by</option>
                            <option value="en stand-by">inachevé</option>
                            <option value="terminé">Terminé</option>
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
                    <a href="{{ route('admin.processes.create') }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus"></i> Créer</a>
                </div>
            </div>
            <table class="table table-striped" id="processes-datatable" style="width: 100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Macroprocessus</th>
                        <th>Processus</th>
                        <th>Procédure</th>
                        <th>Type</th>
                        <th>Ref.</th>
                        <th>Version</th>
                        <th>Etat</th>
                        <th>Statut</th>
                        <th>Date de création</th>
                        <th style="width: 120px">Options</th>
                    </tr>
                </thead>
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
     let token = $('meta[name="csrf-token"]').attr('content');
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
    });
    const table = $('#processes-datatable').DataTable({
        searching: false,
        language: {
            url: "{{ asset('vendor/datatables/lang/French.json') }}"
        },
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/processes/list",
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
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {
                data: 'method.macroprocess.name', 
                name: 'method.macroprocess.name'
            },
            {
                data: 'method.name', 
                name: 'method.name'
            },
            {data: 'name', name: 'name'},
            {data: 'type', name: 'type'},
            {data: 'reference', name: 'reference'},
            {data: 'version', name: 'version'},
            {data: 'state', name: 'state'},
            {data: 'status', name: 'status'},
            {
                data: 'creation_date', 
                name: 'creation_date',
                orderable: false,
                searchable: false,
                render: function(created_at){
                    let createdAt = new Date(created_at);
                    return createdAt.toLocaleDateString();
                }
            },
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false
            }
        ]
    });
    $('#delete-process-btn').on('click', deleteProcess);
    
    // const yearSearch = new Choices(document.getElementById('yearSearch'));
    // const statusSearch = new Choices(document.getElementById('statusSearch'));
    // const natureSearch = new Choices(document.getElementById('natureSearch'), {
    //     removeItemButton: true
    // });
    
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

    function showDeleteProcessModal(id)
    {
        $('#delete-process-modal').modal('show');
    }

    function deleteProcess()
    {

    }
</script>
@endsection