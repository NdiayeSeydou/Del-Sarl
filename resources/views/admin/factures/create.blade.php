@extends('layouts.navbar')
@section('title', 'Création d\'une facture — DEL SARL')
@section('suite')

    <div class="container-fluid py-4">
        <form action="{{ route('facture.store') }}" method="POST" id="formCreateFacture">
            @csrf

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h3 class="mb-1 fw-bold text-dark">Nouvelle Facturation</h3>
                    <p class="text-muted mb-0">Saisissez les détails pour générer une facture définitive.</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Section 1 : Informations Générales -->
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3 border-bottom-0">
                            <h5 class="card-title mb-0 fw-bold text-primary">
                                <i class="bi bi-file-earmark-spreadsheet me-2"></i>Informations Générales
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Client <span class="text-danger">*</span></label>
                                    <input type="text" name="client"
                                        class="form-control @error('client') is-invalid @enderror"
                                        value="{{ old('client') }}"
                                        placeholder="ex: MINISTÈRE DE L'ADMINISTRATION TERRITORIALE" required>
                                    @error('client')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold">N° Facture (Auto)</label>
                                    <input type="text" name="num_facture" class="form-control bg-light" readonly
                                        placeholder="FAC-2026-XXXX">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold">Date d'émission <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="date_facture"
                                        class="form-control @error('date_facture') is-invalid @enderror"
                                        value="{{ old('date_facture', date('Y-m-d')) }}" required>
                                    @error('date_facture')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold">Date d'échéance</label>
                                    <input type="date" name="date_echeance" class="form-control"
                                        value="{{ old('date_echeance') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold">Statut<span class="text-danger">*</span></label>
                                    <select name="statut_paiement" id="statutPaiement"
                                        class="form-select @error('statut_paiement') is-invalid @enderror">
                                        <option value="unpaid" {{ old('statut_paiement') == 'unpaid' ? 'selected' : '' }}>
                                            Non payée</option>
                                        <option value="paid" {{ old('statut_paiement') == 'paid' ? 'selected' : '' }}>
                                            Payée</option>
                                        <option value="partial" {{ old('statut_paiement') == 'partial' ? 'selected' : '' }}>
                                            Partiellement payée</option>
                                    </select>
                                    @error('statut_paiement')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Champ dynamique : Montant payé (Si paiement partiel) -->
                                <div class="col-md-3 ms-auto" id="containerMontantPaye"
                                    style="display: {{ old('statut_paiement') == 'partial' ? 'block' : 'none' }};">
                                    <label class="form-label fw-semibold text-primary">Montant Acompte Réceptionné (FCFA)
                                        <span class="text-danger">*</span></label>
                                    <input type="text" name="montant_paye" id="montantPaye"
                                        class="form-control money-input @error('montant_paye') is-invalid @enderror"
                                        value="{{ old('montant_paye') }}" placeholder="0">
                                    @error('montant_paye')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2 : Liste des Articles -->
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm">
                        <div
                            class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom-0">
                            <h5 class="card-title mb-0 fw-bold text-primary">
                                <i class="bi bi-list-check me-2"></i>Désignation des Articles & Prestations
                            </h5>
                            <button type="button" class="btn btn-sm btn-light-primary text-primary fw-semibold"
                                id="btnAddRow">
                                <i class="bi bi-plus-circle me-1"></i>Ajouter une ligne
                            </button>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0" id="tableFacture">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 50px;" class="text-center">N°</th>
                                            <th>Désignation <span class="text-danger">*</span></th>
                                            <th style="width: 130px;">Qté <span class="text-danger">*</span></th>
                                            <th style="width: 220px;">Prix unitaire (FCFA) <span
                                                    class="text-danger">*</span></th>
                                            <th style="width: 220px;" class="text-end">Prix total (FCFA)</th>
                                            <th style="width: 60px;" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyArticles">
                                        @php
                                            $oldArticles = old('articles', [
                                                ['designation' => '', 'quantite' => 1, 'prix_unitaire' => ''],
                                            ]);
                                        @endphp
                                        @foreach ($oldArticles as $index => $art)
                                            <tr class="article-row">
                                                <td class="text-center row-number fw-bold text-muted">{{ $index + 1 }}
                                                </td>
                                                <td>
                                                    <input type="text" name="articles[{{ $index }}][designation]"
                                                        class="form-control @error('articles.' . $index . '.designation') is-invalid @enderror"
                                                        value="{{ $art['designation'] }}"
                                                        placeholder="ex: Fourniture d'équipements informatiques" required>
                                                </td>
                                                <td>
                                                    <input type="number" name="articles[{{ $index }}][quantite]"
                                                        class="form-control qte-input @error('articles.' . $index . '.quantite') is-invalid @enderror"
                                                        min="1" value="{{ $art['quantite'] }}" required>
                                                </td>
                                                <td>
                                                    <input type="text"
                                                        name="articles[{{ $index }}][prix_unitaire]"
                                                        class="form-control price-input money-input @error('articles.' . $index . '.prix_unitaire') is-invalid @enderror"
                                                        value="{{ $art['prix_unitaire'] }}" placeholder="0" required>
                                                </td>
                                                <td class="text-end fw-bold text-dark row-total">0 FCFA</td>
                                                <td class="text-center">
                                                    <button type="button"
                                                        class="btn btn-ghost btn-icon btn-sm text-danger btn-remove-row"
                                                        title="Supprimer">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3 : Ajustements Financiers -->
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white py-3 border-bottom-0">
                                    <h5 class="card-title mb-0 fw-bold text-primary">
                                        <i class="bi bi-percent me-2"></i>TVA & Remises Optionnelles
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" id="checkTVA"
                                                    name="appliquer_tva" {{ old('appliquer_tva') ? 'checked' : '' }}>
                                                <label class="form-check-label fw-semibold" for="checkTVA">Activer la
                                                    TVA</label>
                                            </div>
                                            <div id="tvaInputContainer"
                                                style="display: {{ old('appliquer_tva') ? 'block' : 'none' }};">
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">Taux TVA</span>
                                                    <input type="number" id="inputTVA" name="tva_pourcentage"
                                                        class="form-control" value="{{ old('tva_pourcentage', 18) }}"
                                                        min="0" max="100" step="any">
                                                    <span class="input-group-text bg-light">%</span>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="my-2">

                                        <div class="col-12">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" id="checkRemise"
                                                    name="appliquer_remise"
                                                    {{ old('appliquer_remise') ? 'checked' : '' }}>
                                                <label class="form-check-label fw-semibold" for="checkRemise">Activer une
                                                    remise</label>
                                            </div>
                                            <div id="remiseInputContainer"
                                                style="display: {{ old('appliquer_remise') ? 'block' : 'none' }};">
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light">Remise</span>
                                                    <input type="number" id="inputRemise" name="remise_pourcentage"
                                                        class="form-control" value="{{ old('remise_pourcentage', 0) }}"
                                                        min="0" max="100" step="any">
                                                    <span class="input-group-text bg-light">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4 d-flex flex-column justify-content-center">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Total HT :</span>
                                        <span class="fw-semibold text-dark" id="subtotalHT">0 FCFA</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2 text-danger" id="rowRemise"
                                        style="display: none;">
                                        <span>Remise appliquée :</span>
                                        <span class="fw-semibold" id="amountRemise">-0 FCFA</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3 text-dark" id="rowTVA"
                                        style="display: none;">
                                        <span class="text-muted">Montant TVA :</span>
                                        <span class="fw-semibold" id="amountTVA">0 FCFA</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-dark fs-5" id="labelFinalTotal">TOTAL HT :</span>
                                        <span class="fw-bold text-primary fs-4" id="grandTotal">0 FCFA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4 : Mentions Légales -->
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3 border-bottom-0">
                            <h5 class="card-title mb-0 fw-bold text-primary">
                                <i class="bi bi-fonts me-2"></i>Arrêté de la Facture & Mentions Légales
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Arrêtée la présente facture à la somme de
                                        :</label>
                                    <input type="text" id="montantLettres" name="montant_lettres"
                                        class="form-control bg-light" readonly value="{{ old('montant_lettres') }}"
                                        placeholder="Calcul automatique du montant en lettres...">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Conditions de règlement & Coordonnées
                                        bancaires</label>
                                    <textarea name="conditions" class="form-control" rows="3">{{ old('conditions', "Arrêtée la présente facture à la somme indiquée ci-dessus en francs CFA.\nRèglement par chèque ou par virement bancaire.\nPaiement à effectuer dès réception de la facture.") }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 text-end mb-4">
                    <a href="{{ route('facture.index') }}" class="btn btn-outline-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">
                         Enregistrer la Facture
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tbody = document.getElementById('tbodyArticles');
            const btnAdd = document.getElementById('btnAddRow');

            const subtotalHTEl = document.getElementById('subtotalHT');
            const grandTotalEl = document.getElementById('grandTotal');
            const labelFinalTotalEl = document.getElementById('labelFinalTotal');
            const montantLettresInput = document.getElementById('montantLettres');

            const checkTVA = document.getElementById('checkTVA');
            const tvaInputContainer = document.getElementById('tvaInputContainer');
            const inputTVA = document.getElementById('inputTVA');
            const rowTVA = document.getElementById('rowTVA');
            const amountTVAEl = document.getElementById('amountTVA');

            const checkRemise = document.getElementById('checkRemise');
            const remiseInputContainer = document.getElementById('remiseInputContainer');
            const inputRemise = document.getElementById('inputRemise');
            const rowRemise = document.getElementById('rowRemise');
            const amountRemiseEl = document.getElementById('amountRemise');

            const selectStatut = document.getElementById('statutPaiement');
            const containerMontantPaye = document.getElementById('containerMontantPaye');

            // Gestion de l'affichage du champ "Montant Payé"
            selectStatut.addEventListener('change', function() {
                if (this.value === 'partial') {
                    containerMontantPaye.style.display = 'block';
                } else {
                    containerMontantPaye.style.display = 'none';
                }
            });

            // Formateur de milliers dynamique pendant la saisie
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('money-input')) {
                    let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/g, '');
                    if (value) {
                        e.target.value = new Intl.NumberFormat('fr-FR').format(value);
                    } else {
                        e.target.value = '';
                    }
                }
            });

            // Sécurité lors de la soumission : nettoyage des espaces avant l'envoi HTTP
            document.getElementById('formCreateFacture').addEventListener('submit', function() {
                document.querySelectorAll('.money-input').forEach(function(input) {
                    input.value = input.value.replace(/\s+/g, '');
                });
            });

            function numberToWordsFR(num) {
                if (num === 0) return 'zéro';
                const units = ['', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf'];
                const teens = ['dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept',
                    'dix-huit', 'dix-neuf'
                ];
                const tens = ['', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante-dix',
                    'quatre-vingts', 'quatre-vingt-dix'
                ];

                function convertGroup(n) {
                    let res = '',
                        h = Math.floor(n / 100),
                        r = n % 100;
                    if (h > 0) res += (h === 1 ? 'cent ' : units[h] + ' cent ');
                    if (r > 0) {
                        if (r < 10) res += units[r];
                        else if (r < 20) res += teens[r - 10];
                        else {
                            let t = Math.floor(r / 10),
                                u = r % 10;
                            if (t === 7) res += 'soixante-' + teens[u];
                            else if (t === 9) res += 'quatre-vingt-' + teens[u];
                            else res += tens[t] + (u === 1 ? ' et un' : (u > 0 ? '-' + units[u] : ''));
                        }
                    }
                    return res.trim();
                }

                let billions = Math.floor(num / 1000000000),
                    millions = Math.floor((num % 1000000000) / 1000000),
                    thousands = Math.floor((num % 1000000) / 1000),
                    remainder = Math.floor(num % 1000);
                let result = '';
                if (billions > 0) result += convertGroup(billions) + (billions > 1 ? ' milliards ' : ' milliard ');
                if (millions > 0) result += convertGroup(millions) + (millions > 1 ? ' millions ' : ' million ');
                if (thousands > 0) result += (thousands === 1 ? 'mille ' : convertGroup(thousands) + ' mille ');
                if (remainder > 0) result += convertGroup(remainder);
                return result.trim();
            }

            function capitalize(str) {
                return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
            }

            function formatMoney(amount) {
                return new Intl.NumberFormat('fr-FR').format(Math.round(amount)) + ' FCFA';
            }

            function calculateTotals() {
                const rows = tbody.querySelectorAll('.article-row');
                let rawSubtotalHT = 0;

                rows.forEach((row, index) => {
                    row.querySelector('.row-number').textContent = index + 1;
                    const inputs = row.querySelectorAll('input');
                    inputs[0].name = `articles[${index}][designation]`;
                    inputs[1].name = `articles[${index}][quantite]`;
                    inputs[2].name = `articles[${index}][prix_unitaire]`;

                    const qty = parseFloat(inputs[1].value) || 0;
                    const unitPrice = parseFloat(inputs[2].value.replace(/\s+/g, '')) || 0;
                    const lineTotal = qty * unitPrice;

                    row.querySelector('.row-total').textContent = formatMoney(lineTotal);
                    rawSubtotalHT += lineTotal;
                });

                subtotalHTEl.textContent = formatMoney(rawSubtotalHT);

                let netHT = rawSubtotalHT;
                if (checkRemise.checked) {
                    remiseInputContainer.style.display = 'block';
                    rowRemise.style.display = 'flex';
                    const remisePercent = parseFloat(inputRemise.value) || 0;
                    const remiseAmount = (rawSubtotalHT * remisePercent) / 100;
                    netHT = rawSubtotalHT - remiseAmount;
                    amountRemiseEl.textContent = '-' + formatMoney(remiseAmount);
                } else {
                    remiseInputContainer.style.display = 'none';
                    rowRemise.style.display = 'none';
                }

                let finalTotal = netHT;
                let isTVAApplied = false;

                if (checkTVA.checked) {
                    tvaInputContainer.style.display = 'block';
                    rowTVA.style.display = 'flex';
                    const tvaPercent = parseFloat(inputTVA.value) || 0;
                    const tvaAmount = (netHT * tvaPercent) / 100;
                    finalTotal = netHT + tvaAmount;
                    amountTVAEl.textContent = formatMoney(tvaAmount);
                    labelFinalTotalEl.textContent = 'TOTAL TTC :';
                    isTVAApplied = true;
                } else {
                    tvaInputContainer.style.display = 'none';
                    rowTVA.style.display = 'none';
                    labelFinalTotalEl.textContent = 'TOTAL HT :';
                }

                grandTotalEl.textContent = formatMoney(finalTotal);

                const finalAmountInt = Math.round(finalTotal);
                if (finalAmountInt > 0) {
                    let inWords = capitalize(numberToWordsFR(finalAmountInt));
                    let formattedAmount = new Intl.NumberFormat('fr-FR').format(finalAmountInt);
                    let taxMention = isTVAApplied ? 'TTC' : 'hors taxes';
                    montantLettresInput.value = `${inWords} (${formattedAmount}) francs CFA ${taxMention}.`;
                } else {
                    montantLettresInput.value = '';
                }
            }

            checkTVA.addEventListener('change', calculateTotals);
            inputTVA.addEventListener('input', calculateTotals);
            checkRemise.addEventListener('change', calculateTotals);
            inputRemise.addEventListener('input', calculateTotals);

            tbody.addEventListener('input', function(e) {
                if (e.target.classList.contains('qte-input') || e.target.classList.contains(
                        'price-input')) {
                    calculateTotals();
                }
            });

            btnAdd.addEventListener('click', function() {
                const rowCount = tbody.querySelectorAll('.article-row').length;
                const newRow = document.createElement('tr');
                newRow.className = 'article-row';
                newRow.innerHTML = `
            <td class="text-center row-number fw-bold text-muted">${rowCount + 1}</td>
            <td><input type="text" class="form-control" placeholder="Désignation" required></td>
            <td><input type="number" class="form-control qte-input" min="1" value="1" required></td>
            <td><input type="text" class="form-control price-input money-input" placeholder="0" required></td>
            <td class="text-end fw-bold text-dark row-total">0 FCFA</td>
            <td class="text-center">
                <button type="button" class="btn btn-ghost btn-icon btn-sm text-danger btn-remove-row" title="Supprimer">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;
                tbody.appendChild(newRow);
                calculateTotals();
            });

            tbody.addEventListener('click', function(e) {
                if (e.target.closest('.btn-remove-row')) {
                    const rows = tbody.querySelectorAll('.article-row');
                    if (rows.length > 1) {
                        e.target.closest('.article-row').remove();
                        calculateTotals();
                    } else {
                        alert('La facture doit comporter au moins un article.');
                    }
                }
            });

            calculateTotals();
        });
    </script>
@endsection
