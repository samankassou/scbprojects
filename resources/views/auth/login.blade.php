<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<link rel="icon" href="./icon/2.jpg">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>SCB Cameroun</title>
	<!-- fevicon -->
	<link rel="icon" href="{{ asset('front/icon/2.jpg') }}" type="image/gif" />
	<link href="{{ asset('front/assets/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('front/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
	<link href="{{ asset('front/assets/css/style-responsive.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('mazer/assets/vendors/toastify/toastify.css') }}">
	<link href="{{ asset('front/assets/css/styls.css') }}" rel="stylesheet">
</head>

<body>
	<div id="login-page">
		<div class="container">
			<form class="form-login" action="{{ route('login') }}" method="POST">
				@csrf
				<h2 class="form-login-heading">CONNEXION</h2><br>
				<p class="centered"><a href="/"><img src="{{ asset('front/images/bg.JPG') }}" class="img-circle"
							width="199"></a>
				</p>

				<div class="login-wrap">
					<div class="form-group @error('email') has-error @enderror">
						<input type="text" name="email" class="form-control" value="{{ old('email') }}"
							placeholder="Adresse email">
						@error('email')
						<small class="text-danger mt-2">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group @error('password') has-error @enderror">
						<input type="password" name="password" class="form-control" placeholder="Mot de passe">
						@error('password')
						<small class="text-danger">{{ $message }}</small>
						@enderror
					</div>
					<br><input type="checkbox" name="remember"> Se souvenir de moi !<br><br>
					<input class="btn btn-theme btn-block" type="submit"><br>
					<a data-toggle="modal" data-target="#email-modal" href="#" id="psw-forgotten-btn">Mot de passe
						oublié?</a>
				</div>
			</form>
		</div>
	</div>
	{{-- Create user modal --}}
	<div id="email-modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Mot de passe oublié</h4>
				</div>
				<div class="modal-body">
					<p>Entrez votre adresse email et un lien de réinitialisation vous sera envoyé</p>
					<div class="form-group">
						<label for="email">Email:<sup class="text-danger">*</sup></label>
						<input type="email" id="email" class="form-control">
						<p id="email-error" class="text-danger"></p>
					</div>
				</div>
				<div class="modal-footer">
					<button id="send-link-btn" type="button" class="btn btn-primary">Envoyer</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
				</div>
			</div>
		</div>
	</div>
	<script src="{{ asset('front/assets/js/jquery.js') }}"></script>
	<script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('front/assets/js/jquery.backstretch.min.js') }}"></script>
	<script src="{{ asset('mazer/assets/vendors/toastify/toastify.js') }}"></script>
	<script>
		$.backstretch("{{ asset('front/images/test.png') }}", {speed: 1000});
		$(function(){
			token = $('meta[name="csrf-token"]').attr('content');
			$('#send-link-btn').on('click', sendLink);
			$('#email-modal').on('hide.bs.modal', removeError);
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': token
				}
			});
		});

    function sendLink()
    {
		removeError();
		let email = $('#email').val();
		$.ajax({
			url: "{{ route('password.email') }}",
			method: "POST",
			data: {email: email},
			success: function(response){
				$('#email-modal').modal('hide');
				Toastify({
				text: "Consultez votre messagerie, un lien de réinitialisation a été envoyé!",
				duration: 5000,
				close:true,
				gravity:"top",
				position: "right",
				backgroundColor: "#4fbe87",
				}).showToast();
			},
			error: function(response){
				errors = response.responseJSON.errors;
				$('#email').closest('.form-group').addClass('has-error');
				$('#email-error').text(errors.email[0]);
			}
		});
    }

	function removeError()
	{
		$('#email').closest('.form-group').removeClass('has-error');
		$('#email-error').text('');
	}
	</script>
</body>

</html>
