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
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#create-user-modal"><i class="bi bi-plus"></i> Ajouter</button>
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
{{-- Create user modal --}}
<div class="modal fade text-left" id="create-user-modal" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un utilisateur </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="create-user-form">
                    <div class="form-group">
                        <input type="text" id="name" placeholder="Nom(s)" class="form-control" name="name">
                        <div class="invalid-feedback" id="name-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <input id="email" type="email" placeholder="Email" class="form-control" name="email">
                        <div class="invalid-feedback" id="email-error"></div>
                    </div>

                    <label>Rôle: </label>
                    <div class="form-group">
                        <select class="choices" name="role" id="role">
                            <option value="">Choisir un rôle</option>
                            @foreach ($usersRoles as $role)
                                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="role-error"></div>
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" placeholder="Mot de passe" class="form-control" name="password">
                        <div class="invalid-feedback" id="password-error"></div>
                    </div>

                    <div class="form-group">
                        <input id="password_confirmation" type="password" placeholder="Confirmez le mot de passe" class="form-control" name="password_confirmation">
                        <div class="invalid-feedback" id="password_confirmation-error"></div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Annuler</span>
                </button>
                <button id="save-user-btn" type="button" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Enregistrer</span>
                </button>
            </div>
        </div>
    </div>
</div>
{{--! Create user modal --}}
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
        $('#save-user-btn').on('click', saveUser);
        $('#create-user-modal, #edit-user-modal').on('hide.bs.modal', function(e){
        resetModal(e);
    });
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

    function saveUser()
    {
        $(this).addClass('disabled')
        .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enregistrement...')
        .attr('disabled', true);
        removeErrorMessages("create-user-modal");
        var data = $('#create-user-form').serialize();
        $.ajax({
            method: "POST",
            url: "{{ route('admin.users.store') }}",
            data: data,
            success: function(response){
                $('#create-user-modal').modal('hide');
                table.ajax.reload(null, false);
                Toastify({
                    text: "Utilisateur enregistré avec succès!",
                    duration: 3000,
                    close:true,
                    gravity:"top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast();
            },
            error: function(response){
                let errors = response.responseJSON.errors;
                for (const error in errors) {
                    $('#'+error+'-error').html(errors[error][0]).show();
                }
            },
            complete: function(){
                $('#save-user-btn').removeClass('disabled').text('Enregistrer').attr('disabled', false);
            }
        });
        return false;
    }

    function toggleUserStatus(id)
    {
        
        if(id == {{ auth()->user()->id }}){
            Toastify({
                text: "Vous ne pouvez pas désactiver le compte actuel!",
                close:true,
                gravity:"top",
                position: "right",
                backgroundColor: "#ff0000",
            }).showToast();
            table.ajax.reload(null, false);
            return;
        }
        $.ajax({
                method: "POST",
                url: "/admin/users/"+id+"/toggleStatus",
                dataType: "JSON",
                success: function(response){
                    console.log(response);
                    table.ajax.reload(null, false);
                    let message = response.user.status ? "Compte activé avec succès!" : "Compte désactivé avec succès!";
                    Toastify({
                        text: message,
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

    function deleteUser()
    {
        $(this).addClass('disabled')
        .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Suppression...')
        .attr('disabled', true);
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
            },
            complete: function(){
                $('#delete-user-btn').removeClass('disabled').text('Supprimer').attr('disabled', false);
            }
        });
        return false;
        
    }
    function showDeleteUserModal(id)
    {
        $('#delete-user-modal').data('id', id).modal('show');
    }

    function resetModal(e)
    {
        let modalId = e.target.id;
        $('#'+modalId+' form').trigger("reset");
        removeErrorMessages(modalId);
    }

    function removeErrorMessages(modalId)
    {
        $("#"+modalId+" [id$='-error']").html('');
    }
</script>
@endsection