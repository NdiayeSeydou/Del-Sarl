@extends('layouts.navbar')
@section('title', 'Édition Bordereau — DEL SARL')
@section('suite')

<div class="container py-4">
    <form action="{{ route('bordereau.update', $bordereau) }}" method="POST" id="formEditDocument" data-swal-confirm data-swal-title="Enregistrer les modifications ?" data-swal-text="Les informations du bordereau seront mises à jour." data-swal-confirm-text="Enregistrer">
        @csrf
        @method('PUT')

        <!-- En-tête de la page -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1 fw-bold text-dark">Modifier le bordereau</h1>
                <p class="text-muted mb-0">Bordereau n° : <strong>{{ $bordereau->num_bl }}</strong></p>
            </div>
            <a href="{{ route('bordereau.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Retour
            </a>
        </div>

        <!-- Informations Générales -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 fw-bold text-primary">
                    <i class="bi bi-file-earmark-text me-2"></i>Informations Générales
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Client <span class="text-danger">*</span></label>
                        <input type="text" name="client" class="form-control" value="{{ old('client', $bordereau->client) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Numéro</label>
                        <input type="text" class="form-control bg-light" value="{{ $bordereau->num_bl }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Date de livraison <span class="text-danger">*</span></label>
                        <input type="date" name="date_livraison" class="form-control" value="{{ old('date_livraison', $bordereau->date_livraison) }}" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Référence</label>
                        <input type="text" name="reference" class="form-control" value="{{ old('reference', $bordereau->reference) }}" placeholder="Référence optionnelle...">
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Articles livrés -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h2 class="h5 mb-0 fw-bold">Articles livrés</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;" class="text-center">#</th>
                                <th>Désignation</th>
                                <th style="width: 140px;">Quantité</th>
                                <th>Observations</th>
                                <th style="width: 60px;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyArticles">
                            @foreach($bordereau->articles as $index => $article)
                                <tr class="article-row">
                                    <td class="text-center row-number fw-bold text-muted">{{ $index + 1 }}</td>
                                    <td>
                                        <input type="text" name="articles[{{ $index }}][designation]" class="form-control" value="{{ old('articles.' . $index . '.designation', $article->designation) }}" required>
                                    </td>
                                    <td>
                                        <input type="number" name="articles[{{ $index }}][quantite]" class="form-control qte-input" min="1" value="{{ old('articles.' . $index . '.quantite', $article->quantite) }}" required>
                                    </td>
                                    <td>
                                        <input type="text" name="articles[{{ $index }}][observations]" class="form-control" value="{{ old('articles.' . $index . '.observations', $article->observations) }}" placeholder="Observations (optionnel)">
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row" title="Supprimer">
                                            &times;
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-sm btn-outline-success mt-2" id="btnAddRow">
                    + Ajouter un article
                </button>
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('bordereau.index') }}" class="btn btn-light border">Annuler</a>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </div>
    </form>
</div>

@endsection