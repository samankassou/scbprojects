<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title??'inconnu' }} - SCB Cameroun</title>
    <!-- favicon -->
    <link rel="icon" href="{{ asset('front/icon/2.jpg') }}" type="image/gif" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('mazer/assets/css/bootstrap.css') }}">
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('mazer/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/vendors/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('mazer/assets/images/favicon.svg') }}" type="image/x-icon">
    <style>
        /*---------------------------- preloader area ----------------------------*/
        .loader_bg {
            position: fixed;
            z-index: 9999999;
            background: #fff;
            width: 100%;
            height: 100%;
        }

        .loader {
            height: 100%;
            width: 100%;
            position: absolute;
            left: 0;
            top: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader img {
            width: 280px;
        }
    </style>
</head>

<body>
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="{{ asset('mazer/assets/vendors/svg-loaders/ball-triangle.svg') }}" class="me-4"
                style="width: 3rem" alt="audio"></div>
    </div>
    <!-- end loader -->
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="/"><img class="w-100 h-100" src="{{ asset('images/logo.png') }}" alt="Logo"></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Tableau de bord</span>
                            </a>
                        </li>

                        @permission('view-projects')
                        <li class="sidebar-item  has-sub {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Projets</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                                <li
                                    class="submenu-item {{ request()->routeIs('admin.projects.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.projects.index') }}">Liste des Projets</a>
                                </li>
                                @permission('create-project')
                                <li
                                    class="submenu-item {{ request()->routeIs('admin.projects.create') ? 'active' : '' }}">
                                    <a href="{{ route('admin.projects.create') }}">Créer un Projet</a>
                                </li>
                                @endpermission
                                <li
                                    class="submenu-item {{ request()->routeIs('admin.projects.deleted.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.projects.deleted.index') }}">Projets Supprimés</a>
                                </li>
                            </ul>
                        </li>
                        @endpermission


                        @permission('view-processes')
                        <li class="sidebar-item  has-sub {{ request()->routeIs('admin.processes.*') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Procédures</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('admin.processes.*') ? 'active' : '' }}">
                                <li
                                    class="submenu-item {{ request()->routeIs('admin.processes.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.processes.index') }}">Liste des Procédures</a>
                                </li>
                                @permission('create-process')
                                <li
                                    class="submenu-item {{ request()->routeIs('admin.processes.create') ? 'active' : '' }}">
                                    <a href="{{ route('admin.processes.create') }}">Créer une Procédure</a>
                                </li>
                                @endpermission
                                @permission('viewDeleted-process')
                                <li
                                    class="submenu-item {{ request()->routeIs('admin.processes.deleted.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.processes.deleted.index') }}">Procédures Supprimées</a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission


                        @role('admin')
                        <li class="sidebar-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.users.index') }}" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Liste des Utilisateurs</span>
                            </a>
                        </li>
                        @endrole

                        @permission('manage-account')
                        <li class="sidebar-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('admin.settings') }}">
                                <i class="icon-mid bi bi-gear-fill"></i>
                                <span>Parametres</span>
                            </a>
                        </li>
                        @endpermission

                        <li class="sidebar-item">
                            <a onclick="event.preventDefault();document.getElementById('logoutForm').submit();"
                                class="sidebar-link" href="#">
                                <i class="icon-mid bi bi-box-arrow-left"></i>
                                <span>Se déconnecter</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#">
                                <i class="icon-mid bi bi-question"></i>
                                <span>Guide</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main" class='layout-navbar'>
            <header class='mb-3'>
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">{{ auth()->user()->name }}</h6>
                                            <p class="mb-0 text-sm text-gray-600">
                                                {{ auth()->user()->roles[0]->display_name }}</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="{{ asset('images/user.svg') }}">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">Bonjour, {{ auth()->user()->name }}!</h6>
                                    </li>
                                    <li><a onclick="event.preventDefault();document.getElementById('logoutForm').submit();"
                                            class="dropdown-item" href="#"><i
                                                class="icon-mid bi bi-box-arrow-left me-2"></i> Se déconnecter</a></li>
                                    <form id="logoutForm" action="{{ route('logout') }}" method="POST"
                                        style="display: none">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>{{ $title }}</h3>
                                <p class="text-subtitle text-muted">{{ $description ?? "" }}</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">SCB Cameroun</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2021 &copy; SCB Cameroun</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script src="{{ asset('mazer/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('mazer/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/jquery-3.5.1.js') }}"></script>
    @yield('scripts')
    <script src="{{ asset('mazer/assets/js/main.js') }}"></script>
    <script>
        setTimeout(function () {
            $('.loader_bg').fadeToggle();
        }, 1500);
    </script>
</body>

</html>