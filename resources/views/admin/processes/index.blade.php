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
                            <option value="reference">par Reférence</option>
                            <option value="name">par Nom</option>
                            <option value="state">par Etat</option>
                            <option value="status">par Statut</option>
                            <option value="pole">par Pôle</option>
                            <option value="macroprocess">par Macroprocessus</option>
                            <option value="method">par Processus</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <div class="search-container active">
                        <div class="choices">
                            <div class="choices__inner">
                                <input type="text" class="form-control all search choices__input" id="allSearch"
                                    placeholder="Rechercher une procédure...">
                            </div>
                        </div>
                    </div>
                    <div class="search-container">
                        <div class="choices">
                            <div class="choices__inner">
                                <input type="text" class="form-control reference search choices__input"
                                    id="referenceSearch" placeholder="Entrez une reférence de procédure...">
                            </div>
                        </div>
                    </div>
                    <div class="search-container">
                        <div class="choices">
                            <div class="choices__inner">
                                <input class="form-control name search choices__input" id="nameSearch" type="text"
                                    placeholder="Entrez un nom de procédure...">
                            </div>
                        </div>
                    </div>
                    <div class="search-container">
                        <select id="stateSearch" class="form-select state search">
                            <option value="">Tous</option>
                            <option value="Créé">Créé</option>
                            <option value="Revu">Revu</option>
                        </select>
                    </div>
                    <div class="search-container">
                        <select id="statusSearch" class="form-select status search">
                            <option value="">Tous</option>
                            <option value="A créer">A créer</option>
                            <option value="Terminé">Terminé</option>
                            <option value="En stand-by">En stand-by</option>
                            <option value="En cours de rédaction">En cours de rédaction</option>
                            <option value="En cours de vérification">En cours de vérification</option>
                            <option value="En cours d'approbation">En cours d'approbation</option>
                        </select>
                    </div>
                    <div class="search-container">
                        <select id="poleSearch" class="form-select pole search">
                            <option value="">Tous</option>
                            @foreach ($poles as $pole)
                            <option value="{{ $pole->id }}">{{ $pole->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-container">
                        <select id="macroprocessSearch" class="form-select macroprocess search">
                            <option value="">Tous</option>
                            @foreach ($macroprocesses as $macroprocess)
                            <option value="{{ $macroprocess->id }}">
                                @if (($macroprocess->name == "Développement et pilotage de projets") ||
                                ($macroprocess->name == "Gestion des reportings"))
                                {{ $macroprocess->name }}({{ $macroprocess->domain->name }})
                                @else
                                {{ $macroprocess->name }}
                                @endif
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-container">
                        <select id="methodSearch" class="form-select method search">
                            <option value="">Tous</option>
                            @foreach ($methods as $method)
                            <option value="{{ $method->id }}">{{ $method->name }}</option>
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
                <h2>Liste des procédures</h2>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <button id="export-btn" class="btn btn-outline-primary m-2">
                        <i class='bi bi-file-spreadsheet'></i>
                        <span>Exporter(Excel)</span>
                    </button>
                </div>
                <div>
                    <a href="{{ route('admin.processes.create') }}" class="btn btn-sm btn-outline-primary"><i
                            class="bi bi-plus"></i> Créer</a>
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
    <div class="modal fade text-left" id="delete-process-modal" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <form id="delete-process-form" class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white">
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
    $(function () {
        token = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        stateSearch = new Choices(document.getElementById('stateSearch'));
        statusSearch = new Choices(document.getElementById('statusSearch'));
        poleSearch = new Choices(document.getElementById('poleSearch'));
        macroprocessSearch = new Choices(document.getElementById('macroprocessSearch'));
        methodSearch = new Choices(document.getElementById('methodSearch'));

        table = $('#processes-datatable').DataTable({
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
        $('#export-btn').on('click', exportToExcel);
        $('#criteria').on('change', function(){
            //reset all inputs search
            $("input[type='text'].search").val('');
            stateSearch.setChoiceByValue('');
            statusSearch.setChoiceByValue('');
            poleSearch.setChoiceByValue('');
            macroprocessSearch.setChoiceByValue('');
            methodSearch.setChoiceByValue('');
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
    });
    

    function getData()
    {
        let criteria = $('#criteria').val();
        let search_type = criteria;
        
        if(criteria == "all"){
            search = $('#allSearch').val();
        }
        if(criteria == "name"){
            search = $('#nameSearch').val();
        }
        if(criteria == "reference"){
            search = $('#referenceSearch').val();
        }
        if(criteria == "state"){
            search = stateSearch.getValue().value;
        }
        if(criteria == "pole"){
            search = poleSearch.getValue().value;
        }
        if(criteria == "macroprocess"){
            search = macroprocessSearch.getValue().value;
        }
        if(criteria == "method"){
            search = methodSearch.getValue().value;
        }
        if(criteria == "status"){
            search = status = statusSearch.getValue().value;
        }
            return {
            search_type: search_type,
            search: search};
    }

    function exportToExcel()
    {
        let search_type = getData().search_type,
        search = getData().search;
        window.location = "/admin/processes/export?search_type="+search_type+"&search="+search;
    }

    function showDeleteProcessModal(id)
    {
        $('#delete-process-modal').data('id',id);
        $('#delete-process-modal').modal('show');
    }

    function deleteProcess()
    {
        $(this).addClass('disabled')
        .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Suppression...')
        .attr('disabled', true);
        let id = $('#delete-process-modal').data('id');
        $.ajax({
            url: "/admin/processes/"+id,
            method: "POST",
            data: {_method: "DELETE"},
            success: (response)=>{                
                table.ajax.reload(null, false);
                Toastify({
                    text: "Procédure supprimée avec succès!",
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
                $('#delete-process-btn').removeClass('disabled').text('Supprimer').attr('disabled', false);
                $('#delete-process-modal').modal('hide');
            }
        });
        return false;
    }
</script>
@endsection