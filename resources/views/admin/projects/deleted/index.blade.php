@extends('layouts.datatable', ['title' => 'Projets supprimés'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/css/search.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-light-success alert-dismissible color-success">
                    <i class="bi bi-check-circle"></i> {{ session('message') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-header d-flex justify-content-between">
                <h2>Liste des projets supprimés</h2>
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
                    <p>Voulez-vous vraiment supprimer?</p>
                    <p><em>Ce project sera supprimé définitivement</em></p>
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
            url: "/admin/projects/deleted",
            type: "POST",
            data: {
                _token: token
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
            url: "/admin/projects/delete/"+id,
            method: "POST",
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

    function restoreProject(id)
    {
        $.ajax({
            url: "/admin/projects/restore/"+id,
            method: "POST",
            success: (response)=>{                
                table.ajax.reload(null, false);
                Toastify({
                    text: "Projet restauré avec succès!",
                    duration: 3000,
                    close:true,
                    gravity:"top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
                
            },
            error: (response)=>{
                console.log(response);
            }
        });
        return false;
    }
</script>
@endsection