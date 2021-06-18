@extends('layouts.datatable', ['title' => 'Procédures supprimées'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
<link rel="stylesheet" href="{{ asset('mazer/assets/css/search.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="card-header d-flex justify-content-between">
                <h2>Liste des procédures supprimées</h2>
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
                        <th>Supprimé le</th>
                        <th>Supprimé par</th>
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
                    <p>Voulez-vous vraiment supprimer?</p>
                    <p><em>Cette procédure sera supprimée définitivement</em></p>
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
            url: "/admin/processes/deleted",
            type: "POST",
            data: {
                _token: token
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
            {data: 'last_version.name', name: 'name'},
            {data: 'last_version.type', name: 'type'},
            {data: 'reference', name: 'reference'},
            {
                data: 'deleted_at', 
                name: 'deleted_at',
                orderable: false,
                searchable: false,
                render: function(deleted_at){
                    let deletedAt = new Date(deleted_at);
                    return deletedAt.toLocaleDateString()+' à '+deletedAt.toLocaleTimeString();
                }
            },
            {
                data: 'deleter', 
                name: 'deleter',
                orderable: false,
                searchable: false,
                render: function(deleter){
                    return deleter.name;
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
            url: "/admin/processes/delete/"+id,
            method: "POST",
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

    function restoreProcess(id)
    {
        $.ajax({
            url: "/admin/processes/restore/"+id,
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