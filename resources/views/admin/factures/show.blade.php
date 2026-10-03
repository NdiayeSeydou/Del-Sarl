@extends('layouts.navbar')
@section('title', 'Détails de la facture — DEL SARL')
@section('suite')

    <div class="container-fluid py-4">
        <div class="d-flex align-items-center justify-content-between mb-4 pb-2">
            <h2 class="fw-bold text-dark mb-0">Détails de la facture</h2>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('facture.index') }}" class="btn btn-outline-secondary">Retour à la liste</a>
                <a href="{{ route('facture.pdf', $facture) }}" class="btn btn-outline-primary">Télécharger PDF</a>
                <a href="{{ route('facture.edit', $facture) }}" class="btn btn-outline-secondary" data-swal-confirm
                    data-swal-title="Modifier cette facture ?" data-swal-text="Le formulaire de modification va s'ouvrir."
                    data-swal-confirm-text="Continuer">Modifier</a>
                <a href="{{ route('facture.create') }}" class="btn btn-dark rounded-3 px-3" data-swal-confirm
                    data-swal-title="Créer une facture ?" data-swal-text="Le formulaire de création va s'ouvrir."
                    data-swal-confirm-text="Continuer">+ Nouvelle facture</a>
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
                            Contact : +223 94 34 77 57| delsarl15@gmail.com
                        </p>
                    </div>

                    <div class="col-md-6 text-md-end">
                        @php
                            $statuts = [
                                'paid' => ['label' => 'Payé', 'color' => 'text-success'], // Vert
                                'partial' => ['label' => 'Partiellement payé', 'color' => 'text-warning'], // Orange
                                'partially_paid' => ['label' => 'Partiellement payé', 'color' => 'text-warning'], // Orange (alternative)
                                'unpaid' => ['label' => 'Non payé', 'color' => 'text-danger'], // Rouge
                                'pending' => ['label' => 'En attente', 'color' => 'text-danger'], // Rouge
                            ];

                            $statutKey = strtolower($facture->statut_paiement ?? '');
                            $label =
                                $statuts[$statutKey]['label'] ??
                                ucfirst(str_replace('_', ' ', $facture->statut_paiement));
                            $colorClass = $statuts[$statutKey]['color'] ?? 'text-secondary';
                        @endphp

                        <span class="{{ $colorClass }} fw-bold">
                            {{ $label }}
                        </span>
                        <h5 class="fw-bold text-dark mb-1">Facture N° {{ $facture->num_facture }}</h5>
                        <p class="text-muted small mb-3">
                            Date d'émission : {{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}<br>
                            @if ($facture->date_echeance)
                                Date d'échéance : {{ \Carbon\Carbon::parse($facture->date_echeance)->format('d/m/Y') }}
                            @endif
                        </p>
                        <div class="p-3 bg-light rounded-2 text-start d-inline-block border" style="min-width: 250px;">
                            <small class="text-muted text-uppercase fw-semibold d-block mb-1">Facturé à :</small>
                            <span class="fw-bold text-dark text-truncate d-inline-block" style="max-width: 200px;"
                                title="{{ $facture->client }}">
                                {{ $facture->client }}
                            </span>
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
                            @foreach ($facture->articles as $article)
                                <tr>
                                    <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-medium text-dark">{{ $article->designation }}</td>
                                    <td class="text-center">{{ $article->quantite }}</td>
                                    <td class="text-end">{{ number_format($article->prix_unitaire, 0, ',', ' ') }} FCFA
                                    </td>
                                    <td class="text-end fw-semibold text-dark">
                                        {{ number_format($article->prix_total, 0, ',', ' ') }} FCFA</td>
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
                                <span class="fw-semibold text-dark">{{ number_format($facture->subtotal_ht, 0, ',', ' ') }}
                                    FCFA</span>
                            </div>
                            @if ($facture->appliquer_remise)
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Remise ({{ $facture->remise_pourcentage }}%) :</span>
                                    <span
                                        class="fw-semibold text-dark">-{{ number_format($facture->montant_remise, 0, ',', ' ') }}
                                        FCFA</span>
                                </div>
                            @endif
                            @if ($facture->appliquer_tva)
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">TVA ({{ $facture->tva_pourcentage }}%) :</span>
                                    <span
                                        class="fw-semibold text-dark">{{ number_format($facture->montant_tva, 0, ',', ' ') }}
                                        FCFA</span>
                                </div>
                            @endif
                            <hr class="my-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark">TOTAL TTC :</span>
                                <span
                                    class="fw-bold text-dark fs-5">{{ number_format($facture->grand_total, 0, ',', ' ') }}
                                    FCFA</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 pt-3 border-top">
                    <div class="col-12">
                        <div class="p-3 bg-light rounded-2 border">
                            <small class="text-muted fw-semibold d-block mb-1">Arrêté de la facture :</small>
                            <span class="fw-semibold text-dark">
                                @if (!empty($facture->montant_lettres))
                                    {{ $facture->montant_lettres }}
                                @elseif($facture->grand_total)
                                    {{ ucfirst(\Illuminate\Support\Number::spell(round($facture->grand_total), 'fr')) }}
                                    francs CFA.
                                @else
                                    Montant non renseigné
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <small class="text-muted fw-semibold d-block mb-1">Conditions de règlement & Coordonnées bancaires
                            :</small>
                        <p class="text-muted small mb-0 lh-base">
                            {{ $facture->conditions ?? 'Règlement selon les modalités standard.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
