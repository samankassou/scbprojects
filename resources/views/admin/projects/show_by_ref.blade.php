
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/dist/css/bootstrap.min.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/style.css') }}">

    <title>Projet: {{ $project->reference }}</title>
    <style>
        .arrow {
        margin-bottom: 4px;
        }

        .arrow.back {
        text-align: right;
        }

        .inner-arrow {
        padding-right: 10px;
        height: 30px;
        display: inline-block;
        background-color: rgb(233, 125, 49);
        text-align: center;

        line-height: 30px;
        vertical-align: middle;
        }

        .arrow.back .inner-arrow {
        background-color: #ffbf06;
        padding-right: 0;
        padding-left: 10px;
        }

        .arrow:before,
        .arrow:after {
        content:'';
        display: inline-block;
        width: 0; height: 0;
        border: 15px solid transparent;
        vertical-align: middle;
        }

        .arrow:before {
        border-top-color: rgb(233, 125, 49);
        border-bottom-color: rgb(233, 125, 49);
        border-right-color: rgb(8, 8, 8);
        }


        .arrow:after {
        border-left-color: rgb(233, 125, 49);
        }

        .arrow.back:after {
        border-left-color: rgb(5, 5, 5);
        border-top-color: rgb(233, 125, 49);
        border-bottom-color: rgb(233, 125, 49);
        border-right-color: transparent;
        }

        .arrow span {
        display: inline-block;
        width: 80px;
        margin-right: 20px;
        text-align: right;
        }

        .arrow.back span {
        margin-right: 0;
        margin-left: 20px;
        text-align: left;
        }

        h1 {
        color: #5D6975;
        font-family: Junge;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        border-top: 1px solid #5D6975;
        border-bottom: 1px solid #5D6975;
        margin: 0 0 2em 0;
        }

        h1 small {
        font-size: 0.45em;
        line-height: 1.5em;
        float: left;
        }

        h1 small:last-child {
        float: right;
        }

        #project {
        float: left;
        }

        #company {
        float: right;
        }
    </style>
</head>
<body>
    <div class="my-5 page" size="A4">
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid">
                </div><br><br>
                <div class="top-left">
                    <div id="company">
                        <div class="arrow back"><div class="inner-arrow"><strong>SCB Cameroun Tel:</strong>  <span>699987676</span></div></div>
                        <div class="arrow back"><div class="inner-arrow"><strong> Ref: </strong>{{ $project->reference }}</div></div>

                      </div>

                </div>
            </section>
            <section class="top-content bb d-flex justify-content-between">
                <div class="top-left">
                    <h4><strong>Nom du Projet:</strong></h4><h2>{{ $project->name }}</h2>
                </div>
            </section>
            <section class="store-user mt-5">
                <div class="col-10">
                    <div class="row bb pb-3">
                            <p><strong> Date du Début et de la Fin:&nbsp; </strong><span>{{ $project->start_date->format('d/m/Y') }} - {{ $project->end_date->format('d/m/Y') }}</span></p>
                    </div>
                    <div class="row extra-info pt-3">
                            <p class="m-0 font-weight-bold"><strong>Description:</strong></p>
                            <p>{{ $project->description }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Sponsort/AMOA: &nbsp;</strong></p>
                        <p>{{ $project->sponsor }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Nature(s): &nbsp;</strong></p>
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
                        <p class="m-0 font-weight-bold"><strong>AMOA: &nbsp;</strong></p>
                        <p>{{ $project->amoa }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>MOE: &nbsp;</strong></p>
                        <p>{{ $project->moe }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Chef du Projet: &nbsp;</strong></p>
                        <p>{{ $project->manager }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Coût du projet: &nbsp;</strong></p>
                        <p> <strong>{{ number_format($project->cost, 0, '.', ' ') }} &nbsp; </strong>FCFA</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Statut du projet: &nbsp;</strong></p>
                        <p>{{ $project->status }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Gains/Impact: &nbsp;</strong></p>
                        <p>{{ $project->benefits }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Documentation du projet: &nbsp;</strong></p>
                        <p>{{ $project->documentation }}</p>
                    </div>
            <div class="row extra-info pt-3">
                <p class="m-0 font-weight-bold"><strong>Factures: &nbsp;</strong></p>
                <p>{{ $project->bills }}</p>
            </div>
            </div>
            </section>
        </div>
    </div>
</body>

