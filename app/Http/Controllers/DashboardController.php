<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <title>Facture Pro Forma - {{ $proforma->num_proforma }}</title>

    <style>

        @page {
            size: A4;
            margin: 12mm 13mm 12mm 13mm;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            color: #222;
            font-size: 10px;
        }

        body {
            background: #fff;
        }

        /* =====================================================
           CONTENEUR PRINCIPAL
        ===================================================== */

        .page {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        /* =====================================================
           EN-TÊTE
        ===================================================== */

        .header {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .header-left {
            width: 40%;
            vertical-align: top;
            padding: 0;
        }

        .header-right {
            width: 60%;
            vertical-align: top;
            text-align: right;
            padding: 0;
        }

        /* DEL SARL SUR UNE SEULE LIGNE */

        .logo {
            font-size: 34px;
            line-height: 36px;
            font-weight: bold;
            font-style: italic;
            letter-spacing: -2px;
            white-space: nowrap;
        }

        .logo-subtitle {
            margin-top: 4px;
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 1.2px;
            white-space: nowrap;
        }

        .company-name {
            font-size: 11px;
            line-height: 15px;
            font-weight: bold;
            letter-spacing: .3px;
            margin-bottom: 4px;
        }

        .company-info {
            font-size: 9px;
            line-height: 14px;
        }

        /* =====================================================
           LIGNES DE SÉPARATION
        ===================================================== */

        .separator {
            width: 100%;
            height: 7px;
            margin-top: 8px;
            margin-bottom: 22px;

            border-top: 3px solid #222;
            border-bottom: 1px solid #222;
        }

        /* =====================================================
           TITRE
        ===================================================== */

        .document-title {
            width: 100%;
            text-align: center;
            font-size: 20px;
            line-height: 26px;
            font-weight: bold;
            letter-spacing: 3px;
            margin: 0;
        }

        .document-number {
            width: 100%;
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            margin-top: 4px;
            margin-bottom: 25px;
        }

        /* =====================================================
           INFORMATIONS
        ===================================================== */

        .infos {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-bottom: 23px;
        }

        .infos-left {
            width: 65%;
            vertical-align: top;
        }

        .infos-right {
            width: 35%;
            vertical-align: top;
        }

        .label {
            font-size: 8px;
            line-height: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: #555;
            margin-bottom: 4px;
        }

        .value {
            font-size: 10.5px;
            line-height: 15px;
            font-weight: bold;
        }

        .info-block {
            margin-bottom: 10px;
        }

        /* =====================================================
           TABLEAU
        ===================================================== */

        .articles {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin: 0;
        }

        .articles thead {
            background: #222;
            color: #fff;
        }

        .articles th {
            padding: 8px 6px;
            font-size: 9px;
            line-height: 12px;
            font-weight: bold;
            border: 0;
        }

        .articles td {
            padding: 8px 6px;
            font-size: 9.5px;
            line-height: 14px;
            vertical-align: top;
            border: 0;
        }

        .articles tbody tr {
            page-break-inside: avoid;
        }

        /* Largeur des colonnes */

        .col-number {
            width: 7%;
            text-align: left;
        }

        .col-designation {
            width: 43%;
            text-align: left;
        }

        .col-quantity {
            width: 10%;
            text-align: center;
        }

        .col-price {
            width: 20%;
            text-align: right;
        }

        .col-total {
            width: 20%;
            text-align: right;
        }

        /* TOTALS */

        .articles tfoot td {
            background: #222;
            color: #fff;
            font-size: 9.5px;
            line-height: 13px;
            font-weight: bold;
            padding: 8px 6px;
            border: 0;
        }

        .articles tfoot tr + tr td {
            border-top: 1px solid #fff;
        }

        /* =====================================================
           MONTANT EN LETTRES
        ===================================================== */

        .amount-words {
            margin-top: 22px;
            font-size: 9.5px;
            line-height: 15px;
        }

        .amount-words strong {
            font-weight: bold;
        }

        /* =====================================================
           REMARQUES
        ===================================================== */

        .remarks {
            margin-top: 14px;
            font-size: 8.5px;
            line-height: 14px;
        }

        /* =====================================================
           SIGNATURE
        ===================================================== */

        .signature {
            width: 100%;
            text-align: right;
            margin-top: 38px;
            padding-right: 25px;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }

        /* =====================================================
           ÉVITER LES COUPURES
        ===================================================== */

        .no-break {
            page-break-inside: avoid;
        }

    </style>
</head>


<body>

<div class="page">

    {{-- =====================================================
         EN-TÊTE
    ====================================================== --}}

    <table class="header">

        <tr>

            <td class="header-left">

                <div class="logo">
                    DEL SARL
                </div>

                <div class="logo-subtitle">
                    INTÉGRATEUR DE SOLUTIONS
                </div>

            </td>


            <td class="header-right">

                <div class="company-name">
                    DOUCOURÉ ÉQUIPEMENT ET LOGISTIQUE SARL
                </div>

                <div class="company-info">
                    Hamdallaye ACI 2000 – Bamako, Mali<br>
                    Tél. : +223 94 34 77 57 / +223 66 75 63 29<br>
                    Email : delsarl15@gmail.com
                </div>

            </td>

        </tr>

    </table>


    {{-- =====================================================
         DOUBLE LIGNE
    ====================================================== --}}

    <div class="separator"></div>


    {{-- =====================================================
         TITRE
    ====================================================== --}}

    <div class="document-title">
        FACTURE PRO FORMA
    </div>

    <div class="document-number">
        N° {{ $proforma->num_proforma }}
    </div>


    {{-- =====================================================
         CLIENT / DATE / DEVISE
    ====================================================== --}}

    <table class="infos">

        <tr>

            <td class="infos-left">

                <div class="info-block">

                    <div class="label">
                        Client
                    </div>

                    <div class="value">
                        {{ $proforma->client }}
                    </div>

                </div>

            </td>


            <td class="infos-right">

                <div class="info-block">

                    <div class="label">
                        Date
                    </div>

                    <div class="value">
                        Bamako, le
                        {{ \Carbon\Carbon::parse($proforma->date_proforma)->format('d/m/Y') }}
                    </div>

                </div>


                <div class="info-block">

                    <div class="label">
                        Devise
                    </div>

                    <div class="value">
                        {{ $proforma->devise }}
                    </div>

                </div>

            </td>

        </tr>

    </table>


    {{-- =====================================================
         TABLEAU DES ARTICLES
    ====================================================== --}}

    <table class="articles">

        <thead>

            <tr>

                <th class="col-number">
                    N°
                </th>

                <th class="col-designation">
                    Désignation
                </th>

                <th class="col-quantity">
                    Qté
                </th>

                <th class="col-price">
                    Prix unitaire
                </th>

                <th class="col-total">
                    Prix total
                </th>

            </tr>

        </thead>


        <tbody>

            @foreach($proforma->articles as $article)

                <tr>

                    <td class="col-number">
                        {{ $loop->iteration }}
                    </td>

                    <td class="col-designation">
                        {{ $article->designation }}
                    </td>

                    <td class="col-quantity">
                        {{ $article->quantite }}
                    </td>

                    <td class="col-price">
                        {{ number_format($article->prix_unitaire, 0, ',', ' ') }}
                    </td>

                    <td class="col-total">
                        {{ number_format($article->prix_total, 0, ',', ' ') }}
                    </td>

                </tr>

            @endforeach

        </tbody>


        <tfoot>

            {{-- TOTAL HT --}}

            <tr>

                <td colspan="4" style="text-align:right;">
                    TOTAL HT ({{ $proforma->devise }})
                </td>

                <td style="text-align:right;">
                    {{ number_format($proforma->subtotal_ht, 0, ',', ' ') }}
                </td>

            </tr>


            {{-- REMISE --}}

            @if($proforma->appliquer_remise)

                <tr>

                    <td colspan="4" style="text-align:right;">
                        REMISE ({{ $proforma->remise_pourcentage }} %)
                    </td>

                    <td style="text-align:right;">
                        -{{ number_format($proforma->montant_remise, 0, ',', ' ') }}
                    </td>

                </tr>

            @endif


            {{-- TVA --}}

            @if($proforma->appliquer_tva)

                <tr>

                    <td colspan="4" style="text-align:right;">
                        TVA ({{ $proforma->tva_pourcentage }} %)
                    </td>

                    <td style="text-align:right;">
                        {{ number_format($proforma->montant_tva, 0, ',', ' ') }}
                    </td>

                </tr>

            @endif


            {{-- TOTAL TTC --}}

            <tr>

                <td colspan="4" style="text-align:right;">
                    TOTAL TTC
                </td>

                <td style="text-align:right;">
                    {{ number_format($proforma->grand_total, 0, ',', ' ') }}
                </td>

            </tr>

        </tfoot>

    </table>


    {{-- =====================================================
         MONTANT EN LETTRES
    ====================================================== --}}

    <div class="amount-words">

        Arrêtée la présente facture pro forma à la somme de :

        <br>

        <strong>
            {{ $proforma->montant_lettres ?: number_format($proforma->grand_total, 0, ',', ' ') . ' ' . $proforma->devise }}
        </strong>

    </div>


    {{-- =====================================================
         REMARQUES
    ====================================================== --}}

    @if($proforma->remarques)

        <div class="remarks">
            {{ $proforma->remarques }}
        </div>

    @endif


    {{-- =====================================================
         SIGNATURE
    ====================================================== --}}

    <div class="signature">
        LA DIRECTION
    </div>

</div>

</body>

</html>