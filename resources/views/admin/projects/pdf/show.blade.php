
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/dst/css/bootstrap.min.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap-4.0.0/stle.css') }}">

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

.logo img {
    height: 60px;
}

.top-left p {
    margin: 0;
}
#footer{
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
                    <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid">
                    <div class="top-left" style="float: right">

                    <div class="graphic-path">
                             <div id="company">
                                <div class="arrow back"><div class="inner-arrow"><strong>No.Ref:&nbsp; {{ $project->reference }}</strong></div></div>
                                <div class="arrow back"><div class="inner-arrow">SCB Cameroun Tel: XXXXXXXXXXXX</div></div>
                              </div>
                    </div>
                </div>
                </div>

            </section><br><hr><h2 style="text-align: center;"><strong>ORGANISATION ET PROJETS</strong></h2><hr>
            <section class="top-content bb d-flex justify-content-between">
                <div class="top-left">
                    <h4><strong>Nom du Projet:</strong></h4>&nbsp;&nbsp;&nbsp;&nbsp;<h2 style="text-align: center; text-decoration: underline;">  {{ $project->name }}</h2>
                </div>
            </section>
            <section class="store-user mt-5">
                <div class="col-10">
                    <div class="row bb pb-3">
                            <p><strong> Date Début - Fin: </strong><span>{{ $project->start_date->format('d/m/Y') }} - {{ $project->end_date->format('d/m/Y') }}</span></p>
                    </div>
                    <div class="row extra-info pt-3">
                            <p class="m-0 font-weight-bold"><strong>Description:</strong></p>
                            <p>{{ $project->description }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Sponsort/AMOA: </strong></p>
                        <p>{{ $project->sponsor }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>Nature(s): </strong></p>
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
                        <p class="m-0 font-weight-bold"><strong>Etape(s) réailisée(s): </strong></p>
                        <ul>
                            @forelse ($project->steps as $step)
                            <li>{{ $step->name }}</li>
                            @empty
                            <p>Aucune</p>
                            @endforelse
                        </ul>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>AMOA:</strong></p>
                        <p>{{ $project->amoa }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong>MOE:</strong></p>
                        <p>{{ $project->moe }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Chef de Projet:</strong></p>
                        <p>{{ $project->manager }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Coût du projet:</strong></p>
                        <p>FCFA <strong>{{ number_format($project->cost, 0, '.', ' ') }}</strong></p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Statut du projet:</strong></p>
                        <p>{{ $project->status }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Gains/Impact sur SCB:</strong></p>
                        <p>{{ $project->benefits }}</p>
                    </div>
                    <div class="row extra-info pt-3">
                        <p class="m-0 font-weight-bold"><strong> Documentation du projet:</strong></p>
                        <p>{{ $project->documentation }}</p>
                    </div>
            <div class="row extra-info pt-3">
                <p class="m-0 font-weight-bold"><strong>Factures:</strong></p>
                <p>{{ $project->bills }}</p>
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
