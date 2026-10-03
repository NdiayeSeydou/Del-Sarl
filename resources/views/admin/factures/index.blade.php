@extends('layouts.navbar')
@section('title', 'Listes des factures — DEL SARL')
@section('suite')



    <div class="custom-container">


        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 mb-0">Liste des factures</h1>
                <a href="{{ route('facture.create') }}" class="btn btn-dark">+ Ajouter une facture</a>
            </div>

            <!-- Formulaire de filtre -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('facture.index') }}" class="row g-3 align-items-end">

                        {{-- Filtrer par date --}}
                        <div class="col-md-4">
                            <label class="form-label">Date de facturation</label>
                            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                        </div>

                        {{-- Recherche par numéro ou client --}}
                        <div class="col-md-5">
                            <label class="form-label">Recherche</label>
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                placeholder="Numéro de facture ou nom du client">
                        </div>

                        {{-- Boutons --}}
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="ti ti-filter me-1"></i>
                                Filtrer
                            </button>

                            <a href="{{ route('facture.index') }}" class="btn btn-outline-secondary w-100">
                                Réinitialiser
                            </a>
                        </div>

                    </form>
                </div>
            </div>

            @if ($factures->isEmpty())
                <div class="alert alert-light border text-center">Aucune facture enregistrée.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Réference</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($factures as $facture)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $facture->num_facture }}</td>

                                    <td>
                                        <span title="{{ $facture->client }}">
                                            {{ \Illuminate\Support\Str::limit($facture->client, 14, '...') }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}
                                    </td>

                                    <td>
                                        {{ number_format($facture->grand_total, 0, ',', ' ') }} F
                                    </td>

                                    <td>
                                        @php
                                            $statut = strtolower(trim($facture->statut_paiement ?? 'unpaid'));

                                            [$label, $badgeClass] = match ($statut) {
                                                // Cas : Payé totalement
                                                'paid', 'paye', 'payee', 'payée' => ['Payé', 'bg-success'],
                                                // Cas : Partiellement payé (Affichage court : Partiel)
                                                'partial',
                                                'partially_paid',
                                                'partially-paid',
                                                'partiel',
                                                'partiellement_paye',
                                                'partiellement payé',
                                                'partiellement payee'
                                                    => ['Partiel', 'bg-warning text-dark'],
                                                // Cas : Non payé / En attente
                                                'unpaid',
                                                'non_paye',
                                                'non paye',
                                                'non payée',
                                                'non_payee',
                                                'pending',
                                                'en_attente'
                                                    => ['Non payé', 'bg-danger'],
                                                // Cas : Annulé
                                                'cancelled', 'canceled', 'annule', 'annulee', 'annulée' => [
                                                    'Annulé',
                                                    'bg-dark',
                                                ],
                                                // Par défaut
                                                default => [
                                                    ucfirst(str_replace(['_', '-'], ' ', $statut)),
                                                    'bg-secondary',
                                                ],
                                            };
                                        @endphp

                                        <span class="badge {{ $badgeClass }}">
                                            {{ $label }}
                                        </span>
                                    </td>

                                    <td class="text-end">
                                        <div class="invoice-actions">

                                            {{-- VOIR --}}
                                            <a href="{{ route('facture.show', $facture) }}"
                                                class="btn btn-ghost btn-icon btn-sm rounded-circle" title="Voir">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path
                                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                            </a>

                                            {{-- PDF --}}
                                            <a href="{{ route('facture.pdf', $facture) }}"
                                                class="btn btn-ghost btn-icon btn-sm rounded-circle"
                                                title="Télécharger PDF">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                                    <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3H5v6" />
                                                    <path d="M17 18h2" />
                                                    <path d="M20 15h-3v6" />
                                                    <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                                                </svg>
                                            </a>

                                            {{-- MODIFIER --}}
                                            <a href="{{ route('facture.edit', $facture) }}"
                                                class="btn btn-ghost btn-icon btn-sm rounded-circle" title="Modifier"
                                                data-swal-confirm data-swal-title="Modifier cette facture ?"
                                                data-swal-text="Le formulaire de modification va s'ouvrir."
                                                data-swal-confirm-text="Continuer">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                    <path d="M13.5 6.5l4 4" />
                                                </svg>
                                            </a>

                                            {{-- SUPPRIMER --}}
                                            <form action="{{ route('facture.destroy', $facture) }}" method="POST"
                                                style="display: inline;" data-swal-confirm data-swal-icon="warning"
                                                data-swal-title="Supprimer cette facture ?"
                                                data-swal-text="Cette action est irréversible."
                                                data-swal-confirm-text="Supprimer">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn btn-ghost btn-icon btn-sm rounded-circle text-danger"
                                                    title="Supprimer">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">

                                            <i class="ti ti-file-search text-muted mb-2" style="font-size: 40px;"></i>

                                            <h5 class="mb-1">Aucune facture trouvée</h5>

                                            <p class="text-muted mb-0">
                                                Aucune facture ne correspond aux critères de recherche.
                                            </p>

                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <small class="text-muted">
                            Affichage de {{ $factures->firstItem() ?? 0 }}
                            à {{ $factures->lastItem() ?? 0 }}
                            sur {{ $factures->total() }} factures
                        </small>
                    </div>
                    @if ($factures->lastPage() > 1)
                        <nav aria-label="Navigation des factures" class="mt-4">
                            <ul class="pagination justify-content-center mb-0">

                                {{-- Page précédente --}}
                                <li class="page-item {{ $factures->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $factures->previousPageUrl() ?? '#' }}">
                                        Précédent
                                    </a>
                                </li>

                                {{-- Numéros des pages --}}
                                @foreach ($factures->getUrlRange(1, $factures->lastPage()) as $page => $url)
                                    <li class="page-item {{ $factures->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endforeach

                                {{-- Page suivante --}}
                                <li class="page-item {{ $factures->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $factures->nextPageUrl() ?? '#' }}">
                                        Suivant
                                    </a>
                                </li>

                            </ul>
                        </nav>
                    @endif
                </div>
            @endif
        </div>



    @endsection



    {{-- <th>Émise par</th> --}}
