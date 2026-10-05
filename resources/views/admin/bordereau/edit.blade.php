@extends('layouts.navbar')

@section('title', 'Édition Bordereau — DEL SARL')

@section('suite')

<div class="container py-4">

    <form action="{{ route('bordereau.update', $bordereau) }}"
          method="POST"
          id="formEditDocument">

        @csrf
        @method('PUT')

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="h3 mb-1 fw-bold text-dark">
                    Modifier le bordereau
                </h1>

                <p class="text-muted mb-0">
                    Bordereau n° :
                    <strong>{{ $bordereau->num_bl }}</strong>
                </p>
            </div>

            <a href="{{ route('bordereau.index') }}"
               class="btn btn-outline-secondary">
                Retour
            </a>

        </div>


        {{-- ============================= --}}
        {{-- INFORMATIONS GÉNÉRALES --}}
        {{-- ============================= --}}

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="card-title mb-0 fw-bold text-primary">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Informations Générales
                </h5>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    {{-- PROFORMA --}}
                    <div class="col-md-6">

                        <label for="proforma_id"
                               class="form-label fw-semibold">
                            Pro Forma
                            <span class="text-danger">*</span>
                        </label>

                        <select name="proforma_id"
                                id="proforma_id"
                                class="form-select @error('proforma_id') is-invalid @enderror"
                                required>

                            <option value="">
                                -- Sélectionner une proforma --
                            </option>

                            @foreach ($proformas as $proforma)

                                <option value="{{ $proforma->id }}"
                                    data-numero="{{ $proforma->num_proforma }}"
                                    data-date="{{ \Carbon\Carbon::parse($proforma->date_proforma)->format('d/m/Y') }}"
                                    data-client="{{ $proforma->client }}"
                                    data-reference="Facture du pro forma DEL SARL du {{ \Carbon\Carbon::parse($proforma->date_proforma)->format('d/m/Y') }}"
                                    data-articles='@json($proforma->articles)'
                                    {{ old('proforma_id', $bordereau->proforma_id) == $proforma->id ? 'selected' : '' }}>

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

                        <div class="form-text">
                            Sélectionnez une proforma pour charger ses articles.
                        </div>

                    </div>


                    {{-- CLIENT INFORMATIONNEL --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Client
                        </label>

                        <input type="text"
                               id="client_display"
                               class="form-control bg-light"
                               value="{{ $bordereau->proforma?->client ?? '' }}"
                               readonly>

                        <div class="form-text">
                            Le client est récupéré automatiquement depuis la proforma.
                        </div>

                    </div>


                    {{-- NUMÉRO BL --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Numéro du bordereau
                        </label>

                        <input type="text"
                               class="form-control bg-light"
                               value="{{ $bordereau->num_bl }}"
                               readonly>

                    </div>


                    {{-- DATE LIVRAISON --}}
                    <div class="col-md-4">

                        <label for="date_livraison"
                               class="form-label fw-semibold">

                            Date de livraison
                            <span class="text-danger">*</span>

                        </label>

                        <input type="date"
                               name="date_livraison"
                               id="date_livraison"
                               class="form-control @error('date_livraison') is-invalid @enderror"
                               value="{{ old('date_livraison', \Carbon\Carbon::parse($bordereau->date_livraison)->format('Y-m-d')) }}"
                               required>

                        @error('date_livraison')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- RÉFÉRENCE --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Référence
                        </label>

                        <input type="text"
                               id="reference"
                               class="form-control bg-light"
                               value="{{ old('reference', $bordereau->reference) }}"
                               readonly>

                        <div class="form-text">
                            Générée automatiquement selon la proforma.
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================= --}}
        {{-- ÉMETTEUR --}}
        {{-- ============================= --}}

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="card-title mb-0 fw-bold text-primary">
                    <i class="bi bi-person-badge me-2"></i>
                    Émetteur
                </h5>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Nom
                        </label>

                        <input type="text"
                               class="form-control bg-light"
                               value="{{ $user->name }}"
                               readonly>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Fonction
                        </label>

                        <input type="text"
                               class="form-control bg-light"
                               value="{{ $user->fonction ?? '' }}"
                               readonly>

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================= --}}
        {{-- RÉCEPTEUR --}}
        {{-- ============================= --}}

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="card-title mb-0 fw-bold text-primary">
                    <i class="bi bi-person-check me-2"></i>
                    Récepteur
                </h5>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label for="recepteur_nom"
                               class="form-label fw-semibold">
                            Nom
                        </label>

                        <input type="text"
                               name="recepteur_nom"
                               id="recepteur_nom"
                               class="form-control"
                               value="{{ old('recepteur_nom', $bordereau->recepteur_nom) }}"
                               placeholder="Nom du réceptionnaire">

                    </div>

                    <div class="col-md-6">

                        <label for="recepteur_fonction"
                               class="form-label fw-semibold">
                            Fonction
                        </label>

                        <input type="text"
                               name="recepteur_fonction"
                               id="recepteur_fonction"
                               class="form-control"
                               value="{{ old('recepteur_fonction', $bordereau->recepteur_fonction) }}"
                               placeholder="Fonction du réceptionnaire">

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================= --}}
        {{-- ARTICLES --}}
        {{-- ============================= --}}

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <h2 class="h5 mb-0 fw-bold">
                        Articles livrés
                    </h2>

                    <span class="badge bg-light text-dark">
                        Total :
                        <span id="totalQty">0</span>
                    </span>

                </div>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered align-middle"
                           id="tableArticles">

                        <thead class="table-light">

                            <tr>

                                <th style="width: 50px;"
                                    class="text-center">
                                    #
                                </th>

                                <th>
                                    Désignation
                                </th>

                                <th style="width: 140px;">
                                    Quantité
                                </th>

                                <th>
                                    Observations
                                </th>

                                <th style="width: 60px;"
                                    class="text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody id="tbodyArticles">
                            {{-- Les lignes sont générées par JavaScript --}}
                        </tbody>

                    </table>

                </div>


                <button type="button"
                        class="btn btn-sm btn-outline-success mt-2"
                        id="btnAddRow">

                    <i class="bi bi-plus-circle me-1"></i>
                    Ajouter un article

                </button>

            </div>

        </div>


        {{-- ============================= --}}
        {{-- ACTIONS --}}
        {{-- ============================= --}}

        <div class="d-flex justify-content-end gap-2">

            <a href="{{ route('bordereau.index') }}"
               class="btn btn-light border">

                Annuler

            </a>

            <button type="submit"
                    class="btn btn-primary">

                Enregistrer les modifications

            </button>

        </div>

    </form>

