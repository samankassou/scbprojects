<!DOCTYPE html>
<html lang="en">

<head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title>SCB Cameroun</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- fevicon -->
  <link rel="icon" href="{{ asset('front/icon/2.jpg') }}" type="image/gif" />
  <!-- bootstrap css -->
  <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
  <!-- style css -->
  <link rel="stylesheet" href="{{ asset('front/css/styles.css') }}">
  <!-- Responsive-->
  <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="{{ asset('front/css/jquery.mCustomScrollbar.min.css') }}">

  <style type="text/css">
    html {
      font-size: 12px !important;
    }

    .bttn a:link,
    a:visited {
      background-color: #f44336;
      color: white;
      padding: 14px 25px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
    }


    a:hover,
    a:active {
      background-color: red;
    }

    table {
      font-family: sans-serif;
      width: 100%;
    }

    td,
    th {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>

</head>
<!-- body -->

<body>
  <!-- loader  -->
  <div class="loader_bg">
    <div class="loader"><img src="{{ asset('front/images/loading.gif') }}" alt="#" /></div>
  </div>
  <!-- end loader -->
  <!-- header -->
  <header class="main-layout">
    <!-- header inner -->
    <div class="header-top">
      <div class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-3 col logo_section">
              <div class="full">
                <div class="center-desk">
                  <div class="logo">
                    <a href="/"><img src="{{ asset('images/logo.png') }}" style="height: 55px" alt="#" /></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-9">

              <div class="menu-area">
                <div class="limit-box">
                  <nav class="main-menu ">
                    <ul class="menu-area-main">
                      <li class="active"> <a href="/">Acceuil</a> </li>
                      @guest
                      <li> <a href="{{ route('login') }}">Connexion</a> </li>
                      <li> <a href="{{ route('login') }}"><img src="{{ asset('front/icon/logos.png') }}"
                            alt="login" /></a></li>
                      @endguest
                      @auth
                      <li> <a href="{{ route('dashboard') }}">Tableau de bord</a> </li>
                      @endauth
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end header inner -->

    <!-- end header -->
    <section>
      <div>
        <div class="carousel-inner">
          <div class="container-fluid padding_dd">
            <div class="carousel-caption">
              <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                  <div class="text-bg">
                    <span>ORGANISATION ET PROJETS</span>
                    <hr>
                    <p style="text-align: center"><strong>Choisir l'option de la Recherche</strong></p>
                    <form id="search-form" class="Vegetable" style="display: none">
                      <input id="search-input" class="Vegetable_fom" placeholder="Saisir la R??f??rence du Projet"
                        type="text" name=" Recherche">
                      <button class="Search_btn">Recherche </button>
                    </form>
                    <form id="search-form1" class="Vegetable" style="display: none">
                      <input id="search-input1" class="Vegetable_fom" placeholder="Saisir la R??f??rence de la proc??dure"
                        type="text" name=" Recherche">
                      <button class="Search_btn">Recherche </button>
                    </form>
                    <a href="/" id="d3" style="display: none">Retour</a><br>
                    <div id="result">
                      <button id="d1" class="Search_btn" type="button" onclick="myFunction()">Rechercher
                        Projet</button>&nbsp;&nbsp;
                      <button id="d2" class="Search_btn" type="button" onclick="mFunction()"
                        style="float: right">Rechercher Proc??dure</button>
                      <hr>
                      <h1 class="btn">SCB Cameroun</h1>
                      <p>Lorem ipsum dolor sit am et, consec tetur adipi scing elit. Sed
                        sodales enim ut rhoncus lorem ipsum ese terds. Lorem ipsum dolor sit
                        am et, consec tetur adipi scing elit. Sed sodales enim ut rhoncus . </p>
                    </div>
                  </div>
                  <hr>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                  <div class="images_box">
                    <figure><img src="{{ asset('front/images/bg.JPG') }}"></figure><br>
                    <div class="bttn">
                      <span>Connexion:</span><br><br>
                      <a href="{{ route('admin.processes.index') }}">Gestion Process</a>&nbsp;<a
                        href="{{ route('admin.projects.index') }}">Gestion Projets</a>
                      <hr>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </header>
  <!--  footer -->
  <footer>
    <div class="footer ">
      <div class="copyright">
        <div class="container">
          <p>Copyright ?? 2021 SCB Cameroun <a href="scbcameroun.net">All right reserved </a></p>
        </div>
      </div>
    </div>
  </footer>
  <!-- end footer -->


  <!-- Javascript files-->
  <script src="{{ asset('front/js/jquery.min.js') }}"></script>
  <script src="{{ asset('front/js/popper.min.js') }}"></script>
  <script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('front/js/plugin.js') }}"></script>
  <!-- sidebar -->
  <script src="{{ asset('front/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
  <script src="{{ asset('front/js/custom.js') }}"></script>
  <script>
    $(function(){
      $('#search-form').on('submit', function(e){
        e.preventDefault();
        let searchWord = $('#search-input').val();
        if(searchWord.length > 2){
          $.ajax({
            url: '/projects/search/'+searchWord,
            success: function(response){
              if(response.success){
                let project = response.project;
                let start_date = new Date(project.start_date);
                let end_date = new Date(project.end_date);
                let html = `
                  <div class="card">
                    <div class="card-content">
                      <div class="card-body">
                        <h2 class="card-title" style="text-align: center; text-decoration-color: rgb(0, 0, 0)"><strong>Resultat de la recherche</strong></h2>
                        <h4 class="card-title" style= "text-align: center;">
                          <div style= "text-align: left;"><strong>Nom du Projet:</strong><br></div>
                          ${project.name}
                        </h4>
                        <h4 class="card-title" style= "text-align: center;">
                          <div style= "text-align: left;"><strong>Chef du Projet:</strong><br></div>
                          ${project.manager}
                        </h4>
                        <h4 class="card-title" style= "text-align: center;">
                          <div style= "text-align: left;"><strong>Description du Projet:</strong><br></div>
                          ${project.description}
                        </h4>
                        <h4 class="card-title" style= "text-align: center;">
                          <div style= "text-align: left;"><strong>Dates de D??but et de Fin:</strong><br></div>
                          ${start_date.toLocaleDateString()}  /  ${end_date.toLocaleDateString()}
                        </h4>
                      </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <span><button class="btn btn-light-primary"><a target="_blank" href="/projects/show/${project.reference}">Ouvrir</a></button></span>
                        <button class="btn btn-light-primary"><a target="_blank" href="/projects/export/${project.reference}">Imprimer</a></button>
                    </div>
                  </div>
                    `;
                  $('#result').html(html);

              }else{
                let html = `
                  <div class="d-flex justify-content-center align-items-center" style="width: 300px;">
                      <img class="img-fluid" src="{{ asset('front/images/9.jpg') }}" alt="#" />
                  </div>
                `;
                $('#result').html(html);
              }
            },
            error: function(response){
              console.log(response);
            }
          });
        }
      });
    });
  </script>

  <script>
    $(function(){
$('#search-form1').on('submit', function(e){
e.preventDefault();
let searchWord = $('#search-input1').val();
if(searchWord.length > 2){
  $.ajax({
    url: '/processes/search/'+searchWord,
    success: function(response){
      if(response.success){
        let processes = response.processes;
        let content = '';

        processes.forEach(process => {
          content += `
          <tr>
              <td><h2>${process.last_version.name}</h2> </td>
              <td><h2>${process.last_version.version}</h2></td>
              <td><h2>${process.last_version.status}</h2></td>
              <td><h2>${process.last_version.created_by}</h2></td>
              <td>
                  <button class="btn btn-light-primary"><a target="_blank" href="/processes/show/${process.reference}">Ouvrir</a></button>
                  <button class="btn btn-light-primary"><a target="_blank" href="/processes/export/${process.reference}">Imprimer</a></button>
              </td>
          </tr>
          `;
        });
        let html = `
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <h3 style="text-align: center;"><strong>Resultat de la recherche</strong></h3>
                    <table>
                    <tr>
                        <th style="width: 15px"><h2>Intitul??</h2></th>
                        <th><h2>Version</h2></th>
                        <th><h2>Satut</h2></th>
                        <th><h2>Cr????e par</h2></th>
                        <th><h2>Options</h2>s</th>
                    </tr>
                    ${content}
                    </table>
              </div>
            </div>
          </div>
            `;
          $('#result').html(html);

      }else{
        let html = `
          <div class="d-flex justify-content-center align-items-center" style="width: 300px;">
              <img class="img-fluid" src="{{ asset('front/images/9.jpg') }}" alt="#" />
          </div>
        `;
        $('#result').html(html);
      }
    },
    error: function(response){
      console.log(response);
    }
  });
}
});
});
  </script>

  <script>
    function myFunction() {
            var x = document.getElementById("search-form");
            var y = document.getElementById("search-form1");
            var a = document.getElementById("d1");
            var b = document.getElementById("d2");
            var c = document.getElementById("d3");
            if(x.style.display === "none"){
                x.style.display = "block";
                c.style.display = "block";
                y.style.display = "none";
                a.style.display = "none";
                b.style.display = "none";
            }
        }

        function mFunction() {
            var x = document.getElementById("search-form");
            var y = document.getElementById("search-form1");
            var a = document.getElementById("d1");
            var b = document.getElementById("d2");
            var c = document.getElementById("d3");
            if(y.style.display === "none"){
                x.style.display = "nones";
                y.style.display = "block";
                c.style.display = "block";
                a.style.display = "none";
                b.style.display = "none";
            }
        }
  </script>

</body>

</html>
