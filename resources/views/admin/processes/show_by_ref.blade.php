
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/dist/css/bootstrap.min.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/style.css') }}">

    <title>Procédure {{ $process->reference }}</title>
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
                        <p><span>{{ $process->reference }}</span></p>
                    </div>
                </div>
            </section>
            <section class="top-content bb d-flex justify-content-between">
                <div class=" ">
                    <h4><strong>Domaine:</strong></h4><h2 style="text-indent: 4em;"> {{ $process->method->macroprocess->domain->name }}</h2>
                </div>
            </section>
            <section class="store-user mt-5">
                <div class="top-left">
                    <div class="row bb pb-3">
                            <p><strong> Macroprocessus:&nbsp;</strong><span><h5> {{ $process->method->macroprocess->name }}</h5></span></p>
                    </div>
                    <div class="row extra-info pt-3">
                            <p class="m-0 font-weight-bold"><strong>Processus:</strong></p>
                            <p>{{ $process->method->name }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Intitulé:</strong></p>
                        <p>{{ $process->name }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Type:</strong></p>
                        <p>{{ $process->type }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>No. de version:</strong></p>
                        <p>{{ $process->version }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Pôle(s):</strong></p>
                        <p></p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Entité(s) impactée(s):</strong></p>
                        <p>{{ implode(', ', $process->entities->pluck('name')->toArray()) }}</p>
                    </div>
                    
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Céée le:</strong></p>&nbsp;
                        <p> {{ $process->creation_date->format('d/m/Y') }}</p><strong style="text-indent: 2em;" > Par:</strong></p>&nbsp;<p> {{ $process->created_by }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Redigée le:</strong></p>&nbsp;
                        <p>{{ $process->writing_date->format('d/m/Y') }}</p><strong style="text-indent: 2em;" > Par:</strong></p>&nbsp;<p>{{ $process->written_by }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Validéé le:</strong></p>&nbsp;
                        <p>{{ $process->verification_date->format('d/m/Y') }}</p><strong style="text-indent: 2em;" > Par:</strong></p>&nbsp;<p>{{ $process->verified_by }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Aprouvée le:</strong></p>&nbsp;
                        <p>{{ $process->date_of_approval->format('d/m/Y') }}</p><strong style="text-indent: 2em;" > Par:</strong></p>&nbsp;<p>{{ $process->approved_by }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Etat:</strong></p>&nbsp;
                        <p>{{ $process->status }}</p><strong style="text-indent: 2em;" ></p> 
                            
                            <p><strong>Raison de la création</strong></p><p>{{ $process->reasons_for_creation }}</p>
                            <p><strong>Raison de la modification</strong></p><p>{{ $process->reasons_for_modification }}</p>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Modification(s) apportée(s):</strong></p>
                        <p>{{ $process->modifications }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Annexe(s):</strong></p>
                        <p>{{ $process->appendices }}</p>
                    </div>
            

            </div>
            </section>
        </div>
    </div>
</body>