</div>


{{-- ===================================================== --}}
{{-- JAVASCRIPT --}}
{{-- ===================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const proformaSelect = document.getElementById('proforma_id');
    const clientDisplay = document.getElementById('client_display');
    const referenceInput = document.getElementById('reference');
    const tbody = document.getElementById('tbodyArticles');
    const btnAddRow = document.getElementById('btnAddRow');
    const totalQty = document.getElementById('totalQty');
    const formEdit = document.getElementById('formEditDocument');


    /* ================================================= */
    /* VARIABLES */
    /* ================================================= */

    const currentProformaId = @json($bordereau->proforma_id);

    const oldProformaId = @json(
        old('proforma_id', $bordereau->proforma_id)
    );

    const oldArticles = @json(old('articles'));


    /* ================================================= */
    /* RESTAURER LE TEXTE DES OPTIONS */
    /* ================================================= */

    function restoreOptionTexts() {

        Array.from(proformaSelect.options).forEach(option => {

            if (!option.value) {
                return;
            }

            const numero = option.dataset.numero || '';
            const date = option.dataset.date || '';
            const client = option.dataset.client || '';

            option.textContent =
                `${numero} — ${date} — ${client}`;

        });

    }


    /* ================================================= */
    /* RÉINDEXER LES ARTICLES */
    /* ================================================= */

    function reindexRows() {

        const rows = tbody.querySelectorAll('.article-row');

        rows.forEach((row, index) => {

            row.querySelector('.row-number').textContent =
                index + 1;

            const designation =
                row.querySelector('.designation-input');

            const quantite =
                row.querySelector('.qte-input');

            const observations =
                row.querySelector('.observations-input');


            if (designation) {

                designation.name =
                    `articles[${index}][designation]`;

            }


            if (quantite) {

                quantite.name =
                    `articles[${index}][quantite]`;

            }


            if (observations) {

                observations.name =
                    `articles[${index}][observations]`;

            }

        });

        updateTotal();

    }


    /* ================================================= */
    /* CALCUL TOTAL QUANTITÉ */
    /* ================================================= */

    function updateTotal() {

        let total = 0;

        tbody.querySelectorAll('.qte-input').forEach(input => {

            const value = parseInt(input.value, 10);

            if (!isNaN(value)) {

                total += value;

            }

        });

        totalQty.textContent = total;

    }


    /* ================================================= */
    /* AJOUTER UNE LIGNE */
    /* ================================================= */

    function addRow(article = {}) {

        const index =
            tbody.querySelectorAll('.article-row').length;

        const row = document.createElement('tr');

        row.classList.add('article-row');


        row.innerHTML = `

            <td class="text-center row-number fw-bold text-muted">
                ${index + 1}
            </td>

            <td>

                <input
                    type="text"
                    class="form-control designation-input"
                    name="articles[${index}][designation]"
                    value="${escapeHtml(article.designation ?? '')}"
                    required
                >

            </td>

            <td>

                <input
                    type="number"
                    class="form-control qte-input"
                    name="articles[${index}][quantite]"
                    min="1"
                    value="${article.quantite ?? 1}"
                    required
                >

            </td>

            <td>

                <input
                    type="text"
                    class="form-control observations-input"
                    name="articles[${index}][observations]"
                    value="${escapeHtml(article.observations ?? '')}"
                    placeholder="Observations (optionnel)"
                >

            </td>

            <td class="text-center">

                <button
                    type="button"
                    class="btn btn-sm btn-outline-danger btn-remove-row"
                    title="Supprimer">

                    <i class="bi bi-trash"></i>

                </button>

            </td>

        `;


        tbody.appendChild(row);

        updateTotal();

    }


    /* ================================================= */
    /* ÉCHAPPER HTML */
    /* ================================================= */

    function escapeHtml(value) {

        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');

    }


    /* ================================================= */
    /* CHARGER LES ARTICLES DE LA PROFORMA */
    /* ================================================= */

    function loadProforma() {

        const option =
            proformaSelect.options[
                proformaSelect.selectedIndex
            ];


        if (!option || !option.value) {

            clientDisplay.value = '';
            referenceInput.value = '';

            tbody.innerHTML = '';

            addRow();

            return;

        }


        /* --------------------------------------------- */
        /* CLIENT */
        /* --------------------------------------------- */

        clientDisplay.value =
            option.dataset.client || '';


        /* --------------------------------------------- */
        /* RÉFÉRENCE */
        /* --------------------------------------------- */

        referenceInput.value =
            option.dataset.reference || '';


        /* --------------------------------------------- */
        /* ARTICLES */
        /* --------------------------------------------- */

        let articles = [];

        try {

            articles =
                JSON.parse(
                    option.dataset.articles || '[]'
                );

        } catch (error) {

            console.error(
                'Erreur lors du chargement des articles :',
                error
            );

            articles = [];

        }


        /* --------------------------------------------- */
        /* VIDER LES ANCIENS ARTICLES */
        /* --------------------------------------------- */

        tbody.innerHTML = '';


        /* --------------------------------------------- */
        /* AJOUTER LES ARTICLES */
        /* --------------------------------------------- */

        if (
            Array.isArray(articles) &&
            articles.length > 0
        ) {

            articles.forEach(article => {

                addRow({

                    designation:
                        article.designation ?? '',

                    quantite:
                        article.quantite ?? 1,

                    observations:
                        ''

                });

            });

        } else {

            addRow();

        }


        reindexRows();

    }


    /* ================================================= */
    /* CHANGEMENT DE PROFORMA */
    /* ================================================= */

    proformaSelect.addEventListener(
        'change',
        function () {

            loadProforma();


            const selectedOption =
                proformaSelect.options[
                    proformaSelect.selectedIndex
                ];


            if (
                selectedOption &&
                selectedOption.value
            ) {

                selectedOption.textContent =
                    selectedOption.dataset.numero || '';

            }

        }
    );


    /* ================================================= */
    /* OUVERTURE DU SELECT */
    /* ================================================= */

    proformaSelect.addEventListener(
        'focus',
        function () {

            restoreOptionTexts();

        }
    );


    /* ================================================= */
    /* AJOUT D'ARTICLE */
    /* ================================================= */

    btnAddRow.addEventListener(
        'click',
        function () {

            addRow();

            reindexRows();

        }
    );


    /* ================================================= */
    /* SUPPRESSION D'ARTICLE */
    /* ================================================= */

    tbody.addEventListener(
        'click',
        function (event) {

            const button =
                event.target.closest(
                    '.btn-remove-row'
                );


            if (!button) {
                return;
            }


            const row =
                button.closest('.article-row');


            if (!row) {
                return;
            }


            row.remove();


            /*
             * Il faut toujours garder au moins
             * une ligne.
             */

            if (
                tbody.querySelectorAll(
                    '.article-row'
                ).length === 0
            ) {

                addRow();

            }


            reindexRows();

        }
    );


    /* ================================================= */
    /* MODIFICATION DES QUANTITÉS */
    /* ================================================= */

    tbody.addEventListener(
        'input',
        function (event) {

            if (
                event.target.classList.contains(
                    'qte-input'
                )
            ) {

                updateTotal();

            }

        }
    );


    /* ================================================= */
    /* RESTAURATION INITIALE */
    /* ================================================= */

    /*
     * Si Laravel a renvoyé des articles après
     * une erreur de validation, on les restaure.
     */

    if (
        Array.isArray(oldArticles) &&
        oldArticles.length > 0
    ) {

        tbody.innerHTML = '';


        oldArticles.forEach(article => {

            addRow({

                designation:
                    article.designation ?? '',

                quantite:
                    article.quantite ?? 1,

                observations:
                    article.observations ?? ''

            });

        });


        reindexRows();

    } else {

        /*
         * Sinon, on charge les articles de la
         * proforma actuellement sélectionnée.
         */

        loadProforma();

    }


    /* ================================================= */
    /* AFFICHAGE DU NUMÉRO DE PROFORMA */
    /* ================================================= */

    const selectedOption =
        proformaSelect.options[
            proformaSelect.selectedIndex
        ];


    if (
        selectedOption &&
        selectedOption.value
    ) {

        selectedOption.textContent =
            selectedOption.dataset.numero || '';

    }


    updateTotal();


    /* ================================================= */
    /* ÉTAT INITIAL DU FORMULAIRE */
    /* ================================================= */

    /*
     * Cette fonction récupère uniquement les champs
     * réellement envoyés au serveur.
     *
     * _token et _method sont ignorés.
     */

    function getFormState() {

        const formData =
            new FormData(formEdit);

        const data = {};


        for (const [key, value] of formData.entries()) {

            /*
             * Ne pas comparer le token CSRF
             * ni la méthode PUT.
             */

            if (
                key === '_token' ||
                key === '_method'
            ) {

                continue;

            }


            /*
             * Gestion des champs ayant plusieurs valeurs
             * comme les articles.
             */

            if (data[key] !== undefined) {

                if (!Array.isArray(data[key])) {

                    data[key] = [data[key]];

                }

                data[key].push(value);

            } else {

                data[key] = value;

            }

        }


        return JSON.stringify(data);

    }


    /*
     * IMPORTANT :
     *
     * On capture l'état initial APRÈS avoir chargé
     * la proforma et ses articles.
     */

    let initialFormState =
        getFormState();


    /* ================================================= */
    /* SWEETALERT2 — CONFIRMATION MODIFICATION */
    /* ================================================= */

    let confirmationEnCours = false;


    formEdit.addEventListener(
        'submit',
        function (event) {

            /*
             * Si SweetAlert a déjà confirmé,
             * on laisse le formulaire être envoyé.
             */

            if (confirmationEnCours) {

                return;

            }


            /*
             * Bloquer temporairement l'envoi.
             */

            event.preventDefault();


            /*
             * Récupérer l'état actuel.
             */

            const currentFormState =
                getFormState();


            /* ========================================= */
            /* AUCUNE MODIFICATION */
            /* ========================================= */

            if (
                currentFormState === initialFormState
            ) {

                Swal.fire({

                    icon: 'info',

                    title: 'Aucune modification',

                    text:
                        'Vous n’avez effectué aucune modification sur ce bordereau.',

                    confirmButtonText: 'OK'

                });


                return;

            }


            /* ========================================= */
            /* MODIFICATIONS DÉTECTÉES */
            /* ========================================= */

            Swal.fire({

                icon: 'question',

                title: 'Enregistrer les modifications ?',

                text:
                    'Les informations du bordereau seront mises à jour.',

                showCancelButton: true,

                confirmButtonText:
                    'Enregistrer',

                cancelButtonText:
                    'Annuler',

                reverseButtons: true

            }).then((result) => {

                if (result.isConfirmed) {

                    /*
                     * On indique que la confirmation
                     * SweetAlert a déjà été faite.
                     */

                    confirmationEnCours = true;


                    /*
                     * Envoi réel du formulaire.
                     *
                     * Cette méthode évite de repasser
                     * dans notre événement "submit".
                     */

                    HTMLFormElement.prototype.submit.call(
                        formEdit
                    );

                }

            });

        }
    );

});

</script>

@endsection