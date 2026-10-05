<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture - {{ $facture->num_facture }}</title>

    <style>
        /* DomPDF : pas de variables CSS, pas de rem, pas de width + padding sur un bloc,
           pas de margin:auto sur un tableau. Marges de page définies ici. */
        @page {
            size: A4;
            margin: 14mm 14mm 24mm 14mm;   /* bas plus grand : place du pied de page fixe */
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            color: #222;
            font-size: 10.5px;
        }

        table { border-collapse: collapse; }

        /* ===== EN-TÊTE ===== */
        .header { width: 100%; }
        .header-left  { width: 42%; vertical-align: top; }
        .header-right { width: 58%; vertical-align: top; text-align: right; }

        .logo-line { line-height: 42px; white-space: nowrap; }
        .logo      { font-size: 42px; font-weight: bold; font-style: italic; letter-spacing: -3px; color: #1b78b8; }
        .logo-sarl { font-size: 15px; font-weight: bold; font-style: italic; margin-left: 4px; color: #1b78b8; }
        .logo-sub  { margin-top: 5px; font-size: 8px; font-weight: bold; letter-spacing: 1px; color: #333; }

        .societe { font-size: 12px; font-weight: bold; color: #0b4f86; margin-bottom: 6px; }
        .entete-info { font-size: 9px; line-height: 15px; }

        .double-line {
            border-top: 4px solid #1b78b8;
            border-bottom: 2px solid #0b4f86;
            height: 4px;
            margin: 10px 0 24px 0;
        }

        /* ===== TITRE ===== */
        .titre {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 5px;
            color: #0b4f86;
            margin: 0 0 6px 0;
        }
        .numero { text-align: center; font-size: 11px; font-weight: bold; margin-bottom: 26px; }

        /* ===== INFOS ===== */
        .infos { width: 100%; margin-bottom: 24px; }
        .infos-left  { width: 62%; vertical-align: top; }
        .infos-right { width: 38%; vertical-align: top; }
        .label {
            font-size: 8px; font-weight: bold; letter-spacing: 1px;
            text-transform: uppercase; color: #0b4f86; margin-bottom: 4px;
        }
        .valeur { font-size: 11px; font-weight: bold; line-height: 16px; margin-bottom: 14px; }

        /* ===== ARTICLES ===== */
        .articles { width: 100%; }
        .articles th {
            background: #0b4f86; color: #fff;
            padding: 9px 6px; font-size: 9px; font-weight: bold; text-align: left;
        }
        .articles td { padding: 10px 6px; font-size: 10.5px; vertical-align: top; }
        .articles tbody tr { page-break-inside: avoid; }
        .right  { text-align: right; }
        .center { text-align: center; }

        /* ===== TOTAUX (bloc à droite, sans margin:auto) ===== */
        .totaux-wrap { width: 100%; margin-top: 10px; }
        .totaux-vide { width: 56%; }
        .totaux      { width: 100%; }
        .totaux td   { padding: 7px 8px; font-size: 10px; font-weight: bold; background: #eef3f8; }
        .totaux tr.final td { background: #0b4f86; color: #fff; font-size: 11px; }
        .totaux td.v { text-align: right; }

        /* ===== BAS DE DOCUMENT : reste groupé, ne se coupe pas entre 2 pages ===== */
        .no-break { page-break-inside: avoid; }
        .arrete { margin-top: 22px; font-size: 10.5px; line-height: 17px; }
        .reglement { margin-top: 10px; font-size: 9.5px; line-height: 15px; }
        .direction {
            margin-top: 38px;
            margin-right: 30px;
            text-align: right;
            font-size: 10.5px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #0b4f86;
        }

        /* ===== PIED DE PAGE : collé en bas de chaque page ===== */
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
    $fmt       = fn ($n) => number_format($n, 0, ',', ' ');
    $hasRemise = !empty($facture->appliquer_remise);
    $hasTva    = !empty($facture->appliquer_tva);
    $hasFinal  = $hasTva || $hasRemise;
    $statuts   = ['unpaid' => 'Non payée', 'paid' => 'Payée', 'partial' => 'Partiellement payée'];
    $statut    = $statuts[$facture->statut_paiement] ?? ucfirst(str_replace('_', ' ', $facture->statut_paiement));
@endphp

{{-- ===== PIED DE PAGE (répété sur chaque page) ===== --}}
<div class="pied">
    <strong>DEL SARL – Fournisseur &amp; Intégrateur de Solutions Techniques</strong><br>
    RCCM : Ma.Bko.2015.B.703 | NIF : 084123008N | Hamdallaye ACI 2000, Bamako – Mali
</div>

{{-- ===== EN-TÊTE ===== --}}
<table class="header">
    <tr>
        <td class="header-left">
            <div class="logo-line"><span class="logo">DEL</span><span class="logo-sarl">SARL</span></div>
            <div class="logo-sub">INTÉGRATEUR DE SOLUTIONS</div>
        </td>
        <td class="header-right">
            <div class="societe">DOUCOURÉ ÉQUIPEMENT ET LOGISTIQUE SARL</div>
            <div class="entete-info">
                Hamdallaye ACI 2000 – Bamako, Mali<br>
                Tél. : +223 94 34 77 57 / +223 66 75 63 29<br>
                Email : delsarl15@gmail.com
            </div>
        </td>
    </tr>
</table>

<div class="double-line"></div>

<div class="titre">FACTURE</div>
<div class="numero">N° {{ $facture->num_facture }}</div>

{{-- ===== CLIENT / DATES ===== --}}
<table class="infos">
    <tr>
        <td class="infos-left">
            <div class="label">Client</div>
            <div class="valeur">{{ $facture->client }}</div>
            <div class="label">Statut de paiement</div>
            <div class="valeur">{{ $statut }}</div>
        </td>
        <td class="infos-right">
            <div class="label">Date</div>
            <div class="valeur">Bamako, le {{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}</div>
            <div class="label">Date d'échéance</div>
            <div class="valeur">{{ $facture->date_echeance ? \Carbon\Carbon::parse($facture->date_echeance)->format('d/m/Y') : '—' }}</div>
            <div class="label">Devise</div>
            <div class="valeur">Franc CFA (XOF)</div>
        </td>
    </tr>
</table>

{{-- ===== ARTICLES ===== --}}
<table class="articles">
    <thead>
        <tr>
            <th style="width:7%;">N°</th>
            <th style="width:41%;">Désignation</th>
            <th style="width:8%; text-align:center;">Qté</th>
            <th style="width:21%; text-align:right;">Prix unitaire HT</th>
            <th style="width:23%; text-align:right;">Prix total HT</th>
        </tr>
    </thead>
    <tbody>
        @foreach($facture->articles as $article)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $article->designation }}</td>
                <td class="center">{{ $article->quantite }}</td>
                <td class="right">{{ $fmt($article->prix_unitaire) }}</td>
                <td class="right">{{ $fmt($article->prix_total) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="no-break">

    {{-- ===== TOTAUX ===== --}}
    <table class="totaux-wrap">
        <tr>
            <td class="totaux-vide"></td>
            <td>
                <table class="totaux">
                    <tr class="{{ $hasFinal ? '' : 'final' }}">
                        <td>TOTAL HT (FCFA)</td>
                        <td class="v">{{ $fmt($facture->subtotal_ht) }}</td>
                    </tr>
                    @if($hasRemise)
                        <tr>
                            <td>Remise ({{ $facture->remise_pourcentage }} %)</td>
                            <td class="v">-{{ $fmt($facture->montant_remise) }}</td>
                        </tr>
                    @endif
                    @if($hasTva)
                        <tr>
                            <td>TVA ({{ $facture->tva_pourcentage }} %)</td>
                            <td class="v">{{ $fmt($facture->montant_tva) }}</td>
                        </tr>
                    @endif
                    @if($hasTva)
                        <tr class="final">
                            <td>TOTAL TTC (FCFA)</td>
                            <td class="v">{{ $fmt($facture->grand_total) }}</td>
                        </tr>
                    @elseif($hasRemise)
                        <tr class="final">
                            <td>TOTAL NET HT (FCFA)</td>
                            <td class="v">{{ $fmt($facture->grand_total) }}</td>
                        </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>

    {{-- ===== MONTANT EN LETTRES ===== --}}
    <div class="arrete">
        Arrêtée la présente facture à la somme de :<br>
        <strong>{{ $facture->montant_lettres ?: $fmt($facture->grand_total) . ' francs CFA' }}</strong>
    </div>

    <div class="reglement">
        <strong>Conditions de règlement :</strong> {{ $facture->conditions ?: 'Selon accord avec le client.' }}
    </div>

    <div class="direction">LA DIRECTION</div>
</div>

</body>
</html>