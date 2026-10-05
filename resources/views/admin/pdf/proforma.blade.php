<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture Pro Forma - {{ $proforma->num_proforma }}</title>

    <style>
        /* ---------------------------------------------------------
           DomPDF : les marges de page se définissent ici.
           Ne JAMAIS combiner width + padding sur un bloc : DomPDF
           ignore box-sizing et le contenu déborde à droite.
        --------------------------------------------------------- */
        @page {
            size: A4;
            margin: 15mm 14mm 12mm 14mm;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            color: #222;
            font-size: 10px;
        }

        table { border-collapse: collapse; }

        /* ===== EN-TÊTE ===== */
        .header { width: 100%; margin-bottom: 8px; }
        .header-left  { width: 42%; vertical-align: top; }
        .header-right { width: 58%; vertical-align: top; text-align: right; }

        .logo-line {
            line-height: 40px;
            white-space: nowrap;
        }
        .logo {
            font-size: 40px;
            font-weight: bold;
            font-style: italic;
            letter-spacing: -3px;
        }
        .logo-sarl {
            font-size: 15px;
            font-weight: bold;
            font-style: italic;
            letter-spacing: 0;
            margin-left: 4px;
        }
        .logo-subtitle {
            margin-top: 5px;
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .company-name {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 6px;
        }
        .company-info {
            font-size: 9px;
            line-height: 15px;
        }

        /* ===== DOUBLE LIGNE (sans width, pour éviter tout débordement) ===== */
        .separator {
            border-top: 3px solid #222;
            border-bottom: 1px solid #222;
            height: 5px;
            margin: 8px 0 22px 0;
        }

        /* ===== TITRE ===== */
        .document-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 3px;
            margin: 0 0 6px 0;
        }
        .document-number {
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 24px;
        }

        /* ===== CLIENT / DATE / DEVISE ===== */
        .infos { width: 100%; margin-bottom: 22px; }
        .infos-left  { width: 62%; vertical-align: top; }
        .infos-right { width: 38%; vertical-align: top; }

        .label {
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: #555;
            margin-bottom: 4px;
        }
        .value {
            font-size: 11px;
            font-weight: bold;
            line-height: 16px;
        }
        .info-block { margin-bottom: 12px; }

        /* ===== TABLEAU ===== */
        .articles { width: 100%; }

        /* Fond sur les <th> / <td> (DomPDF ne peint pas le fond de <thead>) */
        .articles th {
            background: #222;
            color: #fff;
            padding: 8px 6px;
            font-size: 9px;
            font-weight: bold;
            text-align: left;
        }
        .articles td {
            padding: 8px 6px;
            font-size: 10px;
            vertical-align: top;
        }
        .articles tbody tr { page-break-inside: avoid; }

        .articles td.t-label,
        .articles td.t-value {
            background: #222;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
            padding: 8px 6px;
            text-align: right;
        }
        .articles tr.sep td { border-top: 1px solid #fff; }

        .center { text-align: center; }
        .right  { text-align: right; }

        /* ===== MONTANT EN LETTRES / REMARQUES / SIGNATURE ===== */
        .amount-words {
            margin-top: 22px;
            font-size: 10px;
            line-height: 16px;
        }
        .remarks {
            margin-top: 14px;
            font-size: 9px;
            line-height: 14px;
        }
        .signature {
            margin-top: 40px;
            margin-right: 30px;      /* margin, pas padding */
            text-align: right;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }
    </style>
</head>
<body>

@php
    $hasRemise = !empty($proforma->appliquer_remise);
    $hasTva    = !empty($proforma->appliquer_tva);
    $fmt = fn ($n) => number_format($n, 0, ',', ' ');
@endphp

{{-- ===== EN-TÊTE ===== --}}
<table class="header">
    <tr>
        <td class="header-left">
            <div class="logo-line"><span class="logo">DEL</span><span class="logo-sarl">SARL</span></div>
            <div class="logo-subtitle">INTÉGRATEUR DE SOLUTIONS</div>
        </td>
        <td class="header-right">
            <div class="company-name">DOUCOURÉ ÉQUIPEMENT ET LOGISTIQUE SARL</div>
            <div class="company-info">
                Hamdallaye ACI 2000 – Bamako, Mali<br>
                Tél. : +223 94 34 77 57 / +223 66 75 63 29<br>
                Email : delsarl15@gmail.com
            </div>
        </td>
    </tr>
</table>

<div class="separator"></div>

<div class="document-title">FACTURE PRO FORMA</div>
<div class="document-number">N° {{ $proforma->num_proforma }}</div>

{{-- ===== CLIENT / DATE / DEVISE ===== --}}
<table class="infos">
    <tr>
        <td class="infos-left">
            <div class="info-block">
                <div class="label">Client</div>
                <div class="value">{{ $proforma->client }}</div>
            </div>
        </td>
        <td class="infos-right">
            <div class="info-block">
                <div class="label">Date</div>
                <div class="value">
                    Bamako, le {{ \Carbon\Carbon::parse($proforma->date_proforma)->format('d/m/Y') }}
                </div>
            </div>
            <div class="info-block">
                <div class="label">Devise</div>
                <div class="value">{{ $proforma->devise }}</div>
            </div>
        </td>
    </tr>
</table>

{{-- ===== ARTICLES ===== --}}
<table class="articles">
    <thead>
        <tr>
            <th style="width:7%;">N°</th>
            <th style="width:43%;">Désignation</th>
            <th style="width:8%; text-align:center;">Qté</th>
            <th style="width:20%; text-align:right;">Prix unitaire</th>
            <th style="width:22%; text-align:right;">Prix total</th>
        </tr>
    </thead>

    <tbody>
        @foreach($proforma->articles as $article)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $article->designation }}</td>
                <td class="center">{{ $article->quantite }}</td>
                <td class="right">{{ $fmt($article->prix_unitaire) }}</td>
                <td class="right">{{ $fmt($article->prix_total) }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="4" class="t-label">TOTAL HT ({{ $proforma->devise }})</td>
            <td class="t-value">{{ $fmt($proforma->subtotal_ht) }}</td>
        </tr>

        @if($hasRemise)
            <tr class="sep">
                <td colspan="4" class="t-label">REMISE ({{ $proforma->remise_pourcentage }} %)</td>
                <td class="t-value">-{{ $fmt($proforma->montant_remise) }}</td>
            </tr>
        @endif

        @if($hasTva)
            <tr class="sep">
                <td colspan="4" class="t-label">TVA ({{ $proforma->tva_pourcentage }} %)</td>
                <td class="t-value">{{ $fmt($proforma->montant_tva) }}</td>
            </tr>
        @endif

        {{-- Ligne finale : uniquement si elle apporte une information --}}
        @if($hasTva)
            <tr class="sep">
                <td colspan="4" class="t-label">TOTAL TTC ({{ $proforma->devise }})</td>
                <td class="t-value">{{ $fmt($proforma->grand_total) }}</td>
            </tr>
        @elseif($hasRemise)
            <tr class="sep">
                <td colspan="4" class="t-label">TOTAL NET HT ({{ $proforma->devise }})</td>
                <td class="t-value">{{ $fmt($proforma->grand_total) }}</td>
            </tr>
        @endif
    </tfoot>
</table>

{{-- ===== MONTANT EN LETTRES ===== --}}
<div class="amount-words">
    Arrêtée la présente facture pro forma à la somme de :<br>
    <strong>
        {{ $proforma->montant_lettres ?: $fmt($proforma->grand_total) . ' ' . $proforma->devise }}
    </strong>
</div>

{{-- ===== REMARQUES ===== --}}
@if($proforma->remarques)
    <div class="remarks">{{ $proforma->remarques }}</div>
@endif

{{-- ===== SIGNATURE ===== --}}
<div class="signature">LA DIRECTION</div>

</body>
</html>
