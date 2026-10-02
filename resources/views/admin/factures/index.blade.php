@extends('layouts.navbar')
@section('title', 'Listes des factures — DEL SARL')
@section('suite')


   
      <div class="custom-container">







        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h1 class="h2">Liste des factures</h1>
            <a href="{{ route('facture.create') }}" class="btn btn-dark">+ Ajouter une facture</a>
        </div>





        <div class="card mb-5 shadow-sm">
            <div class="card-body">
                <form action="" method="GET">
                    <div class="row g-3 align-items-end">

                        <div class="col-lg-3 col-md-6">
                            <label class="form-label fw-semibold">Date de facturation</label>
                            <input type="date" name="date" class="form-control" value="">
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <label class="form-label fw-semibold">Code</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="code facture..." value="">
                                <button class="btn btn-light border" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8" />
                                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-12 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">
                                Filtrer les factures
                            </button>

                            <a href="" class="btn btn-outline-danger w-100">
                                Réinitialiser
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        {{-- <div class="d-flex justify-content-center gap-3 mb-4">
            <button id="btnBoutique" class="btn btn-dark px-4 shadow-none">Boutique</button>
            <button id="btnMagasin" class="btn btn-outline-dark px-4 shadow-none">Magasin</button>
        </div> --}}



<div class="accordion" id="accordionFactures">
    <!-- Groupe par Jour -->
    <div class="accordion-item mb-3 border shadow-sm">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="bi bi-calendar-event me-2 text-primary"></i>
                Factures du 02 Octobre 2026
                <span class="badge bg-primary ms-2">2 factures</span>
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFactures">
            <div class="accordion-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Montant total</th>
                                <th>Émise par</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>02/10/2026 10:30</td>
                                <td><span class="fw-semibold text-dark">Client Nom</span></td>
                                <td class="fw-bold text-primary">150 000 FCFA</td>
                                <td><span class="badge bg-light text-dark border">Agent ABC</span></td>
                                <td class="text-end">
                                    <!-- Télécharger -->
                                    <a href="#" class="btn btn-ghost btn-icon btn-sm rounded-circle text-primary" title="Télécharger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                            <path d="M7 11l5 5l5 -5" />
                                            <path d="M12 4l0 12" />
                                        </svg>
                                    </a>
                                    <!-- Voir -->
                                    <a href="{{ route('facture.show') }}" class="btn btn-ghost btn-icon btn-sm rounded-circle" title="Voir">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                    <!-- Modifier -->
                                    <a href="#" class="btn btn-ghost btn-icon btn-sm rounded-circle" title="Modifier">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                            <path d="M13.5 6.5l4 4" />
                                        </svg>
                                    </a>
                                    <!-- Supprimer -->
                                    <form action="#" method="POST" style="display: inline;">
                                        <button type="button" class="btn btn-ghost btn-icon btn-sm rounded-circle text-danger" title="Supprimer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pagination -->
<nav aria-label="Navigation des factures" class="mt-4">
    <ul class="pagination justify-content-center mb-0">
        <li class="page-item disabled">
            <a class="page-link" href="#">Précédent</a>
        </li>
        <li class="page-item active">
            <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">Suivant</a>
        </li>
    </ul>
</nav>




        



     

    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <script>
        function confirmDelete(public_id) {
            Swal.fire({
                title: 'Êtes-vous sûr de supprimer cette vente ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + public_id).submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const btnB = document.getElementById('btnBoutique');
            const btnM = document.getElementById('btnMagasin');
            const divB = document.getElementById('ventesBoutique');
            const divM = document.getElementById('ventesMagasin');

            btnB.onclick = () => {
                divB.classList.remove('d-none');
                divM.classList.add('d-none');
                btnB.className = 'btn btn-dark px-4 shadow-none';
                btnM.className = 'btn btn-outline-dark px-4 shadow-none';
            };

            btnM.onclick = () => {
                divM.classList.remove('d-none');
                divB.classList.add('d-none');
                btnM.className = 'btn btn-dark px-4 shadow-none';
                btnB.className = 'btn btn-outline-dark px-4 shadow-none';
            };
        });
    </script> --}}



@endsection
