<!DOCTYPE html>
<html lang="en">

<head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="./icon/2.jpg">
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
  <link rel="stylesheet" href="{{ asset('front/css/styls.css') }}">
  <!-- Responsive-->
  <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">  
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="{{ asset('front/css/jquery.mCustomScrollbar.min.css') }}">

  <style type="text/css">
    
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
                    <a href="index.php"><img src="{{ asset('front/images/4.png') }}" alt="#" /></a>
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
                      <li> <a href="{{ route('login') }}">Connexion</a> </li>
                     
                     <li> <a href="{{ route('login') }}"><img src="{{ asset('front/icon/logos.png') }}" alt="login.php" /></a></li>
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
     <section >
        <div>        
        <div class="carousel-inner">
            <div class="container-fluid padding_dd">
              <div class="carousel-caption">
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="text-bg">
                     <span>ORGANISATION ET PROJETS</span><hr>
                          <form class="Vegetable">
                          <input class="Vegetable_fom" placeholder="Saisir la Référence du Projet" type="text" name=" Recherche">
                          <button class="Search_btn">Recherche </button> 
                          </form>
                           <a href="{{ route('admin.processes.index') }}">Gestion Process</a> <a href="{{ route('admin.projects.index') }}">Gestion Projets</a><hr>
                          <h1 class="btn">SCB Cameroun</h1>
                          <p>Lorem ipsum dolor sit am et, consec tetur adipi scing elit. Sed
                              sodales enim ut rhoncus lorem ipsum ese terds. Lorem ipsum dolor sit
                              am et, consec tetur adipi scing elit. Sed sodales enim ut rhoncus . </p>
                        </div><hr>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                       <div class="images_box">
                      <figure><img src="{{ asset('front/images/1.png') }}"></figure>
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
                  <p>Copyright © 2021 SCB Cameroun <a href=" ">All right reserved </a></p>
                </div>
              </div>
            </div>
          </footer>
          <!-- end footer -->


          <!-- Javascript files-->
          <script src="{{ asset('front/js/jquery.min.js') }}"></script>
          <script src="{{ asset('front/js/popper.min.js') }}"></script>
          <script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
          <script src="{{ asset('front/js/jquery-3.0.0.min.js') }}"></script>
          <script src="{{ asset('front/js/plugin.js') }}"></script>
          <!-- sidebar -->
          <script src="{{ asset('front/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
          <script src="{{ asset('front/js/custom.js') }}"></script>


</body>

</html>