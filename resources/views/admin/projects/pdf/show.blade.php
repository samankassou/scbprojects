<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Projet {{ $project->reference }}</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .bb {
            border-bottom: 3px solid #ccc;
        }

        .progress {
            background-color: #000;
            border-radius: 8px;
            padding: 3px;
        }

        .progress>div {
            background-color: #ffbf06;
            height: 20px;
            border-radius: 8px;
        }

        .progress>div {
            text-align: center;
        }

        /* Top Section */
        .top-content {
            padding-bottom: 15px;
        }

        .logo img {
            height: 60px;
        }

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
    <div>
        <section class="row bb">
            <div class="logo col-md-6">
            </div>
            <div class="float-right">
                <div class="arrow back">
                    <div class="inner-arrow"><strong> Ref: </strong>{{ $project->reference }}</div>
                </div>
            </div>
        </section>
        <div class="bb"></div>
        <div class="bb mt-3">
            <h3 class="text-center">
                ORGANISATION ET PROJETS
            </h3>
        </div>
        <div class="mt-3">
            <p>
                <span class="font-weight-bold">Projet:</span>
                {{ $project->name }}
            </p>
        </div>
        <div class="mt-3">
            <p>
                <span class="font-weight-bold">Date Début - Date Fin:</span>
                {{ $project->start_date->format('d/m/Y') }} - {{ optional($project->end_date)->format('d/m/Y') }}
            </p>
        </div>
        <div class="mt-3">
            <p>
                <span class="font-weight-bold">Progression:</span>
                <div class="progress">
                    <div style="width: {{ $project->progress }}%">
                        <span>{{ $project->progress }}%</span>
                    </div>
                </div>
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
                <span class="font-weight-bold">Etape(s) réalisée(s):</span>
                <ul>
                    @foreach ($project->steps as $step)
                    <li>{{ $step->name }}</li>
                    @endforeach
                </ul>
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
                    <span class="font-weight-bold">Coût du projet:</span>
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
