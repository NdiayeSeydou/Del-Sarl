@extends('layouts.navbar')
@section('title', 'Détails du bordereau — DEL SARL')
@section('suite')

<div class="container-fluid py-4">
    <!-- En-tête sobre et épuré aligné avec vos autres vues -->
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2">
        <h2 class="fw-bold text-dark mb-0">Détails du bordereau de livraison</h2>
        <div class="d-flex align-items-center gap-2">
            <a href="#" class="btn btn-outline-secondary">Retour à la liste</a>
            <a href="#" class="btn btn-outline-secondary">Télécharger PDF</a>
            <a href="#" class="btn btn-outline-secondary">Modifier</a>
            <button type="button" class="btn btn-dark rounded-3 px-3">+ Nouveau bordereau</button>
        </div>
    </div>

    <!-- Carte principale du Bordereau -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4 p-md-5">
            
            <!-- Informations en-tête : Entreprise, Références & Client -->
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
                        BORDEREAU DE LIVRAISON
                    </span>
                    <h5 class="fw-bold text-dark mb-1">N° BL-2026-001</h5>
                    <p class="text-muted small mb-3">
                        Date de livraison : 02/10/2026<br>
                        Référence : Facture pro forma DEL SARL du 25/09/2026
                    </p>
                    <div class="p-3 bg-light rounded-2 text-start d-inline-block border" style="min-width: 250px;">
                        <small class="text-muted text-uppercase fw-semibold d-block mb-1">Client / Destinataire :</small>
                        <span class="fw-bold text-dark">MINISTÈRE DE L'ADMINISTRATION TERRITORIALE</span>
                    </div>
                </div>
            </div>

            <!-- Tableau des Articles Livrés -->
            <div class="table-responsive mb-4">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;" class="text-center">N°</th>
                            <th>Désignation</th>
                            <th style="width: 140px;" class="text-center">Qté Livrée</th>
                            <th>Observations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center text-muted">1</td>
                            <td class="fw-medium text-dark">Photocopieur CANON imageRUNNER</td>
                            <td class="text-center fw-semibold text-dark">2</td>
                            <td class="text-muted small">Neuf en carton d'origine avec accessoires</td>
                        </tr>
                        <tr>
                            <td class="text-center text-muted">2</td>
                            <td class="fw-medium text-dark">Onduleur APC 1500VA</td>
                            <td class="text-center fw-semibold text-dark">3</td>
                            <td class="text-muted small">Inclus câbles de raccordement</td>
                        </tr>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="2" class="text-end fw-bold text-dark text-uppercase small">Total Articles Livrés :</td>
                            <td class="text-center fw-bold text-dark fs-6">5</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Section Signataires & Réception -->
            <div class="pt-3 border-top">
                <h6 class="fw-bold text-dark mb-4">Signataires & Accusé de réception</h6>
                <div class="row g-4">
                    <!-- Émetteur (DEL SARL) -->
                    <div class="col-md-6 border-end-md">
                        <div class="p-3 bg-light rounded-2 border h-100">
                            <small class="text-muted fw-semibold d-block mb-2 text-uppercase">Pour DEL SARL (La Direction)</small>
                            <div class="lh-lg small">
                                <div><strong class="text-dark">Nom & Prénom :</strong> Doucouré Aïssata</div>
                                <div><strong class="text-dark">Fonction :</strong> Gérante Associée</div>
                                <div class="mt-4 pt-3 border-top text-muted italic">Signature / Cachet :</div>
                            </div>
                        </div>
                    </div>

                    <!-- Réceptionnaire (Client) -->
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-2 border h-100">
                            <small class="text-muted fw-semibold d-block mb-2 text-uppercase">Pour le Client (Réceptionnaire)</small>
                            <div class="lh-lg small">
                                <div><strong class="text-dark">Nom & Prénom :</strong> Youba Maïga</div>
                                <div><strong class="text-dark">Fonction :</strong> Agent à la DFM / DCM</div>
                                <div class="mt-4 pt-3 border-top text-muted italic">Signature / Cachet du client :</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection