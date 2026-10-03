@extends('layouts.navbar')

@section('title', 'Édition Proforma — DEL SARL')

@section('suite')

<div class="container py-4">

    <form action="{{ route('proforma.update', $proforma) }}"
          method="POST"
          id="formEditDocument"
          data-swal-confirm
          data-swal-title="Enregistrer les modifications ?"
          data-swal-text="Les informations de la proforma seront mises à jour."
          data-swal-confirm-text="Enregistrer">

        @csrf
        @method('PUT')

        {{-- En-tête --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="h3 mb-1 fw-bold text-dark">
                    Modifier la proforma
                </h1>

                <p class="text-muted mb-0">
                    Proforma n° :
                    <strong>{{ $proforma->num_proforma }}</strong>
                </p>
            </div>

            <a href="{{ route('proforma.index') }}"
               class="btn btn-outline-secondary">
                
                Retour
            </a>

        </div>

        {{-- Messages de validation --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Informations générales --}}
        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 fw-bold text-primary">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Informations générales
                </h5>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    {{-- Client --}}
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">
                            Client / Destinataire
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="client"
                            class="form-control"
                            value="{{ old('client', $proforma->client) }}"
                            required
                        >
                    </div>

                    {{-- Numéro automatique --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">
                            N° Document
                        </label>

                        <input
                            type="text"
                            class="form-control bg-light"
                            value="{{ $proforma->num_proforma }}"
                            readonly
                        >
                    </div>

                    {{-- Date --}}
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">
                            Date
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="date"
                            name="date_proforma"
                            class="form-control"
                            value="{{ old('date_proforma', \Carbon\Carbon::parse($proforma->date_proforma)->format('Y-m-d')) }}"
                            required
                        >
                    </div>

                    {{-- Devise --}}
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">
                            Devise
                        </label>

                        <select name="devise" class="form-select">
                            <option value="XOF" {{ old('devise', $proforma->devise) === 'XOF' ? 'selected' : '' }}>
                                XOF
                            </option>

                            <option value="EUR" {{ old('devise', $proforma->devise) === 'EUR' ? 'selected' : '' }}>
                                EUR
                            </option>

                            <option value="USD" {{ old('devise', $proforma->devise) === 'USD' ? 'selected' : '' }}>
                                USD
                            </option>
                        </select>
                    </div>

                    {{-- Remarques --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">
                            Remarques
                        </label>

                        <textarea
                            name="remarques"
                            class="form-control"
                            rows="3"
                        >{{ old('remarques', $proforma->remarques) }}</textarea>
                    </div>

                </div>

            </div>
        </div>

        {{-- Articles --}}
        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">

                <h2 class="h5 mb-0 fw-bold">
                    <i class="bi bi-box-seam me-2"></i>
                    Articles
                </h2>

                <span class="badge bg-primary" id="articleCount">
                    {{ count(old('articles', $proforma->articles)) }} article(s)
                </span>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;" class="text-center">#</th>
                                <th>Désignation</th>
                                <th style="width: 140px;">Quantité</th>
                                <th style="width: 180px;">Prix unitaire</th>
                                <th style="width: 180px;" class="text-end">Total</th>
                                <th style="width: 70px;" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody id="tbodyArticles">

                            @php
                                $articlesForm = old('articles', $proforma->articles->toArray());
                            @endphp

                            @foreach($articlesForm as $index => $article)

                                <tr class="article-row">

                                    <td class="text-center row-number fw-bold text-muted">
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- Désignation --}}
                                    <td>
                                        <input
                                            type="text"
                                            name="articles[{{ $index }}][designation]"
                                            class="form-control designation-input"
                                            value="{{ old('articles.' . $index . '.designation', data_get($article, 'designation')) }}"
                                            placeholder="Désignation de l'article"
                                            required
                                        >
                                    </td>

                                    {{-- Quantité --}}
                                    <td>
                                        <input
                                            type="number"
                                            name="articles[{{ $index }}][quantite]"
                                            class="form-control qte-input"
                                            min="1"
                                            step="1"
                                            value="{{ old('articles.' . $index . '.quantite', data_get($article, 'quantite')) }}"
                                            required
                                        >
                                    </td>

                                    {{-- Prix unitaire --}}
                                    <td>
                                        <input
                                            type="number"
                                            name="articles[{{ $index }}][prix_unitaire]"
                                            class="form-control price-input"
                                            min="0"
                                            step="0.01"
                                            value="{{ old('articles.' . $index . '.prix_unitaire', data_get($article, 'prix_unitaire')) }}"
                                            required
                                        >
                                    </td>

                                    {{-- Total --}}
                                    <td class="text-end fw-bold row-total">
                                        {{ number_format((float) data_get($article, 'quantite') * (float) data_get($article, 'prix_unitaire'), 0, ',', ' ') }}
                                    </td>

                                    {{-- Suppression --}}
                                    <td class="text-center">
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger btn-remove-row"
                                            title="Supprimer cet article">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                        <tfoot class="table-light">

                            <tr>
                                <td colspan="4" class="text-end fw-bold">
                                    Total des articles :
                                </td>

                                <td class="text-end fw-bold text-primary"
                                    id="grandTotalArticles">
                                    0
                                </td>

                                <td></td>
                            </tr>

                        </tfoot>

                    </table>

                </div>

                {{-- Ajouter un article --}}
                <button
                    type="button"
                    class="btn btn-sm btn-outline-success mt-2"
                    id="btnAddRow">

                    <i class="bi bi-plus-circle me-1"></i>
                    Ajouter un article

                </button>

            </div>
        </div>

        

        {{-- Boutons d'action --}}
        <div class="d-flex justify-content-end gap-2">

            <a href="{{ route('proforma.index') }}"
               class="btn btn-light border">

              
                Annuler

            </a>

            <button type="submit" class="btn btn-primary">

          
                Enregistrer les modifications

            </button>

        </div>

    </form>

</div>

{{-- JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const tbody = document.getElementById('tbodyArticles');
    const btnAddRow = document.getElementById('btnAddRow');
    const articleCount = document.getElementById('articleCount');
    const grandTotalArticles = document.getElementById('grandTotalArticles');

    const devise = @json($proforma->devise);

    let index = tbody.querySelectorAll('.article-row').length;

    // Formatage des montants
    function formatMontant(montant) {
        return new Intl.NumberFormat('fr-FR', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2
        }).format(montant) + ' ' + devise;
    }

    // Calcul du total d'une ligne
    function calculerLigne(row) {

        const quantite = parseFloat(row.querySelector('.qte-input').value) || 0;
        const prix = parseFloat(row.querySelector('.price-input').value) || 0;

        const total = quantite * prix;

        row.querySelector('.row-total').textContent = formatMontant(total);

        return total;
    }

    // Recalcul général
    function recalculerTout() {

        let totalGeneral = 0;

        const rows = tbody.querySelectorAll('.article-row');

        rows.forEach((row, position) => {

            row.querySelector('.row-number').textContent = position + 1;

            totalGeneral += calculerLigne(row);

        });

        articleCount.textContent = rows.length + ' article(s)';

        grandTotalArticles.textContent = formatMontant(totalGeneral);
    }

    // Réorganiser les noms des champs
    function renumeroterChamps() {

        const rows = tbody.querySelectorAll('.article-row');

        rows.forEach((row, position) => {

            row.querySelector('.designation-input')
                .name = `articles[${position}][designation]`;

            row.querySelector('.qte-input')
                .name = `articles[${position}][quantite]`;

            row.querySelector('.price-input')
                .name = `articles[${position}][prix_unitaire]`;

        });

        index = rows.length;

    }

    // Ajouter une ligne
    btnAddRow.addEventListener('click', function () {

        const row = document.createElement('tr');

        row.classList.add('article-row');

        row.innerHTML = `
            <td class="text-center row-number fw-bold text-muted"></td>

            <td>
                <input
                    type="text"
                    name="articles[${index}][designation]"
                    class="form-control designation-input"
                    placeholder="Désignation de l'article"
                    required
                >
            </td>

            <td>
                <input
                    type="number"
                    name="articles[${index}][quantite]"
                    class="form-control qte-input"
                    min="1"
                    step="1"
                    value="1"
                    required
                >
            </td>

            <td>
                <input
                    type="number"
                    name="articles[${index}][prix_unitaire]"
                    class="form-control price-input"
                    min="0"
                    step="0.01"
                    value="0"
                    required
                >
            </td>

            <td class="text-end fw-bold row-total">
                ${formatMontant(0)}
            </td>

            <td class="text-center">
                <button
                    type="button"
                    class="btn btn-sm btn-outline-danger btn-remove-row"
                    title="Supprimer cet article">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;

        tbody.appendChild(row);

        index++;

        recalculerTout();

        row.querySelector('.designation-input').focus();

    });

    // Supprimer une ligne
    tbody.addEventListener('click', function (event) {

        const button = event.target.closest('.btn-remove-row');

        if (!button) {
            return;
        }

        const rows = tbody.querySelectorAll('.article-row');

        if (rows.length <= 1) {

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Action impossible',
                    text: 'Une proforma doit contenir au moins un article.'
                });
            } else {
                alert('Une proforma doit contenir au moins un article.');
            }

            return;
        }

        button.closest('.article-row').remove();

        renumeroterChamps();

        recalculerTout();

    });

    // Recalcul lors de la saisie
    tbody.addEventListener('input', function (event) {

        if (
            event.target.classList.contains('qte-input') ||
            event.target.classList.contains('price-input')
        ) {
            recalculerTout();
        }

    });

    // Initialisation
    recalculerTout();

    // Vérification avant envoi
    document.getElementById('formEditDocument').addEventListener('submit', function (event) {

        const rows = tbody.querySelectorAll('.article-row');

        if (rows.length === 0) {

            event.preventDefault();

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Aucun article',
                    text: 'Veuillez ajouter au moins un article avant de continuer.'
                });
            } else {
                alert('Veuillez ajouter au moins un article.');
            }

        }

    });

});
</script>

@endsection
