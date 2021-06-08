
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/dist/css/bootstrap.min.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/style.css') }}">

    <title>Projet: {{ $project->reference }}</title>
</head>
<body>
    <div class="my-5 page" size="A4">
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid">
                </div>
                <div class="top-left">
                    <div class="graphic-path">
                        <p>Ref-No:</p>
                    </div>
                    <div class="position-relative">
                        <p><span>{{ $project->reference }}</span></p>
                    </div>
                </div>
            </section>
            <section class="top-content bb d-flex justify-content-between">
                <div class="top-left">
                    <h4><strong>Nom du Projet:</strong> </h4><h2> {{ $project->name }}</h2>
                </div>
            </section>
            <section class="store-user mt-5">
                <div class="col-10">
                    <div class="row bb pb-3">
                            <p><strong> Date Début - Fin: </strong><span>{{ $project->start_date->format('d/m/Y') }} - {{ $project->end_date->format('d/m/Y') }}</span></p>
                    </div>
                    <div class="row extra-info pt-3">
                            <p class="m-0 font-weight-bold"><strong>Description:</strong> </p>
                            <p>{{ $project->description }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Sponsort/AMOA:&nbsp;&nbsp; </strong></p>
                        <p>{{ $project->sponsor }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Nature(s):&nbsp;&nbsp; </strong></p>
                        <p>
                            @foreach ($project->natures as $nature)
                                @if (!$loop->last)
                                {{ $nature->name }},
                                @else
                                {{ $nature->name }}
                                @endif
                            @endforeach
                        </p>
                    </div>

                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Etape(s) réalisée(s): </strong></p>
                        <ul>
                            @foreach ($project->steps as $step)
                            <li>{{ $step->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>AMOA:&nbsp;&nbsp;</strong></p>
                        <p>{{ $project->amoa }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>MOE:&nbsp;&nbsp;</strong></p>
                        <p>{{ $project->moe }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Chef de Projet:&nbsp;&nbsp;</strong></p>
                        <p>{{ $project->manager }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Coût du projet:&nbsp;&nbsp;</strong></p>
                        <p>FCFA <strong>{{ number_format($project->cost, 0, '.', ' ') }}</strong></p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Statut du projet:&nbsp;&nbsp;</strong></p>
                        <p>{{ $project->status }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Gains/Impact:&nbsp;&nbsp;</strong></p>
                        <p>{{ $project->benefits }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Documentation du projet:&nbsp;&nbsp;</strong></p>
                        <p>{{ $project->documentation }}</p>
                    </div>
            <div class="row extra-info pt-3">
                <p class="m-0 font-weight-bold"><strong>Factures:&nbsp;&nbsp;</strong></p>
                <p>{{ $project->bills }}</p>
            </div>
            </div>
            </section>
        </div>
    </div>
</body>

