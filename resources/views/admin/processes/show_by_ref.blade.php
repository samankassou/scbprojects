<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/dist/css/bootstrap.min.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/style.css') }}">
    <title>Procédure {{ $process->reference }}</title>
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
                        <div class="inner-arrow"><strong> Ref: </strong>{{ $process->reference }}</div>
                    </div>
                </div>
            </section>
            <div class="bb mt-3">
                <p>
                    <span class="font-weight-bold">Domaine:</span>
                    {{ $process->method->macroprocess->domain->name }}
                </p>
            </div>
            <div class="bb mt-3">
                <p>
                    <span class="font-weight-bold">Macroprocessus:</span>
                    {{ $process->method->macroprocess->name }}
                </p>
            </div>
            <div class="bb mt-3">
                <p>
                    <span class="font-weight-bold">Processus:</span>
                    {{ $process->method->name }}
                </p>
            </div>
            <div class="bb mt-3">
                <p>
                    <span class="font-weight-bold">Procédure:</span>
                    {{ $process->last_version->name }}
                </p>
            </div>
            <section class="mt-3">
                <p class="mt-3">
                    <span class="font-weight-bold">Type:</span>
                    {{ $process->last_version->type }}
                </p>
                <p class="mt-3">
                    <span class="font-weight-bold">No. de version:</span>
                    {{ $process->last_version->version }}
                </p>
                <p class="mt-3">
                    <span class="font-weight-bold">Pôle(s):</span>
                    {{ implode(', ', $poles->pluck('name')->toArray()) }}
                </p>
                <p class="mt-3">
                    <span class="font-weight-bold">Entité(s) impactée(s):</span>
                    {{ implode(', ', $process->last_version->entities->pluck('name')->toArray()) }}
                </p>
                <div class="row justify-content-between mt-3">
                    <div class="col-md-6">
                        <p>
                            <span class="font-weight-bold"> Céée le:</span>
                            {{ $process->last_version->creation_date->format('d/m/Y') }}
                        </p>
                        <p class="mt-3">
                            <span class="font-weight-bold"> Redigée le:</span>
                            {{ $process->last_version->writing_date->format('d/m/Y') }}
                        </p>
                        <p class="mt-3">
                            <span class="font-weight-bold"> Vérifiée le:</span>
                            {{ $process->last_version->verification_date->format('d/m/Y') }}
                        </p>
                        <p class="mt-3">
                            <span class="font-weight-bold"> Aprouvée le:</span>
                            {{ $process->last_version->date_of_approval->format('d/m/Y') }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <span class="font-weight-bold">Créée Par:</span>
                            {{ $process->last_version->created_by }}
                        </p>
                        <p class="mt-3">
                            <span class="font-weight-bold">Rédigée Par:</span>
                            {{ $process->last_version->written_by }}
                        </p>
                        <p class="mt-3">
                            <span class="font-weight-bold">Vérifiée Par:</span>
                            {{ $process->last_version->verified_by }}
                        </p>
                        <p class="mt-3">
                            <span class="font-weight-bold">Approuvée Par:</span>
                            {{ $process->last_version->approved_by }}
                        </p>
                    </div>
                </div>
                <div class="mt-3">
                    <p>
                        <span class="font-weight-bold">Etat:</span>
                        {{ $process->last_version->state }}
                    </p>
                    <p class="mt-3">
                        <span class="font-weight-bold">Statut:</span>
                        {{ $process->last_version->status }}
                    </p>
                    <p class="mt-3">
                        <span class="font-weight-bold">Raison de la création:</span>
                        {{ $process->last_version->reasons_for_creation }}
                    </p>
                    <p class="mt-3">
                        <span class="font-weight-bold">Raison de la modification:</span>
                        {{ $process->last_version->reasons_for_modification }}
                    </p>
                    <p class="mt-3">
                        <span class="font-weight-bold">Modification(s) apportée(s):</span>
                        {{ $process->last_version->modifications }}
                    </p>
                    <p class="mt-3">
                        <span class="font-weight-bold">Annexe(s):</span>
                        {{ $process->last_version->appendices }}
                    </p>
                </div>
            </section>
        </div>
    </div>
</body>