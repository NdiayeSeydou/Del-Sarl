<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <title>Bordereau - {{ $bordereau->num_bl }}</title>

    <style>

        /* =========================================================
           DOMPDF / A4
        ========================================================= */

        @page {
            size: A4;
            margin: 14mm 14mm 24mm 14mm;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            color: #222;
            font-size: 10.5px;
        }

        table {
            border-collapse: collapse;
        }

        /* =========================================================
           EN-TÊTE
        ========================================================= */

        .header {
            width: 100%;
        }

        .header-left {
            width: 42%;
            vertical-align: top;
        }

        .header-right {
            width: 58%;
            vertical-align: top;
            text-align: right;
        }

        /*
         * DEL SARL :
         * les deux éléments sont volontairement sur la même ligne,
         * avec exactement la même police et la même taille.
         */
        .logo-line {
            white-space: nowrap;
            line-height: 30px;
            height: 30px;
        }

        .logo {
            font-size: 30px;
            font-weight: bold;
            font-style: italic;
            letter-spacing: -2px;
            color: #1b78b8;
        }

        .logo-sarl {
            font-size: 30px;
            font-weight: bold;
            font-style: italic;
            letter-spacing: -2px;
            color: #1b78b8;
            margin-left: 3px;
        }

        .logo-sub {
            margin-top: 5px;
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 1px;
            color: #333;
        }

        .societe {
            font-size: 12px;
            font-weight: bold;
            color: #0b4f86;
            margin-bottom: 5px;
        }

        .entete-info {
            font-size: 9px;
            line-height: 14px;
        }

        .double-line {
            border-top: 4px solid #1b78b8;
            border-bottom: 2px solid #0b4f86;
            height: 4px;
            margin: 10px 0 24px 0;
        }


        /* =========================================================
           TITRE
        ========================================================= */

        .titre {
            text-align: center;
            font-size: 21px;
            font-weight: bold;
            letter-spacing: 4px;
            color: #0b4f86;
            margin: 0 0 25px 0;
        }


        /* =========================================================
           INFORMATIONS CLIENT / DATE / BL
        ========================================================= */

        .infos {
            width: 100%;
            margin-bottom: 18px;
        }

        .infos-left {
            width: 62%;
            vertical-align: top;
        }

        .infos-right {
            width: 38%;
            vertical-align: top;
        }

        .label {
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #0b4f86;
        }

        .valeur {
            font-size: 10.5px;
            font-weight: bold;
            line-height: 15px;
        }

        /*
         * Les informations sont maintenant sur la même ligne :
         *
         * DATE DE LIVRAISON : Bamako, le 05/10/2026
         * N° BL : BL-2026-0004
         */
        .info-line {
            width: 100%;
            margin-bottom: 9px;
        }

        .info-label {
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #0b4f86;
            white-space: nowrap;
        }

        .info-value {
            font-size: 10.5px;
            font-weight: bold;
        }


        /* =========================================================
           RÉFÉRENCE
        ========================================================= */

        .reference {
            margin: 8px 0 18px 0;
            font-size: 10px;
            line-height: 15px;
        }

        .reference-label {
            color: #0b4f86;
            font-weight: bold;
            font-size: 8px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }


        /* =========================================================
           TABLEAU DES ARTICLES
        ========================================================= */

        .articles {
            width: 100%;
        }

        .articles th {
            background: #0b4f86;
            color: #fff;
            padding: 8px 6px;
            font-size: 9px;
            font-weight: bold;
            text-align: left;
        }

        .articles td {
            padding: 9px 6px;
            font-size: 10px;
            vertical-align: top;
        }

        .articles tbody tr {
            page-break-inside: avoid;
        }

        .articles .center {
            text-align: center;
        }

        .articles .right {
            text-align: right;
        }

        /*
         * Ligne total
         */
        .articles tfoot td {
            background: #0b4f86;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
            padding: 7px 6px;
        }


        /* =========================================================
           TEXTE APRÈS TABLEAU
        ========================================================= */

        .confirmation {
            margin-top: 18px;
            font-size: 9.5px;
            line-height: 15px;
        }


        /* =========================================================
           SIGNATURES
        ========================================================= */

        .signatures {
            width: 100%;
            margin-top: 38px;
        }

        /*
         * Deux colonnes parfaitement équilibrées.
         */
        .signature-left {
            width: 50%;
            vertical-align: top;
            text-align: left;
            padding-right: 25px;
        }

        .signature-right {
            width: 50%;
            vertical-align: top;
            text-align: left;
            padding-left: 25px;
        }

        /*
         * Titres des blocs
         */
        .signature-title {
            color: #0b4f86;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }

        .signature-subtitle {
            font-size: 9px;
            margin-bottom: 15px;
        }

        /*
         * Chaque donnée est maintenant sur UNE SEULE LIGNE.
         *
         * Nom : Sangaré Youssouf
         * Fonction : Marketing
         * Signature et cachet :
         */
        .signature-line {
            width: 100%;
            margin-bottom: 9px;
            font-size: 9.5px;
            line-height: 14px;
        }

        .signature-label {
            font-weight: normal;
            white-space: nowrap;
        }

        .signature-value {
            font-weight: normal;
        }

        /*
         * Zone réservée à la signature manuscrite / cachet.
         * Aucun pointillé.
         */
        .signature-space {
            height: 65px;
            margin-top: 5px;
        }


        /* =========================================================
           PIED DE PAGE
        ========================================================= */

        .pied {
            position: fixed;
            bottom: -15mm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8px;
            line-height: 12px;
            color: #444;
        }

    </style>
</head>


<body>

@php

    /*
    |--------------------------------------------------------------------------
    | CLIENT
    |--------------------------------------------------------------------------
    | Le bordereau est lié à une proforma.
    */

    $client = $bordereau->proforma?->client ?? '—';


    /*
    |--------------------------------------------------------------------------
    | DATE
    |--------------------------------------------------------------------------
    */

    $dateLivraison = \Carbon\Carbon::parse(
        $bordereau->date_livraison
    )->format('d/m/Y');


    /*
    |--------------------------------------------------------------------------
    | RÉFÉRENCE
    |--------------------------------------------------------------------------
    */

    $reference = $bordereau->reference ?? 'Aucune référence';

@endphp


{{-- =========================================================
     PIED DE PAGE
========================================================= --}}

<div class="pied">

    <strong>
        DEL SARL – Fournisseur &amp; Intégrateur de Solutions
    </strong>

    <br>

    RCCM : Ma.Bko.2015.B.703 |
    NIF : 084123008N |
    Hamdallaye ACI 2000, Bamako – Mali

</div>



{{-- =========================================================
     EN-TÊTE
========================================================= --}}

<table class="header">

    <tr>

        {{-- LOGO --}}
        <td class="header-left">

            <div class="logo-line">

                <span class="logo">DEL</span>

                <span class="logo-sarl">SARL</span>

            </div>

            <div class="logo-sub">
                INTÉGRATEUR DE SOLUTIONS
            </div>

        </td>


        {{-- INFORMATIONS SOCIÉTÉ --}}
        <td class="header-right">

            <div class="societe">
                DOUCOURÉ ÉQUIPEMENT ET LOGISTIQUE SARL
            </div>

            <div class="entete-info">

                Hamdallaye ACI 2000 – Bamako, Mali
                <br>

                Tél. : +223 94 34 77 57 / +223 66 75 63 29
                <br>

                Email : delsarl15@gmail.com

            </div>

        </td>

    </tr>

</table>



{{-- DOUBLE LIGNE --}}

<div class="double-line"></div>



{{-- =========================================================
     TITRE
========================================================= --}}

<div class="titre">
    BORDEREAU DE LIVRAISON
</div>



{{-- =========================================================
     CLIENT / DATE / NUMÉRO
========================================================= --}}

<table class="infos">

    <tr>

        {{-- CLIENT --}}
        <td class="infos-left">

            <div class="label">
                Client / Destinataire
            </div>

            <div class="valeur">
                {{ $client }}
            </div>

        </td>


        {{-- DATE + NUMÉRO --}}
        <td class="infos-right">

            <div class="info-line">

                <span class="info-label">
                    Date de livraison :
                </span>

                <span class="info-value">
                    Bamako, le {{ $dateLivraison }}
                </span>

            </div>


            <div class="info-line">

                <span class="info-label">
                    N° BL :
                </span>

                <span class="info-value">
                    {{ $bordereau->num_bl }}
                </span>

            </div>

        </td>

    </tr>

</table>



{{-- =========================================================
     RÉFÉRENCE
========================================================= --}}

<div class="reference">

    <span class="reference-label">
        Référence :
    </span>

    <span>
        {{ $reference }}
    </span>

</div>



{{-- =========================================================
     TABLEAU
========================================================= --}}

<table class="articles">

    <thead>

        <tr>

            <th style="width:7%;">
                N°
            </th>

            <th style="width:49%;">
                Désignation
            </th>

            <th style="width:14%; text-align:center;">
                Qté<br>livrée
            </th>

            <th style="width:30%;">
                Observations
            </th>

        </tr>

    </thead>


    <tbody>

        @forelse($bordereau->articles as $article)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $article->designation }}
                </td>

                <td class="center">
                    {{ $article->quantite }}
                </td>

                <td>
                    {{ $article->observations ?: '' }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="4" class="center">
                    Aucun article
                </td>

            </tr>

        @endforelse

    </tbody>


    <tfoot>

        <tr>

            <td colspan="2" class="center">
                TOTAL ARTICLES LIVRÉS
            </td>

            <td class="center">
                {{ $bordereau->total_quantite }}
            </td>

            <td></td>

        </tr>

    </tfoot>

</table>



{{-- =========================================================
     CONFIRMATION
========================================================= --}}

<div class="confirmation">

    Le destinataire reconnaît avoir reçu le matériel
    ci-dessus en bon état et conforme à la commande.

</div>



{{-- =========================================================
     SIGNATURES
========================================================= --}}

<table class="signatures">

    <tr>

        {{-- =====================================================
             DEL SARL
        ====================================================== --}}

        <td class="signature-left">

            <div class="signature-title">
                POUR DEL SARL
            </div>

            <div class="signature-subtitle">
                La Direction
            </div>


            <div class="signature-line">

                <span class="signature-label">
                    Nom :
                </span>

                <span class="signature-value">
                    {{ $bordereau->emetteur_nom ?: ' ' }}
                </span>

            </div>


            <div class="signature-line">

                <span class="signature-label">
                    Fonction :
                </span>

                <span class="signature-value">
                    {{ $bordereau->emetteur_fonction ?: ' ' }}
                </span>

            </div>


            <div class="signature-line">

                <span class="signature-label">
                    Signature et cachet :
                </span>

            </div>


            <div class="signature-space"></div>

        </td>



        {{-- =====================================================
             CLIENT
        ====================================================== --}}

        <td class="signature-right">

            <div class="signature-title">
                POUR LE CLIENT
            </div>

            <div class="signature-subtitle">
                Réceptionnaire
            </div>


            <div class="signature-line">

                <span class="signature-label">
                    Nom :
                </span>

                <span class="signature-value">
                    {{ $bordereau->recepteur_nom ?: ' ' }}
                </span>

            </div>


            <div class="signature-line">

                <span class="signature-label">
                    Fonction :
                </span>

                <span class="signature-value">
                    {{ $bordereau->recepteur_fonction ?: ' ' }}
                </span>

            </div>


            <div class="signature-line">

                <span class="signature-label">
                    Signature et cachet :
                </span>

            </div>


            <div class="signature-space"></div>

        </td>

    </tr>

</table>


</body>
</html>