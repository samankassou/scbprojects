@extends('layouts.app', ['title' => 'Parametres'])
@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/toastify/toastify.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Parametres du compte de "{{ auth()->user()->name }}"</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"></h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                                        role="tab" aria-controls="home" aria-selected="true">Détails</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                        role="tab" aria-controls="profile" aria-selected="false">Modifier Infos</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact"
                                        role="tab" aria-controls="contact" aria-selected="false">Gérer le mot de passe</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="my-4">
                                        <p class='my-2'><strong>Nom(s): </strong>{{ auth()->user()->name }}</p>
                                        <p class='my-2'><strong>Email: </strong>{{ auth()->user()->email }}</p>
                                        <p class='my-2'><strong>Rôle: </strong>{{ auth()->user()->roles()->get()[0]->display_name }}</p>
                                        <p class='my-2'><strong>Date de création: </strong>{{ auth()->user()->created_at->format('d/m/Y à H:i:s') }}</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <div class="row my-4">
                                        <div class="col-md-6">
                                            <form action="#" id="user-form">
                                                <div class="form-group">
                                                    <input type="text" id="name" placeholder="Nom(s)" class="form-control" name="name" value="{{ auth()->user()->name }}">
                                                    <div class="invalid-feedback" id="name-error"></div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ auth()->user()->email }}">
                                                    <div class="invalid-feedback" id="email-error"></div>
                                                </div>
    
                                                <div class="form-group">
                                                    <button id="update-user-btn" type="button" class="btn btn-primary ml-1">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Enregistrer</span>
                                                    </button>
                                                </div>
                            
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel"
                                    aria-labelledby="contact-tab">
                                    <div class="row my-4">
                                        <div class="col-md-6">
                                            <form action="#" id="password-form">
                                                <div class="form-group">
                                                    <input type="password" id="actual_password" placeholder="Mot de passe actuel" class="form-control" name="actual-password">
                                                    <div class="invalid-feedback" id="actual_password-error"></div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <input id="password" type="password" placeholder="Nouveau mot de passe" class="form-control" name="password">
                                                    <div class="invalid-feedback" id="password-error"></div>
                                                </div>
    
                                                <div class="form-group">
                                                    <input id="password_confirmation" type="password" placeholder="Confirmez le mot de passe" class="form-control" name="password_confirmation">
                                                    <div class="invalid-feedback" id="password_confirmation-error"></div>
                                                </div>
    
                                                <div class="form-group">
                                                    <button id="update-password-btn" type="button" class="btn btn-primary ml-1">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Enregistrer</span>
                                                    </button>
                                                </div>
                            
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@parent
<script src="{{ asset('vendor/datatables/js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('mazer/assets/vendors/toastify/toastify.js') }}"></script>
<script>
    $(function(){
        token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        $('#update-user-btn').on('click', updateUser);
        $('#update-password-btn').on('click', updatePassword);
    });

    function updateUser()
    {
        removeUserErrors();
        $(this).addClass('disabled')
        .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enregistrement...')
        .attr('disabled', true);
        let name = $('#name').val();
        let email = $('#email').val();

        let data = {
            name: name,
            email: email,
        };
        
        $.ajax({
            method: "POST",
            url: "/admin/settings/update",
            data: data,
            success: function(response){
                console.log(response.message);
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
                    $('#'+error+'-error').html(errors[error][0]).show();
                }
            },
            complete: function(){
                $('#update-user-btn').removeClass('disabled').text('Enregistrer').attr('disabled', false);
            }
        });
        return false;
    }

    function updatePassword()
    {
        removePasswordErrors();
        $(this).addClass('disabled')
        .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enregistrement...')
        .attr('disabled', true);
        let actual_password = $('#actual_password').val();
        let password = $('#password').val();
        let password_confirmation = $('#password_confirmation').val();

        let data = {
            actual_password: actual_password,
            password: password,
            password_confirmation: password_confirmation,
        };
        
        $.ajax({
            method: "POST",
            url: "/admin/settings/updatePassword",
            data: data,
            success: function(response){
                console.log(response.message);
                $('#password-form').trigger('reset');
                Toastify({
                    text: "Mot de passe modifié avec succès!",
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
                $('#update-password-btn').removeClass('disabled').text('Enregistrer').attr('disabled', false);
            }
        });
        return false;
    }

    function removePasswordErrors()
    {
        $('#actual_password-error').text('');
        $('#password-error').text('');
        $('#password_confirmation-error').text('');
    }

    function removeUserErrors()
    {
        $('#name-error').text('');
        $('#email-error').text('');
    }
</script>
@endsection