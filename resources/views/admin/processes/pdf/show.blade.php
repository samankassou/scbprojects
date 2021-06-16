<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/dst/css/bootstrap.min.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/stle.css') }}">

    <title>Procédure: {{ $process->reference }}</title>
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

        .logo img {
            height: 60px;
        }

        .top-left p {
            margin: 0;
        }

        #footer {
            position: fixed;
            right: 0;
            bottom: 0;
            color: #aaa;
            font-size: 0.9em;
            border-top: 0.1pt solid #aaa;
        }
    </style>
</head>

<body>
    <div id="footer">
        <div class="page-number"></div>
    </div>
    <div class="my-5 page" size="A4">
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid">
                    <div class="top-left" style="float: right">

                        <div class="graphic-path">
                            <div id="company">
                                <div class="arrow back">
                                    <div class="inner-arrow"><strong>No.Ref:&nbsp; {{ $process->reference }} </strong>
                                    </div>
                                </div>
                                <div class="arrow back">
                                    <div class="inner-arrow">SCB Cameroun Tel: XXXXXXXXXXXX</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section><br>
            <hr>
            <h2 style="text-align: center;"><strong>ORGANISATION ET PROJETS</strong></h2>
            <hr>
            <section class="top-content bb d-flex justify-content-between">
                <div class="top-left">
                    <h4><strong>Procédure:</strong></h4>&nbsp;&nbsp;&nbsp;&nbsp;<h2
                        style="text-align: center; text-decoration: underline;">{{ $process->name }}</h2>
                </div>
            </section>
            <section class="store-user mt-5">
                <div class="col-10">
                    <div class="row bb pb-3">
                        <p><strong>Domaine: </strong><span>{{ $process->method->macroprocess->domain->name }}</span></p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Macroprocessus:&nbsp;</strong></p>
                        <p>{{ $process->method->macroprocess->name }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Processus: </strong></p>
                        <p>{{ $process->method->name }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Intitulé: </strong></p>
                        <p>{{ $process->name }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Type: </strong></p>
                        <p>{{ $process->type }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>No. de version:</strong></p>
                        <p>{{ $process->version }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Pôle(s):</strong></p>
                        <p>{{ implode(', ', $poles->pluck('name')->toArray()) }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Entité(s) impactée(s):</strong></p>
                        <p>{{ implode(', ', $process->entities->pluck('name')->toArray()) }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Céée le:</strong></p>
                        <p>{{ $process->creation_date->format('d/m/Y') }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Redigée le:</strong></p>
                        <p>{{ optional($process->writing_date)->format('d/m/Y') }}.</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Vérifiée le:</strong></p>
                        <p>{{ optional($process->verification_date)->format('d/m/Y') }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Aprouvée le:</strong></p>
                        <p>{{ optional($process->date_of_approval)->format('d/m/Y') }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Etat:</strong></p>
                        <p>{{ $process->state }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Raison de la création</strong></p>
                        <p>{{ $process->reasons_for_creation }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Raison de la modification</strong></p>
                        <p>{{ $process->reasons_for_modifications }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Modification(s) apportée(s):</strong></p>
                        <p>{{ $process->modifications }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Annexe(s):</strong>
                            <p>{{ $process->appendices }}</p>
                        </p>

                    </div>
                </div>
            </section>
        </div>
    </div>
    <script type="text/php">
        if(isset($pdf)){
            $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
            $size = 10;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width);
            $y = ($pdf->get_height() - 30);
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>