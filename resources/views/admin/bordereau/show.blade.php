@extends('layouts.navbar')
@section('title', 'Détails du bordereau — DEL SARL')
@section('suite')

    <div class="container-fluid py-4">
        <div class="d-flex align-items-center justify-content-between mb-4 pb-2">
            <h2 class="fw-bold text-dark mb-0">Détails du bordereau de livraison</h2>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('bordereau.index') }}" class="btn btn-outline-secondary">Retour</a>
                <a href="{{ route('bordereau.pdf', $bordereau) }}" class="btn btn-outline-primary">Télécharger</a>
                <a href="{{ route('bordereau.edit', $bordereau) }}" class="btn btn-outline-secondary" data-swal-confirm
                    data-swal-title="Modifier ce bordereau ?" data-swal-text="Le formulaire de modification va s'ouvrir."
                    data-swal-confirm-text="Continuer">Modifier</a>
                <a href="{{ route('bordereau.create') }}" class="btn btn-dark rounded-3 px-3" data-swal-confirm
                    data-swal-title="Créer un bordereau ?" data-swal-text="Le formulaire de création va s'ouvrir."
                    data-swal-confirm-text="Continuer">+ Nouveau bordereau</a>
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
                            BORDEREAU DE LIVRAISON
                        </span>
                        <h5 class="fw-bold text-dark mb-1">N° {{ $bordereau->num_bl }}</h5>


                        <p class="text-muted small mb-3">
                            Date de livraison : {{ \Carbon\Carbon::parse($bordereau->date_livraison)->format('d/m/Y') }}<br>
                            Référence : {{ $bordereau->reference ?? 'Aucune référence' }}
                        </p>


                        <div class="p-3 bg-light rounded-2 text-start d-inline-block border" style="min-width: 250px;">
                            <small class="text-muted text-uppercase fw-semibold d-block mb-1">Client / Destinataire
                                :</small>
                            <span class="fw-bold text-dark">{{ $bordereau->client }}</span>
                        </div>
                    </div>
                </div>

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
                            @foreach ($bordereau->articles as $article)
                                <tr>
                                    <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-medium text-dark">{{ $article->designation }}</td>
                                    <td class="text-center fw-semibold text-dark">{{ $article->quantite }}</td>
                                    <td class="text-muted small">{{ $article->observations ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="2" class="text-end fw-bold text-dark text-uppercase small">Total Articles
                                    Livrés :</td>
                                <td class="text-center fw-bold text-dark fs-6">{{ $bordereau->total_quantite }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="pt-3 border-top">
                    <h6 class="fw-bold text-dark mb-4">Signataires & Accusé de réception</h6>
                    <div class="row g-4">
                        <div class="col-md-6 border-end-md">
                            <div class="p-3 bg-light rounded-2 border h-100">
                                <small class="text-muted fw-semibold d-block mb-2 text-uppercase">Pour DEL SARL (La
                                    Direction)</small>
                                <div class="lh-lg small">
                                    <div><strong class="text-dark">Nom & Prénom :</strong>
                                        {{ $bordereau->emetteur_nom ?? 'Non renseigné' }}</div>
                                    <div><strong class="text-dark">Fonction :</strong>
                                        {{ $bordereau->emetteur_fonction ?? 'Non renseignée' }}</div>
                                    <div class="mt-4 pt-3 border-top text-muted italic">Signature / Cachet :</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-2 border h-100">
                                <small class="text-muted fw-semibold d-block mb-2 text-uppercase">Pour le Client
                                    (Réceptionnaire)</small>
                                <div class="lh-lg small">
                                    <div><strong class="text-dark">Nom & Prénom :</strong>
                                        {{ $bordereau->recepteur_nom ?? 'Non renseigné' }}</div>
                                    <div><strong class="text-dark">Fonction :</strong>
                                        {{ $bordereau->recepteur_fonction ?? 'Non renseignée' }}</div>
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
