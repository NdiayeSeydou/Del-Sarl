@extends('layouts.navbar')

@section('title', 'Création d\'un bordereau — DEL SARL')

@section('suite')

    <div class="container-fluid">

        {{-- ========================================================= --}}
        {{-- EN-TÊTE --}}
        {{-- ========================================================= --}}

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">

            <div>
                <h4 class="mb-1">Créer un bordereau de livraison</h4>

                <p class="text-muted mb-0">
                    Créez un nouveau bordereau à partir d'une proforma existante.
                </p>
            </div>

           

        </div>


        {{-- ========================================================= --}}
        {{-- MESSAGES D'ERREUR --}}
        {{-- ========================================================= --}}

        @if ($errors->any())

            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <div class="fw-semibold mb-1">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Veuillez corriger les erreurs suivantes :
                </div>

                <ul class="mb-0 ps-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer">
                </button>

            </div>

        @endif


        {{-- ========================================================= --}}
        {{-- FORMULAIRE --}}
        {{-- ========================================================= --}}

        <form action="{{ route('bordereau.store') }}" method="POST" id="formCreateBL" data-swal-confirm="true">

            @csrf


            {{-- ========================================================= --}}
            {{-- INFORMATIONS GÉNÉRALES --}}
            {{-- ========================================================= --}}

            <div class="card mb-4">

                <div class="card-header">
                    <h5 class="card-title mb-0">
                        Informations générales
                    </h5>
                </div>

                <div class="card-body">

                    <div class="row g-3">

                        {{-- Proforma --}}
                        <div class="col-md-8">

                            <label for="proforma_id" class="form-label">
                                Proforma <span class="text-danger">*</span>
                            </label>

                            <select name="proforma_id" id="proforma_id"
                                class="form-select @error('proforma_id') is-invalid @enderror" required>

                                <option value="">
                                    -- Sélectionner une proforma --
                                </option>

                                @foreach ($proformas as $proforma)
                                    <option value="{{ $proforma->id }}" data-numero="{{ $proforma->num_proforma }}"
                                        data-date="{{ \Carbon\Carbon::parse($proforma->date_proforma)->format('d/m/Y') }}"
                                        data-client="{{ $proforma->client }}"
                                        data-reference="Facture du pro forma DEL SARL du {{ \Carbon\Carbon::parse($proforma->date_proforma)->format('d/m/Y') }}"
                                        data-articles='@json($proforma->articles)'
                                        {{ old('proforma_id') == $proforma->id ? 'selected' : '' }}>
                                        {{ $proforma->num_proforma }}
                                        — {{ \Carbon\Carbon::parse($proforma->date_proforma)->format('d/m/Y') }}
                                        — {{ $proforma->client }}
                                    </option>
                                @endforeach

                            </select>

                            @error('proforma_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="text-muted">
                                Sélectionnez la proforma correspondant à la livraison.
                            </small>

                        </div>


                        {{-- Numéro BL --}}
                        <div class="col-md-4">

                            <label for="num_bl" class="form-label">
                                N° Bordereau
                            </label>

                            <input type="text" id="num_bl" class="form-control" value="{{ $prochainNumero }}"
                                readonly>

                            <small class="text-muted">
                                Le numéro sera généré automatiquement lors de l'enregistrement.
                            </small>

                        </div>


                        {{-- Date de livraison --}}
                        <div class="col-md-4">

                            <label for="date_livraison" class="form-label">
                                Date de livraison
                                <span class="text-danger">*</span>
                            </label>

                            <input type="date" name="date_livraison" id="date_livraison"
                                class="form-control @error('date_livraison') is-invalid @enderror"
                                value="{{ old('date_livraison', date('Y-m-d')) }}" required>

                            @error('date_livraison')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Référence --}}
                        <div class="col-md-8">

                            <label for="reference" class="form-label">
                                Référence
                            </label>

                            <input type="text" name="reference" id="reference" class="form-control"
                                value="{{ old('reference') }}" readonly>

                            <small class="text-muted">
                                Cette référence est générée automatiquement à partir de la proforma sélectionnée.
                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- ARTICLES --}}
            {{-- ========================================================= --}}

            <div class="card mb-4">

                <div class="card-header d-flex align-items-center justify-content-between">

                    <div>

                        <h5 class="card-title mb-0">
                            Articles à livrer
                        </h5>

                        <small class="text-muted">
                            Les articles de la proforma sont chargés automatiquement.
                        </small>

                    </div>

                    <button type="button" class="btn btn-primary btn-sm" id="btnAddRow">

                        <i class="bi bi-plus-lg me-1"></i>
                        Ajouter un article

                    </button>

                </div>


                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0" id="tableArticles">

                            <thead class="table-light">

                                <tr>

                                    <th class="text-center" style="width: 60px;">
                                        #
                                    </th>

                                    <th>
                                        Désignation
                                    </th>

                                    <th style="width: 150px;">
                                        Quantité
                                    </th>

                                    <th>
                                        Observations
                                    </th>

                                    <th class="text-center" style="width: 70px;">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody id="tbodyArticles">
                                {{-- Les articles seront ajoutés par JavaScript --}}
                            </tbody>


                            <tfoot>

                                <tr>

                                    <th colspan="2" class="text-end">
                                        Total quantité
                                    </th>

                                    <th>

                                        <input type="text" id="totalQty" class="form-control" value="0" readonly>

                                    </th>

                                    <th colspan="2"></th>

                                </tr>

                            </tfoot>

                        </table>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- INFORMATIONS DE LIVRAISON --}}
            {{-- ========================================================= --}}

            <div class="card mb-4">

                <div class="card-header">

                    <h5 class="card-title mb-0">
                        Informations de réception
                    </h5>

                </div>


                <div class="card-body">

                    <div class="row g-3">

                        {{-- Émetteur --}}
                        <div class="col-md-6">

                            <div class="border rounded p-3 h-100">

                                <h6 class="fw-semibold mb-3">
                                    Émetteur
                                </h6>


                                <div class="mb-3">

                                    <label for="emetteur_nom" class="form-label">
                                        Nom
                                    </label>

                                    <input type="text" name="emetteur_nom" id="emetteur_nom" class="form-control"
                                        value="{{ old('emetteur_nom', $user->name ?? '') }}" readonly>

                                </div>


                                <div>

                                    <label for="emetteur_fonction" class="form-label">
                                        Fonction
                                    </label>

                                    <input type="text" name="emetteur_fonction" id="emetteur_fonction"
                                        class="form-control"
                                        value="{{ old('emetteur_fonction', $user->fonction ?? '') }}" readonly>

                                </div>

                            </div>

                        </div>


                        {{-- Récepteur --}}
                        <div class="col-md-6">

                            <div class="border rounded p-3 h-100">

                                <h6 class="fw-semibold mb-3">
                                    Récepteur
                                </h6>


                                <div class="mb-3">

                                    <label for="recepteur_nom" class="form-label">
                                        Nom
                                    </label>

                                    <input type="text" name="recepteur_nom" id="recepteur_nom" class="form-control"
                                        value="{{ old('recepteur_nom') }}" placeholder="Nom du réceptionnaire">

                                </div>


                                <div>

                                    <label for="recepteur_fonction" class="form-label">
                                        Fonction
                                    </label>

                                    <input type="text" name="recepteur_fonction" id="recepteur_fonction"
                                        class="form-control" value="{{ old('recepteur_fonction') }}"
                                        placeholder="Fonction du réceptionnaire">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- ACTIONS --}}
            {{-- ========================================================= --}}

            <div class="d-flex justify-content-end gap-2 mb-5">

                <a href="{{ route('bordereau.index') }}" class="btn btn-light">

                    Annuler

                </a>

                <button type="submit" class="btn btn-primary">


                    Enregistrer le bordereau

                </button>

            </div>

        </form>

    </div>


    {{-- ============================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ============================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const proformaSelect = document.getElementById('proforma_id');
            const referenceInput = document.getElementById('reference');
            const tbody = document.getElementById('tbodyArticles');
            const btnAddRow = document.getElementById('btnAddRow');
            const totalQty = document.getElementById('totalQty');


            /*
            |--------------------------------------------------------------------------
            | Ajouter une ligne
            |--------------------------------------------------------------------------
            */

            function addRow(article = {}) {

                const index = tbody.querySelectorAll('tr').length;

                const row = document.createElement('tr');


                // Numéro
                const tdNumber = document.createElement('td');

                tdNumber.className = 'text-center row-number';
                tdNumber.textContent = index + 1;


                // Désignation
                const tdDesignation = document.createElement('td');

                const designationInput = document.createElement('input');

                designationInput.type = 'text';
                designationInput.className = 'form-control article-designation';
                designationInput.name = `articles[${index}][designation]`;
                designationInput.required = true;
                designationInput.placeholder = "Désignation de l'article";
                designationInput.value = article.designation ?? '';

                tdDesignation.appendChild(designationInput);


                // Quantité
                const tdQuantity = document.createElement('td');

                const quantityInput = document.createElement('input');

                quantityInput.type = 'number';
                quantityInput.className = 'form-control quantity';
                quantityInput.name = `articles[${index}][quantite]`;
                quantityInput.min = '1';
                quantityInput.step = '1';
                quantityInput.required = true;
                quantityInput.value = article.quantite ?? 1;

                tdQuantity.appendChild(quantityInput);


                // Observations
                const tdObservations = document.createElement('td');

                const observationsInput = document.createElement('input');

                observationsInput.type = 'text';
                observationsInput.className = 'form-control article-observation';
                observationsInput.name = `articles[${index}][observations]`;
                observationsInput.placeholder = 'Observation éventuelle';
                observationsInput.value = article.observations ?? '';

                tdObservations.appendChild(observationsInput);


                // Action
                const tdAction = document.createElement('td');

                tdAction.className = 'text-center';

                const deleteButton = document.createElement('button');

                deleteButton.type = 'button';

                deleteButton.className =
                    'btn btn-ghost btn-icon btn-sm rounded-circle btn-remove-row';

                deleteButton.title = 'Supprimer cet article';

                deleteButton.innerHTML = `
            <i class="bi bi-trash"></i>
        `;

                tdAction.appendChild(deleteButton);


                // Assemblage
                row.appendChild(tdNumber);
                row.appendChild(tdDesignation);
                row.appendChild(tdQuantity);
                row.appendChild(tdObservations);
                row.appendChild(tdAction);

                tbody.appendChild(row);

                updateCalculations();
            }


            /*
            |--------------------------------------------------------------------------
            | Recalculer les lignes et le total
            |--------------------------------------------------------------------------
            */

            function updateCalculations() {

                const rows = tbody.querySelectorAll('tr');

                let total = 0;


                rows.forEach((row, index) => {

                    // Numéro
                    const numberCell =
                        row.querySelector('.row-number');

                    if (numberCell) {
                        numberCell.textContent = index + 1;
                    }


                    // Désignation
                    const designationInput =
                        row.querySelector('.article-designation');

                    if (designationInput) {

                        designationInput.name =
                            `articles[${index}][designation]`;

                    }


                    // Quantité
                    const quantityInput =
                        row.querySelector('.quantity');

                    if (quantityInput) {

                        quantityInput.name =
                            `articles[${index}][quantite]`;

                        total +=
                            parseInt(quantityInput.value, 10) || 0;

                    }


                    // Observations
                    const observationsInput =
                        row.querySelector('.article-observation');

                    if (observationsInput) {

                        observationsInput.name =
                            `articles[${index}][observations]`;

                    }

                });


                totalQty.value = total;
            }


            /*
            |--------------------------------------------------------------------------
            | Charger les articles de la proforma
            |--------------------------------------------------------------------------
            */

            function loadProforma() {

                const option =
                    proformaSelect.options[
                        proformaSelect.selectedIndex
                    ];


                if (!option || !option.value) {

                    referenceInput.value = '';

                    tbody.innerHTML = '';

                    addRow();

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Référence
                |--------------------------------------------------------------------------
                */

                referenceInput.value =
                    option.dataset.reference || '';


                /*
                |--------------------------------------------------------------------------
                | Articles
                |--------------------------------------------------------------------------
                */

                let articles = [];


                try {

                    articles =
                        JSON.parse(
                            option.dataset.articles || '[]'
                        );

                } catch (error) {

                    console.error(
                        'Impossible de récupérer les articles de la proforma.',
                        error
                    );

                    articles = [];
                }


                /*
                |--------------------------------------------------------------------------
                | Vider les anciennes lignes
                |--------------------------------------------------------------------------
                */

                tbody.innerHTML = '';


                /*
                |--------------------------------------------------------------------------
                | Ajouter les articles
                |--------------------------------------------------------------------------
                */

                if (articles.length > 0) {

                    articles.forEach(article => {

                        addRow({

                            designation: article.designation,

                            quantite: article.quantite,

                            observations: ''

                        });

                    });

                } else {

                    addRow();

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Sélection d'une proforma
            |--------------------------------------------------------------------------
            */

            proformaSelect.addEventListener('change', function() {

                const option =
                    this.options[this.selectedIndex];


                if (!option || !this.value) {

                    loadProforma();

                    return;
                }


                // Charger les articles et la référence
                loadProforma();


                /*
                |--------------------------------------------------------------------------
                | Afficher uniquement le numéro après sélection
                |--------------------------------------------------------------------------
                */

                option.textContent =
                    option.dataset.numero;

            });


            /*
            |--------------------------------------------------------------------------
            | Lorsque l'utilisateur ouvre à nouveau la liste
            |--------------------------------------------------------------------------
            |
            | On remet temporairement le texte complet :
            | NUMÉRO — DATE — CLIENT
            |
            */

            proformaSelect.addEventListener('focus', function() {

                Array.from(this.options).forEach(option => {

                    if (!option.dataset.numero) {
                        return;
                    }


                    option.textContent =
                        option.dataset.numero +
                        ' — ' +
                        option.dataset.date +
                        ' — ' +
                        option.dataset.client;

                });

            });


            /*
            |--------------------------------------------------------------------------
            | Ajouter manuellement un article
            |--------------------------------------------------------------------------
            */

            btnAddRow.addEventListener('click', function() {

                addRow();

            });


            /*
            |--------------------------------------------------------------------------
            | Supprimer un article
            |--------------------------------------------------------------------------
            */

            tbody.addEventListener('click', function(event) {

                const button =
                    event.target.closest('.btn-remove-row');


                if (!button) {
                    return;
                }


                const rows =
                    tbody.querySelectorAll('tr');


                /*
                |--------------------------------------------------------------------------
                | Garder au moins une ligne
                |--------------------------------------------------------------------------
                */

                if (rows.length <= 1) {

                    if (typeof Swal !== 'undefined') {

                        Swal.fire({

                            icon: 'info',

                            title: 'Action impossible',

                            text: 'Le bordereau doit contenir au moins un article.',

                            confirmButtonText: 'OK'

                        });

                    } else {

                        alert(
                            'Le bordereau doit contenir au moins un article.'
                        );

                    }

                    return;
                }


                button.closest('tr').remove();

                updateCalculations();

            });


            /*
            |--------------------------------------------------------------------------
            | Modification des quantités
            |--------------------------------------------------------------------------
            */

            tbody.addEventListener('input', function(event) {

                if (
                    event.target.classList.contains('quantity')
                ) {

                    updateCalculations();

                }

            });


            /*
            |--------------------------------------------------------------------------
            | Restaurer la proforma après erreur de validation
            |--------------------------------------------------------------------------
            */

            const oldProformaId =
                @json(old('proforma_id'));


            if (oldProformaId) {

                const option =
                    Array.from(proformaSelect.options)
                    .find(
                        option =>
                        option.value == oldProformaId
                    );


                if (option) {

                    proformaSelect.value =
                        oldProformaId;

                    loadProforma();

                    /*
                    | Après restauration, on affiche uniquement
                    | le numéro dans le select.
                    */

                    option.textContent =
                        option.dataset.numero;

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Si aucune proforma n'est sélectionnée
            |--------------------------------------------------------------------------
            */

            if (!proformaSelect.value) {

                addRow();

            }

        });
    </script>

@endsection
