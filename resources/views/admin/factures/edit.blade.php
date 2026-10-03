@extends('layouts.navbar')
@section('title', 'Édition Facture — DEL SARL')
@section('suite')

    <div class="container-fluid py-4">
        <form action="{{ route('facture.update', $facture) }}" method="POST" id="formEditDocument" novalidate>
            @csrf
            @method('PUT')

            <!-- En-tête de la page -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1 fw-bold text-dark">Modifier la facture</h1>
                    <p class="text-muted mb-0">Facture n° : <strong>{{ $facture->num_facture }}</strong></p>
                </div>
                <a href="{{ route('facture.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Retour
                </a>
            </div>

            <!-- Informations générales -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Client <span class="text-danger">*</span></label>
                            <input type="text" name="client" class="form-control"
                                value="{{ old('client', $facture->client) }}" required>
                            <div class="invalid-feedback">Le nom du client est requis.</div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Numéro</label>
                            <input type="text" class="form-control bg-light" value="{{ $facture->num_facture }}"
                                readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Date <span class="text-danger">*</span></label>
                            <input type="date" name="date_facture" class="form-control"
                                value="{{ old('date_facture', $facture->date_facture) }}" required>
                            <div class="invalid-feedback">La date est requise.</div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Statut</label>
                            <select name="statut_paiement" class="form-select">
                                <option value="unpaid"
                                    {{ old('statut_paiement', $facture->statut_paiement) === 'unpaid' ? 'selected' : '' }}>
                                    Non payée</option>
                                <option value="paid"
                                    {{ old('statut_paiement', $facture->statut_paiement) === 'paid' ? 'selected' : '' }}>
                                    Payée</option>
                                <option value="partial"
                                    {{ old('statut_paiement', $facture->statut_paiement) === 'partial' ? 'selected' : '' }}>
                                    Partielle</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Conditions</label>
                            <textarea name="conditions" class="form-control" rows="2">{{ old('conditions', $facture->conditions) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tableau des articles -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h2 class="h5 mb-0 fw-bold">Articles</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle" id="tableArticles">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;" class="text-center">#</th>
                                    <th>Désignation <span class="text-danger">*</span></th>
                                    <th style="width: 140px;">Quantité <span class="text-danger">*</span></th>
                                    <th style="width: 200px;">Prix unitaire <span class="text-danger">*</span></th>
                                    <th style="width: 180px;" class="text-end">Total</th>
                                    <th style="width: 60px;" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyArticles">
                                @foreach ($facture->articles as $index => $article)
                                    <tr class="article-row">
                                        <td class="text-center row-number fw-bold text-muted">{{ $index + 1 }}</td>
                                        <td>
                                            <input type="text" name="articles[{{ $index }}][designation]"
                                                class="form-control designation-input"
                                                value="{{ old('articles.' . $index . '.designation', $article->designation) }}"
                                                required>
                                            <div class="invalid-feedback">Désignation requise.</div>
                                        </td>
                                        <td>
                                            <input type="number" name="articles[{{ $index }}][quantite]"
                                                class="form-control qte-input" min="1"
                                                value="{{ old('articles.' . $index . '.quantite', $article->quantite) }}"
                                                required>
                                            <div class="invalid-feedback">Qté min : 1.</div>
                                        </td>
                                        <td>
                                            <input type="text" inputmode="decimal"
                                                name="articles[{{ $index }}][prix_unitaire]"
                                                class="form-control price-input format-thousands"
                                                value="{{ old('articles.' . $index . '.prix_unitaire', $article->prix_unitaire) }}"
                                                required>
                                            <div class="invalid-feedback">Prix > 0 requis.</div>
                                        </td>
                                        <td class="text-end fw-bold row-total">
                                            {{ number_format($article->quantite * $article->prix_unitaire, 0, ',', ' ') }}
                                            FCFA
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row"
                                                title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-success mt-2" id="btnAddRow">
                        <i class="bi bi-plus-lg me-1"></i> Ajouter un article
                    </button>
                </div>
            </div>

            <!-- Section TVA, Remise et Totaux -->
            <div class="row g-4 mb-4">
                <!-- Options Remise & TVA -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white py-3">
                            <h2 class="h6 mb-0 fw-bold">Taxe & Réduction</h2>
                        </div>
                        <div class="card-body">
                            <!-- Application Remise -->
                            <div class="mb-3 border-bottom pb-3">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" name="appliquer_remise"
                                        id="appliquer_remise" value="1"
                                        {{ old('appliquer_remise', $facture->appliquer_remise) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="appliquer_remise">Appliquer une
                                        remise</label>
                                </div>
                                <div class="input-group {{ old('appliquer_remise', $facture->appliquer_remise) ? '' : 'd-none' }}"
                                    id="container_remise">
                                    <span class="input-group-text">Remise (%)</span>
                                    <input type="number" name="remise_pourcentage" id="remise_pourcentage"
                                        class="form-control" min="0" max="100" step="0.1"
                                        value="{{ old('remise_pourcentage', $facture->remise_pourcentage ?? 0) }}">
                                    <div class="invalid-feedback">Pourcentage entre 0 et 100.</div>
                                </div>
                            </div>

                            <!-- Application TVA -->
                            <div>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" name="appliquer_tva"
                                        id="appliquer_tva" value="1"
                                        {{ old('appliquer_tva', $facture->appliquer_tva) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="appliquer_tva">Appliquer la
                                        TVA</label>
                                </div>
                                <div class="input-group {{ old('appliquer_tva', $facture->appliquer_tva) ? '' : 'd-none' }}"
                                    id="container_tva">
                                    <span class="input-group-text">TVA (%)</span>
                                    <input type="number" name="tva_pourcentage" id="tva_pourcentage"
                                        class="form-control" min="0" max="100" step="0.1"
                                        value="{{ old('tva_pourcentage', $facture->tva_pourcentage ?? 18) }}">
                                    <div class="invalid-feedback">Pourcentage entre 0 et 100.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calcul du Récapitulatif -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white py-3">
                            <h2 class="h6 mb-0 fw-bold">Récapitulatif Financier</h2>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Sous-total HT :</span>
                                <span class="fw-bold" id="disp_subtotal">0 FCFA</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 text-danger d-none" id="row_remise">
                                <span>Remise (<span id="disp_remise_pct">0</span>%) :</span>
                                <span class="fw-bold" id="disp_remise_val">-0 FCFA</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 text-primary d-none" id="row_tva">
                                <span>TVA (<span id="disp_tva_pct">18</span>%) :</span>
                                <span class="fw-bold" id="disp_tva_val">+0 FCFA</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0 fw-bold">Grand Total TTC :</span>
                                <span class="h4 mb-0 fw-bold text-success" id="disp_grand_total">0 FCFA</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('facture.index') }}" class="btn btn-light border">Annuler</a>
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </div>
        </form>
    </div>

    <!-- Template HTML pour ligne article -->
    <template id="rowTemplate">
        <tr class="article-row">
            <td class="text-center row-number fw-bold text-muted"></td>
            <td>
                <input type="text" class="form-control designation-input" required>
                <div class="invalid-feedback">Désignation requise.</div>
            </td>
            <td>
                <input type="number" class="form-control qte-input" min="1" value="1" required>
                <div class="invalid-feedback">Qté min : 1.</div>
            </td>
            <td>
                <input type="text" inputmode="decimal" class="form-control price-input format-thousands"
                    value="0" required>
                <div class="invalid-feedback">Prix > 0 requis.</div>
            </td>
            <td class="text-end fw-bold row-total">0 FCFA</td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-outline-danger btn-remove-row" title="Supprimer">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
    </template>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('formEditDocument');
            const tbody = document.getElementById('tbodyArticles');
            const btnAddRow = document.getElementById('btnAddRow');
            const template = document.getElementById('rowTemplate');

            // Éléments TVA / Remise
            const chkRemise = document.getElementById('appliquer_remise');
            const containerRemise = document.getElementById('container_remise');
            const inputRemise = document.getElementById('remise_pourcentage');

            const chkTva = document.getElementById('appliquer_tva');
            const containerTva = document.getElementById('container_tva');
            const inputTva = document.getElementById('tva_pourcentage');

            // Affichage Récapitulatif
            const dispSubtotal = document.getElementById('disp_subtotal');
            const rowRemise = document.getElementById('row_remise');
            const dispRemisePct = document.getElementById('disp_remise_pct');
            const dispRemiseVal = document.getElementById('disp_remise_val');
            const rowTva = document.getElementById('row_tva');
            const dispTvaPct = document.getElementById('disp_tva_pct');
            const dispTvaVal = document.getElementById('disp_tva_val');
            const dispGrandTotal = document.getElementById('disp_grand_total');

            // Fonctions utilitaires de formatage
            const formatFCFA = (val) => new Intl.NumberFormat('fr-FR').format(val.toFixed(2)) + ' FCFA';

            // Convertit une chaîne avec espaces "1 500 000,5" en nombre pur float 1500000.5
            function parseFormattedNumber(val) {
                if (!val) return 0;
                const clean = val.toString().replace(/\s/g, '').replace(',', '.');
                return parseFloat(clean) || 0;
            }

            // Formate une valeur saisie avec séparateurs de milliers
            function formatInputField(input) {
                let value = input.value.replace(/\s/g, '').replace(',', '.');
                if (!value) return;

                const parts = value.split('.');
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

                // Limiter les décimales à 2
                if (parts[1] !== undefined) {
                    parts[1] = parts[1].substring(0, 2);
                    input.value = parts.join(',');
                } else {
                    input.value = parts[0];
                }
            }

            // 1.Comparaison des données du formulaire
            function getFormDataSerialized(formElement) {
                const formData = new FormData(formElement);

                // Normaliser les prix pour éviter les faux changements
                formElement.querySelectorAll('.price-input').forEach(input => {
                    if (input.name) {
                        formData.set(input.name, parseFormattedNumber(input.value).toString());
                    }
                });

                return new URLSearchParams(formData).toString();
            }

            // 2. Calcul Global
            function calculateTotals() {
                let subtotal = 0;

                tbody.querySelectorAll('.article-row').forEach(row => {
                    const qte = parseFloat(row.querySelector('.qte-input').value) || 0;
                    const price = parseFormattedNumber(row.querySelector('.price-input').value);
                    const rowTotal = qte * price;
                    row.querySelector('.row-total').textContent = formatFCFA(rowTotal);
                    subtotal += rowTotal;
                });

                dispSubtotal.textContent = formatFCFA(subtotal);

                // Remise
                let montantRemise = 0;
                if (chkRemise.checked) {
                    containerRemise.classList.remove('d-none');
                    rowRemise.classList.remove('d-none');
                    const pctRemise = parseFloat(inputRemise.value) || 0;
                    dispRemisePct.textContent = pctRemise;
                    montantRemise = subtotal * (pctRemise / 100);
                    dispRemiseVal.textContent = '-' + formatFCFA(montantRemise);
                } else {
                    containerRemise.classList.add('d-none');
                    rowRemise.classList.add('d-none');
                }

                const htApresRemise = subtotal - montantRemise;

                // TVA
                let montantTva = 0;
                if (chkTva.checked) {
                    containerTva.classList.remove('d-none');
                    rowTva.classList.remove('d-none');
                    const pctTva = parseFloat(inputTva.value) || 0;
                    dispTvaPct.textContent = pctTva;
                    montantTva = htApresRemise * (pctTva / 100);
                    dispTvaVal.textContent = '+' + formatFCFA(montantTva);
                } else {
                    containerTva.classList.add('d-none');
                    rowTva.classList.add('d-none');
                }

                const grandTotal = htApresRemise + montantTva;
                dispGrandTotal.textContent = formatFCFA(grandTotal);
            }

            // 3. Mise à jour des index d'articles
            function updateRowIndexes() {
                const rows = tbody.querySelectorAll('.article-row');
                rows.forEach((row, index) => {
                    row.querySelector('.row-number').textContent = index + 1;
                    row.querySelector('.designation-input').name = `articles[${index}][designation]`;
                    row.querySelector('.qte-input').name = `articles[${index}][quantite]`;
                    row.querySelector('.price-input').name = `articles[${index}][prix_unitaire]`;
                    row.querySelector('.btn-remove-row').disabled = rows.length === 1;
                });
                calculateTotals();
            }

            // 4. Événements de formatage dynamique des nombres
            tbody.addEventListener('input', function(e) {
                if (e.target.classList.contains('format-thousands')) {
                    formatInputField(e.target);
                }
                calculateTotals();
            });

            // Événements TVA & Remise
            chkRemise.addEventListener('change', calculateTotals);
            chkTva.addEventListener('change', calculateTotals);
            inputRemise.addEventListener('input', calculateTotals);
            inputTva.addEventListener('input', calculateTotals);

            // 5. Gestion des lignes
            btnAddRow.addEventListener('click', function() {
                const clone = template.content.cloneNode(true);
                tbody.appendChild(clone);
                updateRowIndexes();
            });

            tbody.addEventListener('click', function(e) {
                const btnRemove = e.target.closest('.btn-remove-row');
                if (btnRemove && tbody.querySelectorAll('.article-row').length > 1) {
                    btnRemove.closest('.article-row').remove();
                    updateRowIndexes();
                }
            });

            // 6. Validation stricte côté client
            function validateForm() {
                let isValid = true;

                form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

                form.querySelectorAll('[required]').forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    }
                });

                tbody.querySelectorAll('.article-row').forEach(row => {
                    const desig = row.querySelector('.designation-input');
                    const qte = row.querySelector('.qte-input');
                    const price = row.querySelector('.price-input');
                    const numericPrice = parseFormattedNumber(price.value);

                    if (!desig.value.trim()) {
                        desig.classList.add('is-invalid');
                        isValid = false;
                    }

                    if (!qte.value || parseFloat(qte.value) < 1) {
                        qte.classList.add('is-invalid');
                        isValid = false;
                    }

                    if (!price.value || numericPrice <= 0) {
                        price.classList.add('is-invalid');
                        isValid = false;
                    }
                });

                if (chkRemise.checked) {
                    const val = parseFloat(inputRemise.value);
                    if (isNaN(val) || val < 0 || val > 100) {
                        inputRemise.classList.add('is-invalid');
                        isValid = false;
                    }
                }

                if (chkTva.checked) {
                    const val = parseFloat(inputTva.value);
                    if (isNaN(val) || val < 0 || val > 100) {
                        inputTva.classList.add('is-invalid');
                        isValid = false;
                    }
                }

                return isValid;
            }

            // 7. Nettoyer les prix (enlever les espaces) avant envoi vers Laravel
            function sanitizePricesForSubmission() {
                tbody.querySelectorAll('.price-input').forEach(input => {
                    input.value = parseFormattedNumber(input.value);
                });
            }

            // 8. Soumission du formulaire
          // 8. Soumission du formulaire
form.addEventListener('submit', function (e) {
    e.preventDefault();

    // Vérifier la validité des champs
    if (!validateForm()) {
        Swal.fire({
            icon: 'error',
            title: 'Formulaire invalide',
            text: 'Veuillez corriger les champs en rouge avant d\'enregistrer.',
            confirmButtonText: 'Compris'
        });
        return;
    }

    // Comparer les données initiales et actuelles
    const currentFormData = getFormDataSerialized(form);

    // Aucune modification détectée
    if (initialFormData === currentFormData) {
        Swal.fire({
            icon: 'info',
            title: 'Aucune modification',
            text: 'Vous n\'avez effectué aucune modification sur cette facture.',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Des modifications ont été détectées
    Swal.fire({
        title: 'Enregistrer les modifications ?',
        text: 'Les informations et le récapitulatif financier seront mis à jour.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Enregistrer',
        cancelButtonText: 'Annuler',
        customClass: {
            confirmButton: 'btn btn-primary me-2',
            cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {

            // Nettoyer les prix avant l'envoi vers Laravel
            sanitizePricesForSubmission();

            // Envoyer le formulaire
            form.submit();
        }
    });
});

            // Initialisation : Formater les prix au chargement initial
            tbody.querySelectorAll('.price-input').forEach(input => formatInputField(input));
            updateRowIndexes();

            // Sauvegarder l'état initial après toutes les initialisations
            const initialFormData = getFormDataSerialized(form);
        });
    </script>

@endsection
