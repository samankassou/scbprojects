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
{{-- Edit user modal --}}
<div class="modal fade text-left" id="edit-user-modal" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifier un utilisateur </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="edit-user-form">
                    <div class="form-group">
                        <input type="text" id="edit-name" placeholder="Nom(s)" class="form-control" name="name">
                        <div class="invalid-feedback" id="edit-name-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <input id="edit-email" type="email" placeholder="Email" class="form-control" name="email">
                        <div class="invalid-feedback" id="edit-email-error"></div>
                    </div>

                    <label>Rôle: </label>
                    <div class="form-group">
                        <select name="role" id="edit-role">
                            <option value="">Choisir un rôle</option>
                            @foreach ($usersRoles as $role)
                                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="edit-role-error"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Annuler</span>
                </button>
                <button id="update-user-btn" type="button" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Enregistrer</span>
                </button>
            </div>
        </div>
    </div>
</div>
{{--! Edit user modal --}}
{{--  User infos modal --}}
<div class="modal fade text-left" id="user-infos-modal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white">
                    Informations utilisateur
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nom(s)</strong>: <span class="name"></span></p>
                <p><strong>Email</strong>: <span class="email"></span></p>
                <p><strong>Rôle</strong>: <span class="role"></span></p>
                <p><strong>Date de création</strong>: <span class="created_at"></span></p>
                <p><strong>Date de dernière modification</strong>: <span class="updated_at"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Fermer</span>
                </button>
            </div>
        </div>
    </div>
</div>
{{--!  User infos modal --}}
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
    $(function () {
        token = $('meta[name="csrf-token"]').attr('content');
        editRoleChoice = new Choices(document.getElementById('edit-role'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
        table = $('#users-datatable').DataTable({
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
                {
                    data: 'status', 
                    name: 'status',
                    orderable: false, 
                    searchable: false
                },
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ]
        });
        $('#delete-user-btn').on('click', deleteUser);
        $('#save-user-btn').on('click', saveUser);
        $('#update-user-btn').on('click', updateUser);
        $('#create-user-modal, #edit-user-modal').on('hide.bs.modal', function(e){
            resetModal(e);
        });
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

    function updateUser()
    {
        let id = $('#edit-user-modal').data('user-id');
        $(this).addClass('disabled')
        .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enregistrement...')
        .attr('disabled', true);
        removeErrorMessages("edit-user-modal");
        let name = $('#edit-name').val();
        let email = $('#edit-email').val();
        let role = $('#edit-role').val();

        let data = {
            _method: "PATCH",
            name: name,
            email: email,
            role: role
        };
        
        $.ajax({
            method: "POST",
            url: "/admin/users/"+id,
            data: data,
            success: function(response){
                $('#edit-user-modal').modal('hide');
                table.ajax.reload(null, false);
                Toastify({
                    text: "Modifications enregistrées avec succès!",
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
                    $('#edit-'+error+'-error').html(errors[error][0]).show();
                }
            },
            complete: function(){
                $('#update-user-btn').removeClass('disabled').text('Enregistrer').attr('disabled', false);
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
        let deleteModal = $('#delete-user-modal');
        let id = deleteModal.data('user-id');
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
        $(this).addClass('disabled')
        .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Suppression...')
        .attr('disabled', true);
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
    function showEditUserModal(id)
    {
        $.ajax({
            url: "/admin/users/"+id+"/edit",
            success: function(response){
                let user = response.user;
                $('#edit-name').val(user.name);
                $('#edit-email').val(user.email);
                editRoleChoice.setChoiceByValue(''+user.roles[0].id);
                $('#edit-user-modal').data('user-id', id).modal('show');
            },
            error: function(response){
                console.log(response);
            }
        });
        
    }

    function showDeleteUserModal(id)
    {
        $('#delete-user-modal').data('user-id', id).modal('show');
    }

    function showUserInfosModal(id)
    {
        $.ajax({
            url: '/admin/users/'+id,
            dataType: "JSON",
            success: function(response){
                let user = response.user;
                let createdAt = new Date(user.created_at);
                let updatedAt = new Date(user.updated_at);
                $('#user-infos-modal .name').text(user.name);
                $('#user-infos-modal .email').text(user.email);
                $('#user-infos-modal .role').text(user.roles[0].display_name);
                $('#user-infos-modal .created_at').text(createdAt.toLocaleDateString()+' à '+createdAt.toLocaleTimeString());
                $('#user-infos-modal .updated_at').text(updatedAt.toLocaleDateString()+' à '+updatedAt.toLocaleTimeString());
                $('#user-infos-modal').modal('show');
            },
            error: function(response){
                console.log(response);
            }
        });
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