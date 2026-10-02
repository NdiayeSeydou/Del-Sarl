@extends('layouts.navbar')
@section('title', 'Détails de la facture — DEL SARL')
@section('suite')

<div class="container-fluid py-4">
    <!-- En-tête sobre et épuré aligné avec vos vues -->
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2">
        <h2 class="fw-bold text-dark mb-0">Détails de la facture</h2>
        <div class="d-flex align-items-center gap-2">
            <a href="#" class="btn btn-outline-secondary">Retour à la liste</a>
            <a href="#" class="btn btn-outline-secondary">Télécharger PDF</a>
            <a href="#" class="btn btn-outline-secondary">Modifier</a>
            <button type="button" class="btn btn-dark rounded-3 px-3">+ Nouvelle facture</button>
        </div>
    </div>

    <!-- Carte principale de la facture -->
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
                        Statut : Non payée
                    </span>
                    <h5 class="fw-bold text-dark mb-1">Facture N° FAC-2026-0001</h5>
                    <p class="text-muted small mb-3">
                        Date d'émission : 02/10/2026<br>
                        Date d'échéance : 15/10/2026
                    </p>
                    <div class="p-3 bg-light rounded-2 text-start d-inline-block border" style="min-width: 250px;">
                        <small class="text-muted text-uppercase fw-semibold d-block mb-1">Facturé à :</small>
                        <span class="fw-bold text-dark">MINISTÈRE DE L'ADMINISTRATION TERRITORIALE</span>
                    </div>
                </div>
            </div>

            <!-- Tableau des articles -->
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
                            <td class="fw-medium text-dark">Fourniture d'équipements informatiques</td>
                            <td class="text-center">2</td>
                            <td class="text-end">500 000 FCFA</td>
                            <td class="text-end fw-semibold text-dark">1 000 000 FCFA</td>
                        </tr>
                        <tr>
                            <td class="text-center text-muted">2</td>
                            <td class="fw-medium text-dark">Installation et configuration réseau</td>
                            <td class="text-center">1</td>
                            <td class="text-end">250 000 FCFA</td>
                            <td class="text-end fw-semibold text-dark">250 000 FCFA</td>
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
                            <span class="fw-semibold text-dark">1 250 000 FCFA</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Remise (5%) :</span>
                            <span class="fw-semibold text-dark">-62 500 FCFA</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">TVA (18%) :</span>
                            <span class="fw-semibold text-dark">213 750 FCFA</span>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark">TOTAL TTC :</span>
                            <span class="fw-bold text-dark fs-5">1 401 250 FCFA</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Somme en toutes lettres & Mentions -->
            <div class="row g-3 pt-3 border-top">
                <div class="col-12">
                    <div class="p-3 bg-light rounded-2 border">
                        <small class="text-muted fw-semibold d-block mb-1">Arrêté de la facture :</small>
                        <span class="fw-semibold text-dark">
                            Un million quatre cent un mille deux cent cinquante (1 401 250) francs CFA TTC.
                        </span>
                    </div>
                </div>

                <div class="col-12">
                    <small class="text-muted fw-semibold d-block mb-1">Conditions de règlement & Coordonnées bancaires :</small>
                    <p class="text-muted small mb-0 lh-base">
                        Arrêtée la présente facture à la somme indiquée ci-dessus en francs CFA.<br>
                        Règlement par chèque ou par virement bancaire.<br>
                        Compte BDM SA N° : XXXXXXXXXXXXXXX<br>
                        Paiement à effectuer dès réception de la facture.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection