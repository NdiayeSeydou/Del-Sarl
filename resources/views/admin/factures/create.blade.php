@extends('layouts.navbar')
@section('title', 'Création d\'une facture — DEL SARL')
@section('suite')

<div class="container-fluid py-4">
    <form action="#" method="POST" id="formCreateFacture">
        <!-- En-tête de la page avec boutons d'action -->
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
                                <input type="text" name="client" class="form-control" placeholder="ex: MINISTÈRE DE L'ADMINISTRATION TERRITORIALE" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">N° Facture (Auto)</label>
                                <input type="text" name="num_facture" class="form-control bg-light" readonly placeholder="FAC-2026-XXXX">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Date d'émission <span class="text-danger">*</span></label>
                                <input type="date" name="date_facture" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Date d'échéance</label>
                                <input type="date" name="date_echeance" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Statut du paiement</label>
                                <select name="statut_paiement" class="form-select">
                                    <option value="unpaid" selected>Non payée</option>
                                    <option value="paid">Payée</option>
                                    <option value="partial">Partiellement payée</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2 : Liste des Articles & Prestations (Dynamique) -->
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom-0">
                        <h5 class="card-title mb-0 fw-bold text-primary">
                            <i class="bi bi-list-check me-2"></i>Désignation des Articles & Prestations
                        </h5>
                        <button type="button" class="btn btn-sm btn-light-primary text-primary fw-semibold" id="btnAddRow">
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
                                        <th style="width: 200px;">Prix unitaire (FCFA) <span class="text-danger">*</span></th>
                                        <th style="width: 220px;" class="text-end">Prix total (FCFA)</th>
                                        <th style="width: 60px;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyArticles">
                                    <!-- Ligne 1 par défaut -->
                                    <tr class="article-row">
                                        <td class="text-center row-number fw-bold text-muted">1</td>
                                        <td>
                                            <input type="text" name="articles[0][designation]" class="form-control" placeholder="ex: Fourniture d'équipements informatiques" required>
                                        </td>
                                        <td>
                                            <input type="number" name="articles[0][quantite]" class="form-control qte-input" min="1" value="1" required>
                                        </td>
                                        <td>
                                            <input type="number" name="articles[0][prix_unitaire]" class="form-control price-input" step="any" placeholder="0" required>
                                        </td>
                                        <td class="text-end fw-bold text-dark row-total">0 FCFA</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-ghost btn-icon btn-sm text-danger btn-remove-row" title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3 : Ajustements Financiers (TVA Optionnelle & Remise) -->
            <div class="col-lg-12">
                <div class="row g-4">
                    <!-- Configuration des options -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white py-3 border-bottom-0">
                                <h5 class="card-title mb-0 fw-bold text-primary">
                                    <i class="bi bi-percent me-2"></i>TVA & Remises Optionnelles
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Case à cocher TVA -->
                                    <div class="col-12">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="checkTVA" name="appliquer_tva">
                                            <label class="form-check-label fw-semibold" for="checkTVA">Activer la TVA</label>
                                        </div>
                                        <div id="tvaInputContainer" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">Taux TVA</span>
                                                <input type="number" id="inputTVA" name="tva_pourcentage" class="form-control" value="18" min="0" max="100" step="any">
                                                <span class="input-group-text bg-light">%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-2">

                                    <!-- Case à cocher Remise -->
                                    <div class="col-12">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="checkRemise" name="appliquer_remise">
                                            <label class="form-check-label fw-semibold" for="checkRemise">Activer une remise</label>
                                        </div>
                                        <div id="remiseInputContainer" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">Remise</span>
                                                <input type="number" id="inputRemise" name="remise_pourcentage" class="form-control" value="0" min="0" max="100" step="any">
                                                <span class="input-group-text bg-light">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Affichage du Récapitulatif Financier -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4 d-flex flex-column justify-content-center">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Total HT :</span>
                                    <span class="fw-semibold text-dark" id="subtotalHT">0 FCFA</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2 text-danger" id="rowRemise" style="display: none;">
                                    <span>Remise appliquée :</span>
                                    <span class="fw-semibold" id="amountRemise">-0 FCFA</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3 text-dark" id="rowTVA" style="display: none;">
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

            <!-- Section 4 : Somme en toutes lettres & Conditions -->
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
                                <label class="form-label fw-semibold">Arrêtée la présente facture à la somme de :</label>
                                <!-- Champ calculé automatiquement -->
                                <input type="text" id="montantLettres" name="montant_lettres" class="form-control bg-light" readonly placeholder="Calcul automatique du montant en lettres...">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Conditions de règlement & Coordonnées bancaires</label>
                                <!-- Pré-rempli par défaut, modifiable -->
                                <textarea name="conditions" class="form-control" rows="3">Arrêtée la présente facture à la somme indiquée ci-dessus en francs CFA.
