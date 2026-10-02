@extends('layouts.navbar')
@section('title', 'Création d\'un bordereau — DEL SARL')
@section('suite')

<div class="container-fluid py-4">
    <form action="#" method="POST" id="formCreateBL">
        <!-- En-tête de la page -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="mb-1 fw-bold text-dark">Nouveau Bordereau de Livraison</h3>
                <p class="text-muted mb-0">Remplissez les informations ci-dessous pour générer le bordereau.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('bordereau.index') }}" class="btn btn-outline-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Enregistrer le Bordereau
                </button>
            </div>
        </div>

        <div class="row g-4">
            <!-- Section Informations Générales -->
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="card-title mb-0 fw-bold text-primary">
                            <i class="bi bi-file-earmark-text me-2"></i>Informations du Bordereau
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Client / Destinataire <span class="text-danger">*</span></label>
                                <input type="text" name="client" class="form-control" placeholder="ex: MINISTÈRE DE L'ADMINISTRATION TERRITORIALE" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Date de livraison <span class="text-danger">*</span></label>
                                <input type="date" name="date_livraison" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">N° BL</label>
                                <input type="text" name="num_bl" class="form-control" placeholder="ex: BL-2026-001">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Référence / Note</label>
                                <input type="text" name="reference" class="form-control" placeholder="ex: Facture pro forma DEL SARL du 25/09/2026">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Liste des Articles Dynamique -->
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom-0">
                        <h5 class="card-title mb-0 fw-bold text-primary">
                            <i class="bi bi-box-seam me-2"></i>Articles Livrés
                        </h5>
                        <button type="button" class="btn btn-sm btn-light-primary text-primary fw-semibold" id="btnAddRow">
                            <i class="bi bi-plus-circle me-1"></i>Ajouter un article
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="tableArticles">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;" class="text-center">N°</th>
                                        <th>Désignation <span class="text-danger">*</span></th>
                                        <th style="width: 160px;">Qté Livrée <span class="text-danger">*</span></th>
                                        <th>Observations</th>
                                        <th style="width: 60px;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyArticles">
                                    <!-- Ligne 1 par défaut -->
                                    <tr class="article-row">
                                        <td class="text-center row-number fw-bold text-muted">1</td>
                                        <td>
                                            <input type="text" name="articles[0][designation]" class="form-control" placeholder="ex: Photocopieur CANON imageRUNNER" required>
                                        </td>
                                        <td>
                                            <input type="number" name="articles[0][quantite]" class="form-control qte-input" min="1" value="1" required>
                                        </td>
                                        <td>
                                            <input type="text" name="articles[0][observations]" class="form-control" placeholder="Remarques / État (Optionnel)">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-ghost btn-icon btn-sm text-danger btn-remove-row" title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="2" class="text-end fw-bold text-uppercase">Total Articles Livrés :</td>
                                        <td colspan="3" class="fw-bold text-primary fs-6" id="totalQty">1</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Signatures & Intervenants -->
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="card-title mb-0 fw-bold text-primary">
                            <i class="bi bi-pen me-2"></i>Signataires & Réception
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <!-- Emetteur (DEL SARL) -->
                            <div class="col-md-6 border-end">
                                <h6 class="fw-bold text-dark mb-3">Pour DEL SARL (La Direction)</h6>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label small text-muted">Nom de l'émetteur</label>
                                        <input type="text" name="emetteur_nom" class="form-control" placeholder="ex: Doucouré Aïssata">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small text-muted">Fonction</label>
                                        <input type="text" name="emetteur_fonction" class="form-control" placeholder="ex: Gérante Associée">
                                    </div>
                                </div>
                            </div>

                            <!-- Réceptionnaire (Client) -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-dark mb-3">Pour le Client (Réceptionnaire)</h6>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label small text-muted">Nom du récepteur</label>
                                        <input type="text" name="recepteur_nom" class="form-control" placeholder="ex: Youba Maïga">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small text-muted">Fonction</label>
                                        <input type="text" name="recepteur_fonction" class="form-control" placeholder="ex: Agent à la DFM / DCM">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- JavaScript Vanilla pour la gestion dynamique des lignes d'articles -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tbody = document.getElementById('tbodyArticles');
    const btnAdd = document.getElementById('btnAddRow');
    const totalQtyEl = document.getElementById('totalQty');

    // Mettre à jour les numéros de ligne et calculer la quantité totale
    function updateCalculations() {
        const rows = tbody.querySelectorAll('.article-row');
        let total = 0;

        rows.forEach((row, index) => {
            // Mise à jour du numéro
            row.querySelector('.row-number').textContent = index + 1;
            
            // Re-indexation des noms d'inputs pour Laravel
            const inputs = row.querySelectorAll('input');
            inputs[0].name = `articles[${index}][designation]`;
            inputs[1].name = `articles[${index}][quantite]`;
            inputs[2].name = `articles[${index}][observations]`;

            // Calcul du total
            const qtyVal = parseFloat(inputs[1].value) || 0;
            total += qtyVal;
        });

        totalQtyEl.textContent = total;
    }

    // Ajouter une ligne
    btnAdd.addEventListener('click', function () {
        const rowCount = tbody.querySelectorAll('.article-row').length;
        const newRow = document.createElement('tr');
        newRow.className = 'article-row';
        newRow.innerHTML = `
            <td class="text-center row-number fw-bold text-muted">${rowCount + 1}</td>
            <td>
                <input type="text" class="form-control" placeholder="Désignation de l'article" required>
            </td>
            <td>
                <input type="number" class="form-control qte-input" min="1" value="1" required>
            </td>
            <td>
                <input type="text" class="form-control" placeholder="Remarques / État (Optionnel)">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-ghost btn-icon btn-sm text-danger btn-remove-row" title="Supprimer">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(newRow);
        updateCalculations();
    });

    // Supprimer une ligne
    tbody.addEventListener('click', function (e) {
        if (e.target.closest('.btn-remove-row')) {
            const rows = tbody.querySelectorAll('.article-row');
            if (rows.length > 1) {
                e.target.closest('.article-row').remove();
                updateCalculations();
            } else {
                alert('Le bordereau doit contenir au moins un article.');
            }
        }
    });

    // Écouter les changements de quantité
    tbody.addEventListener('input', function (e) {
        if (e.target.classList.contains('qte-input')) {
            updateCalculations();
        }
    });
});
</script>

@endsection