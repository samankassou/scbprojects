@extends('layouts.datatable', ['title' => 'Utilisateurs'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/choices.js/choices.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Liste des comptes</h4>
            <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus"></i> Ajouter</a>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="users-datatable" style="width: 100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom(s)</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Statut</th>
                        <th style="width: 120px">Options</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
{{-- Delete user modal --}}
<div class="modal-danger me-1 mb-1 d-inline-block">
    <div class="modal fade text-left" id="delete-user-modal" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel120">
                        Supprimer un utilisateur
                    </h5>
                    <input type="hidden">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    Voulez-vous vraiment le supprimer?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Annuler</span>
                    </button>
                    <button id="delete-user-btn" type="button" class="btn btn-danger ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">supprimer</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{--! Delete user modal --}}
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
        $('#delete-user-btn').on('click', deleteUser);
    });
    const table = $('#users-datatable').DataTable({
        language: {
            url: "{{ asset('vendor/datatables/lang/French.json') }}"
        },
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('admin.users.index') }}"
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {
                data: 'roles',
                name: 'roles',
                orderable: false, 
                searchable: false,
                render: function(roles){
                    return roles[0].display_name
                }
            },
            {data: 'status', name: 'status'},
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false
            },
        ]
    });

    function toggleUserStatus(id)
    {
        $.ajax({
                method: "POST",
                url: "/admin/users/"+id+"/toggleUserStatus",
                dataType: "JSON",
                success: function(response){
                    console.log(response);
                },
                error: function(response){
                    console.log(response);
                }
            });
            return false;
    }

    function deleteUser()
    {
        let deleteModal = $('#delete-user-modal');
        let id = deleteModal.data('id');
        if(id == {{ auth()->user()->id }}){
            deleteModal.modal('hide');
            Toastify({
                text: "Vous ne pouvez pas supprimer le compte actuel!",
                close:true,
                gravity:"top",
                position: "right",
                backgroundColor: "#ff0000",
            }).showToast();
            return;
        }
        $.ajax({
            method: "POST",
            url: "/admin/users/"+id,
            data: {_method: "DELETE"},
            dataType: "JSON",
            success: function(response){
                deleteModal.modal('hide');
                table.ajax.reload(null, false);
                Toastify({
                    text: "Utilisateur supprimé avec succès!",
                    duration: 3000,
                    close:true,
                    gravity:"top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
            },
            error: function(response){
                console.log(response);
            }
        });
        return false;
        
    }
    function showDeleteUserModal(id)
    {
        $('#delete-user-modal').data('id', id).modal('show');
    }
</script>
@endsection