<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/dist/css/bootstrap.min.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/style.css') }}">
    <title>Projet {{ $project->reference }}</title>
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
            content: '';
            display: inline-block;
            width: 0;
            height: 0;
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
    </style>
</head>

<body>
    <div class="my-5 page" size="A4">
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid">
                </div>
                <div>
                    <div class="arrow back">
                        <div class="inner-arrow"><strong> Ref: </strong>{{ $project->reference }}</div>
                    </div>
                </div>
            </section>
            <div class="bb mt-3">
                <p>
                    <span class="font-weight-bold">Projet:</span>
                    {{ $project->name }}
                </p>
            </div>
            <div class="bb mt-3">
                <p>
                    <span class="font-weight-bold">Date du D??but et de la Fin:</span>
                    {{ $project->start_date->format('d/m/Y') }} - {{ $project->end_date->format('d/m/Y') }}
                </p>
            </div>
            <section class="mt-3">
                <p class="mt-3">
                    <span class="font-weight-bold">Description:</span>
                    {{ $project->description }}
                </p>
                <p class="mt-3">
                    <span class="font-weight-bold">Sponsort/AMOA:</span>
                    {{ $project->sponsor }}
                </p>

                <p class="mt-3">
                    <span class="font-weight-bold">Nature(s):</span>
                    {{ implode(', ', $project->natures->pluck('name')->toArray()) }}
                </p>
                <p class="mt-3">
                    <span class="font-weight-bold">Etape(s) r??alis??e(s):</span>
                    {{ implode(', ', $project->steps->pluck('name')->toArray()) }}
                </p>
                <div class="mt-3">
                    <p>
                        <span class="font-weight-bold">AMOA:</span>
                        {{ $project->amoa }}
                    </p>
                    <p>
                        <span class="font-weight-bold">MOE:</span>
                        {{ $project->moe }}
                    </p>
                    <p class="mt-3">
                        <span class="font-weight-bold">Statut:</span>
                        {{ $project->status }}
                    </p>
                    <p class="mt-3">
                        <span class="font-weight-bold">Chef de projet:</span>
                        {{ $project->manager }}
                    </p>
                    <p class="mt-3">
                        <span class="font-weight-bold">Co??t du projet:</span>
                        <strong>{{ number_format($project->cost, 0, '.', ' ') }} &nbsp; </strong>FCFA
                    </p>
                    <p class="mt-3">
                        <span class="font-weight-bold">Statut du projet:</span>
                        {{ $project->status }}
                    </p>
                    <p class="mt-3">
                        <span class="font-weight-bold">Gains/Impact sur SCB:</span>
                        {{ $project->benefits }}
                    </p>
                    <p class="mt-3">
                        <span class="font-weight-bold">Documentation du projet:</span>
                        {{ $project->documentation }}
                    </p>
                    <p class="mt-3">
                        <span class="font-weight-bold">Factures:</span>
                        {{ $project->bills }}
                    </p>
                </div>
            </section>
        </div>
    </div>
</body>