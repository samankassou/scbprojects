<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Procédure: {{ $process->reference }}</title>
    <style>
        /* Global styles */
        body {
            font-family: sans-serif;
            font-size: 14px;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        section {
            margin-top: 3rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
        }

        .flex {
            display: flex;
        }

        .justify-center {
            justify-content: center;
        }

        .align-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .text-center {
            text-align: center;
        }

        .underline {
            text-decoration: underline;
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
    <section>
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" class="img-fluid">
            <div style="float: right">
                <div>
                    <div id="company">
                        <div class="arrow back">
                            <div class="inner-arrow"><strong>No.Ref:&nbsp; {{ $process->reference }} </strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <P class="text-center underline">PROCEDURE</P>
        <h3 class="text-center">{{ $process->last_version->name }}</h3>
    </section>
    <section>
        <table>
            <tr>
                <td><strong>Entité(s) impactée(s):</strong></td>
                <td>{{ implode(', ', $process->last_version->entities->pluck('name')->toArray()) }}</td>
            </tr>
            <tr>
                <td><strong>Domaine d'activé:</strong></td>
                <td>{{ $process->method->macroprocess->domain->name }}</td>
            </tr>
            <tr>
                <td><strong>Référence de la procédure:</strong></td>
                <td>{{ $process->reference }}</td>
            </tr>
            <tr>
                <td><strong>Version courante:</strong></td>
                <td>{{ $process->last_version->version }}</td>
            </tr>
            <tr>
                <td><strong>Date de création:</strong></td>
                <td>{{ $process->last_version->creation_date->format('d/m/Y') }}</td>
            </tr>
        </table>
    </section>
    <section>
        <table>
            <tr>
                <td style="border: none"></td>
                <td><strong>Nom(s)</strong></td>
                <td><strong>Date</strong></td>
            </tr>
            <tr>
                <td><strong>Rédacteur(s)</strong></td>
                <td>{{ $process->last_version->written_by }}</td>
                <td>{{ optional($process->last_version->writing_date)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td><strong>Vérificateur(s)</strong></td>
                <td>{{ $process->last_version->verified_by }}</td>
                <td>{{ optional($process->last_version->verification_date)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td><strong>Approbateur(s)</strong></td>
                <td>{{ $process->last_version->approved_by }}</td>
                <td>{{ optional($process->last_version->date_of_approval)->format('d/m/Y') }}</td>
            </tr>
        </table>
    </section>
    <section>
        <h4 class="text-center">Historique des versions</h4>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Version</th>
                    <th>Motif de la modification</th>
                    <th>Acteur</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($process->versions as $version)
                <tr>
                    <td>{{ $version->creation_date->format('d/m/Y') }}</td>
                    <td>{{ $version->version }}</td>
                    <td>{{ $version->reasons_for_creation ?? $version->reasons_for_modification }}</td>
                    <td>{{ $version->created_by }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
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