Règlement par chèque ou par virement bancaire.
Compte BDM SA N° : XXXXXXXXXXXXXXX
Paiement à effectuer dès réception de la facture.</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'Action en bas -->
            <div class="col-lg-12 text-end mb-4">
                <a href="#" class="btn btn-outline-secondary me-2">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Enregistrer la Facture
                </button>
            </div>
        </div>
    </form>
</div>

<!-- JavaScript Vanilla : Calculs automatiques & Gestion dynamique de la TVA / Remise -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tbody = document.getElementById('tbodyArticles');
    const btnAdd = document.getElementById('btnAddRow');
    
    // Éléments d'affichage financiers
    const subtotalHTEl = document.getElementById('subtotalHT');
    const grandTotalEl = document.getElementById('grandTotal');
    const labelFinalTotalEl = document.getElementById('labelFinalTotal');
    const montantLettresInput = document.getElementById('montantLettres');

    // Éléments TVA
    const checkTVA = document.getElementById('checkTVA');
    const tvaInputContainer = document.getElementById('tvaInputContainer');
    const inputTVA = document.getElementById('inputTVA');
    const rowTVA = document.getElementById('rowTVA');
    const amountTVAEl = document.getElementById('amountTVA');

    // Éléments Remise
    const checkRemise = document.getElementById('checkRemise');
    const remiseInputContainer = document.getElementById('remiseInputContainer');
    const inputRemise = document.getElementById('inputRemise');
    const rowRemise = document.getElementById('rowRemise');
    const amountRemiseEl = document.getElementById('amountRemise');

    // Conversion nombre en lettres (Français)
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

        let billions = Math.floor(num / 1000000000);
        let millions = Math.floor((num % 1000000000) / 1000000);
        let thousands = Math.floor((num % 1000000) / 1000);
        let remainder = Math.floor(num % 1000);

        let result = '';

        if (billions > 0) result += convertGroup(billions) + (billions > 1 ? ' milliards ' : ' milliard ');
        if (millions > 0) result += convertGroup(millions) + (millions > 1 ? ' millions ' : ' million ');
        if (thousands > 0) {
            if (thousands === 1) result += 'mille ';
            else result += convertGroup(thousands) + ' mille ';
        }
        if (remainder > 0) result += convertGroup(remainder);

        return result.trim();
    }

    function capitalize(str) {
        if (!str) return '';
        return str.charAt(0).toUpperCase() + str.slice(1);
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
            const unitPrice = parseFloat(inputs[2].value) || 0;
            const lineTotal = qty * unitPrice;

            row.querySelector('.row-total').textContent = formatMoney(lineTotal);
            rawSubtotalHT += lineTotal;
        });

        subtotalHTEl.textContent = formatMoney(rawSubtotalHT);

        // Traitement de la Remise
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

        // Traitement de la TVA
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

        // Affichage du Total Final
        grandTotalEl.textContent = formatMoney(finalTotal);

        // Conversion automatique en lettres
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

    // Événements pour la TVA et la Remise
    checkTVA.addEventListener('change', calculateTotals);
    inputTVA.addEventListener('input', calculateTotals);

    checkRemise.addEventListener('change', calculateTotals);
    inputRemise.addEventListener('input', calculateTotals);

    // Événements sur le tableau d'articles
    tbody.addEventListener('input', function (e) {
        if (e.target.classList.contains('qte-input') || e.target.classList.contains('price-input')) {
            calculateTotals();
        }
    });

    // Ajouter une ligne d'article
    btnAdd.addEventListener('click', function () {
        const rowCount = tbody.querySelectorAll('.article-row').length;
        const newRow = document.createElement('tr');
        newRow.className = 'article-row';
        newRow.innerHTML = `
            <td class="text-center row-number fw-bold text-muted">${rowCount + 1}</td>
            <td><input type="text" class="form-control" placeholder="Désignation" required></td>
            <td><input type="number" class="form-control qte-input" min="1" value="1" required></td>
            <td><input type="number" class="form-control price-input" step="any" placeholder="0" required></td>
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

    // Supprimer une ligne
    tbody.addEventListener('click', function (e) {
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
});
</script>

@endsection