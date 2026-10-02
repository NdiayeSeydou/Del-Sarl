@extends('layouts.navbar')
@section('title', 'Détails de la proforma — DEL SARL')
@section('suite')

<div class="container-fluid py-4">
    <!-- En-tête sobre et épuré aligné avec vos autres vues -->
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2">
        <h2 class="fw-bold text-dark mb-0">Détails de la facture pro forma</h2>
        <div class="d-flex align-items-center gap-2">
            <a href="#" class="btn btn-outline-secondary">Retour à la liste</a>
            <a href="#" class="btn btn-outline-secondary">Télécharger PDF</a>
            <a href="#" class="btn btn-outline-secondary">Modifier</a>
            <button type="button" class="btn btn-dark rounded-3 px-3">+ Nouvelle pro forma</button>
        </div>
    </div>

    <!-- Carte principale de la Pro Forma -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4 p-md-5">
            
            <!-- Informations en-tête : Entreprise & Client -->
            <div class="row pb-4 mb-4 border-bottom g-4">
                <div class="col-md-6">
                    <h4 class="fw-bold text-dark mb-1">DEL SARL</h4>
                    <p class="text-muted small mb-0 lh-lg">
                        Services & Prestations Informatiques<br>
                        Bamako, Mali<br>
                        Contact : +223 XX XX XX XX | contact@delsarl.com
                    </p>
                </div>

                <div class="col-md-6 text-md-end">
                    <span class="badge bg-secondary-subtle text-dark border px-3 py-2 mb-2 fw-semibold">
                        FACTURE PRO FORMA
                    </span>
                    <h5 class="fw-bold text-dark mb-1">N° PRO-2026-001</h5>
                    <p class="text-muted small mb-3">
                        Date : 02/10/2026<br>
                        Devise : Franc CFA (XOF)
                    </p>
                    <div class="p-3 bg-light rounded-2 text-start d-inline-block border" style="min-width: 250px;">
                        <small class="text-muted text-uppercase fw-semibold d-block mb-1">Client :</small>
                        <span class="fw-bold text-dark">MINISTÈRE DE L'ADMINISTRATION TERRITORIALE</span>
                    </div>
                </div>
            </div>

            <!-- Tableau des Articles / Prestations -->
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
                        <tr>
                            <td class="text-center text-muted">1</td>
                            <td class="fw-medium text-dark">Photocopieur CANON imageRUNNER 4745i</td>
                            <td class="text-center">1</td>
                            <td class="text-end">1 800 000 FCFA</td>
                            <td class="text-end fw-semibold text-dark">1 800 000 FCFA</td>
                        </tr>
                        <tr>
                            <td class="text-center text-muted">2</td>
                            <td class="fw-medium text-dark">Consommables & Cartouches d'encre d'origine</td>
                            <td class="text-center">4</td>
                            <td class="text-end">75 000 FCFA</td>
                            <td class="text-end fw-semibold text-dark">300 000 FCFA</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Récapitulatif financier -->
            <div class="row justify-content-end mb-4">
                <div class="col-md-5">
                    <div class="p-3 bg-light rounded-2 border">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total HT :</span>
                            <span class="fw-semibold text-dark">2 100 000 FCFA</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Remise (5%) :</span>
                            <span class="fw-semibold text-dark">-105 000 FCFA</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">TVA (18%) :</span>
                            <span class="fw-semibold text-dark">359 100 FCFA</span>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark">TOTAL TTC :</span>
                            <span class="fw-bold text-dark fs-5">2 354 100 FCFA</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Somme en toutes lettres & Modalités -->
            <div class="row g-3 pt-3 border-top">
                <div class="col-12">
                    <div class="p-3 bg-light rounded-2 border">
                        <small class="text-muted fw-semibold d-block mb-1">Arrêté de la facture pro forma :</small>
                        <span class="fw-semibold text-dark">
                            Deux millions trois cent cinquante-quatre mille cent (2 354 100) francs CFA TTC.
                        </span>
                    </div>
                </div>

                <div class="col-12">
                    <small class="text-muted fw-semibold d-block mb-1">Modalités de règlement / Remarques complémentaires :</small>
                    <p class="text-muted small mb-0 lh-base">
                        Arrêtée la présente facture pro forma à la somme indiquée ci-dessus en francs CFA.<br>
                        Validité de l'offre : 30 jours.<br>
                        Règlement par chèque ou virement bancaire.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection