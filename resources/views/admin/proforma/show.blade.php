@extends('layouts.navbar')
@section('title', 'Détails de la proforma — DEL SARL')
@section('suite')

<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2">
        <h2 class="fw-bold text-dark mb-0">Détails de la facture pro forma</h2>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('proforma.index') }}" class="btn btn-outline-secondary">Retour</a>
            <a href="{{ route('proforma.pdf', $proforma) }}" class="btn btn-outline-primary">Télécharger PDF</a>
            <a href="{{ route('proforma.edit', $proforma) }}" class="btn btn-outline-secondary" data-swal-confirm data-swal-title="Modifier cette proforma ?" data-swal-text="Le formulaire de modification va s'ouvrir." data-swal-confirm-text="Continuer">Modifier</a>
            <a href="{{ route('proforma.create') }}" class="btn btn-dark rounded-3 px-3" data-swal-confirm data-swal-title="Créer une proforma ?" data-swal-text="Le formulaire de création va s'ouvrir." data-swal-confirm-text="Continuer">+ Nouvelle pro forma</a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4 p-md-5">
            <div class="row pb-4 mb-4 border-bottom g-4">
                <div class="col-md-6">
                    <h4 class="fw-bold text-dark mb-1">DEL SARL</h4>
                    <p class="text-muted small mb-0 lh-lg">
                        INTÉGRATEUR DE SOLUTIONS<br>
                        Bamako, Mali<br>
                        Contact : +223 94 34 77 57 | delsarl15@gmail.com
                    </p>
                </div>

                <div class="col-md-6 text-md-end">
                    <span class="badge bg-secondary-subtle text-dark border px-3 py-2 mb-2 fw-semibold">
                        FACTURE PRO FORMA
                    </span>
                    <h5 class="fw-bold text-dark mb-1">N° {{ $proforma->num_proforma }}</h5>
                    <p class="text-muted small mb-3">
                        Date : {{ \Carbon\Carbon::parse($proforma->date_proforma)->format('d/m/Y') }}<br>
                        Devise : {{ $proforma->devise }}
                    </p>
                    <div class="p-3 bg-light rounded-2 text-start d-inline-block border" style="min-width: 250px;">
                        <small class="text-muted text-uppercase fw-semibold d-block mb-1">Client :</small>
                        <span class="fw-bold text-dark">{{ $proforma->client }}</span>
                    </div>
                </div>
            </div>

            <div class="table-responsive mb-4">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;" class="text-center">N°</th>
                            <th>Désignation</th>
                            <th style="width: 120px;" class="text-center">Quantité</th>
                            <th style="width: 180px;" class="text-end">Prix unitaire</th>
                            <th style="width: 200px;" class="text-end">Prix total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proforma->articles as $article)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-medium text-dark">{{ $article->designation }}</td>
                                <td class="text-center">{{ $article->quantite }}</td>
                                <td class="text-end">{{ number_format($article->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                                <td class="text-end fw-semibold text-dark">{{ number_format($article->prix_total, 0, ',', ' ') }} FCFA</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-end mb-4">
                <div class="col-md-5">
                    <div class="p-3 bg-light rounded-2 border">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total HT :</span>
                            <span class="fw-semibold text-dark">{{ number_format($proforma->subtotal_ht, 0, ',', ' ') }} FCFA</span>
                        </div>
                        @if($proforma->appliquer_remise)
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Remise ({{ $proforma->remise_pourcentage }}%) :</span>
                                <span class="fw-semibold text-dark">-{{ number_format($proforma->montant_remise, 0, ',', ' ') }} FCFA</span>
                            </div>
                        @endif
                        @if($proforma->appliquer_tva)
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">TVA ({{ $proforma->tva_pourcentage }}%) :</span>
                                <span class="fw-semibold text-dark">{{ number_format($proforma->montant_tva, 0, ',', ' ') }} FCFA</span>
                            </div>
                        @endif
                        <hr class="my-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark">TOTAL TTC :</span>
                            <span class="fw-bold text-dark fs-5">{{ number_format($proforma->grand_total, 0, ',', ' ') }} FCFA</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 pt-3 border-top">
                <div class="col-12">
                    <div class="p-3 bg-light rounded-2 border">
                        <small class="text-muted fw-semibold d-block mb-1">Arrêté de la facture pro forma :</small>
                       <span class="fw-semibold text-dark" id="montantEnLettres">
    {{ $proforma->montant_lettres ?? '' }}
</span>
                    </div>
                </div>

                <div class="col-12">
                    <small class="text-muted fw-semibold d-block mb-1">Modalités de règlement / Remarques complémentaires :</small>
                    <p class="text-muted small mb-0 lh-base">
                        {{ $proforma->remarques ?? 'Aucune remarque spécifique.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const montant = {{ (float) $proforma->grand_total }};
    const devise = @json($proforma->devise);
    const element = document.getElementById('montantEnLettres');

    function numberToWordsFR(num) {
        if (num === 0) return 'zéro';

        const units = ['', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf'];
        const teens = ['dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf'];
        const tens = ['', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante-dix', 'quatre-vingts', 'quatre-vingt-dix'];

        function convertGroup(n) {
            let res = '';
            let h = Math.floor(n / 100);
            let r = n % 100;

            if (h > 0) {
                if (h === 1) res += 'cent ';
                else res += units[h] + ' cent ';
            }

            if (r > 0) {
                if (r < 10) {
                    res += units[r];
                } else if (r < 20) {
                    res += teens[r - 10];
                } else {
                    let t = Math.floor(r / 10);
                    let u = r % 10;

                    if (t === 7) {
                        res += 'soixante-' + teens[u];
                    } else if (t === 9) {
                        res += 'quatre-vingt-' + teens[u];
                    } else {
                        res += tens[t] + (u === 1 ? ' et un' : (u > 0 ? '-' + units[u] : ''));
                    }
                }
            }

            return res.trim();
        }

        let millions = Math.floor(num / 1000000);
        let thousands = Math.floor((num % 1000000) / 1000);
        let remainder = Math.floor(num % 1000);

        let result = '';

        if (millions > 0) {
            result += convertGroup(millions) + (millions > 1 ? ' millions ' : ' million ');
        }

        if (thousands > 0) {
            result += (thousands === 1 ? 'mille ' : convertGroup(thousands) + ' mille ');
        }

        if (remainder > 0) {
            result += convertGroup(remainder);
        }

        return result.trim();
    }

    const montantEntier = Math.round(montant);
    const montantFormate = new Intl.NumberFormat('fr-FR').format(montantEntier);

    const montantLettres = numberToWordsFR(montantEntier);
    const deviseTexte = devise === 'XOF' ? 'francs CFA' : devise;

    element.textContent =
        montantLettres.charAt(0).toUpperCase() +
        montantLettres.slice(1) +
        deviseTexte + '.';

});
</script>

@endsection