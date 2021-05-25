
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="./icon/2.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>SCB Cameroun</title>
    <!-- fevicon -->
  <link rel="icon" href="{{ asset('front/icon/2.jpg') }}" type="image/gif" />
    <link href="{{ asset('front/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('front/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/assets/css/style-responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('front/assets/css/styls.css') }}" rel="stylesheet">
  </head>

  <body>
	  <div id="login-page">
	  	<div class="container"> 	
          <form class="form-login" action="{{ route('login') }}" method="POST">
            @csrf
		        <h2 class="form-login-heading">CONNEXION</h2><br>
                    <p class="centered"><a href="/"><img src="{{ asset('front/images/3.jpg') }}" class="img-circle" width="199"></a></p>
            
		        <div class="login-wrap">
		            <div class="form-group @error('email') has-error @enderror">
                  <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Adresse email" autofocus>
                  @error('email')
                    <p class="text-center text-danger mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group @error('password') has-error @enderror">
                  <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                  @error('password')
                    <p class="text-center text-danger">{{ $message }}</p>
                  @enderror
                </div>
		            <br><input type="checkbox" name="remember"> Ce souvenir de moi !<br><br>
		            <input class="btn btn-theme btn-block" type="submit">
		        </div>
		      </form>	  	
	  	
	  	</div>
	  </div>
    <script src="{{ asset('front/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front/assets/js/jquery.backstretch.min.js') }}"></script>
    <script>
        $.backstretch("{{ asset('front/images/test.png') }}", {speed: 1000});
    </script>


  </body>
</html>
