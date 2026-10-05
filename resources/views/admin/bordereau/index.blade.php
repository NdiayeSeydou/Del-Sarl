@extends('layouts.navbar')
@section('title', 'Listes des bordereaux — DEL SARL')
@section('suite')

    <div class="custom-container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0">Liste des bordereaux</h1>
            <a href="{{ route('bordereau.create') }}" class="btn btn-dark" data-swal-confirm
                data-swal-title="Créer un bordereau ?" data-swal-text="Le formulaire de création va s'ouvrir."
                data-swal-confirm-text="Continuer">Ajouter un bordereau</a>
        </div>

        <!-- Formulaire de filtre -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('bordereau.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="filter-date" class="form-label fw-semibold">Date de bordereau</label>
                        <input id="filter-date" type="date" name="date" class="form-control"
                            value="{{ request('date') }}">
                    </div>
                    <div class="col-md-5">
                        <label for="filter-search" class="form-label fw-semibold">Recherche</label>
                        <input id="filter-search" type="text" name="search" class="form-control"
                            value="{{ request('search') }}" placeholder="Code, numéro ou client...">
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                        <a href="{{ route('bordereau.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tableau des bordereaux -->
        @if ($bordereaux->isEmpty())
            <div class="alert alert-light border text-center">Aucun bordereau enregistré.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Numéro</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Articles</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bordereaux as $bordereau)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bordereau->num_bl }}</td>
                                <td>{{ $bordereau->client }}</td>
                                <td>{{ \Carbon\Carbon::parse($bordereau->date_livraison)->format('d/m/Y') }}</td>
                                <td>{{ $bordereau->articles->count() }}</td>

                                <td class="text-end">
                                    <div class="invoice-actions">

                                        {{-- VOIR --}}
                                        <a href="{{ route('bordereau.show', $bordereau) }}"
                                            class="btn btn-ghost btn-icon btn-sm rounded-circle" title="Voir">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">

                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />

                                                <path
                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />

                                            </svg>

                                        </a>


                                        {{-- PDF --}}
                                        <a href="{{ route('bordereau.pdf', $bordereau) }}"
                                            class="btn btn-ghost btn-icon btn-sm rounded-circle" title="Télécharger PDF">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">

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
                                        <a href="{{ route('bordereau.edit', $bordereau) }}"
                                            class="btn btn-ghost btn-icon btn-sm rounded-circle" title="Modifier"
                                            data-swal-confirm data-swal-title="Modifier ce bordereau ?"
                                            data-swal-text="Le formulaire de modification va s'ouvrir."
                                            data-swal-confirm-text="Continuer">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">

                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />

                                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />

                                                <path d="M13.5 6.5l4 4" />

                                            </svg>

                                        </a>


                                        {{-- SUPPRIMER --}}
                                        <form action="{{ route('bordereau.destroy', $bordereau) }}" method="POST"
                                            style="display: inline;" data-swal-confirm data-swal-icon="warning"
                                            data-swal-title="Supprimer ce bordereau ?"
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
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <small class="text-muted">
                        Affichage de {{ $bordereaux->firstItem() ?? 0 }}
                        à {{ $bordereaux->lastItem() ?? 0 }}
                        sur {{ $bordereaux->total() }} bordereaux
                    </small>
                </div>
                @if ($bordereaux->lastPage() > 1)

                    <nav aria-label="Navigation des bordereaux" class="mt-4">

                        <ul class="pagination justify-content-center mb-0">

                            {{-- Page précédente --}}
                            <li class="page-item {{ $bordereaux->onFirstPage() ? 'disabled' : '' }}">

                                <a class="page-link" href="{{ $bordereaux->previousPageUrl() ?? '#' }}">

                                    Précédent

                                </a>

                            </li>


                            {{-- Numéros des pages --}}
                            @foreach ($bordereaux->getUrlRange(1, $bordereaux->lastPage()) as $page => $url)
                                <li class="page-item {{ $bordereaux->currentPage() == $page ? 'active' : '' }}">

                                    <a class="page-link" href="{{ $url }}">

                                        {{ $page }}

                                    </a>

                                </li>
                            @endforeach


                            {{-- Page suivante --}}
                            <li class="page-item {{ $bordereaux->hasMorePages() ? '' : 'disabled' }}">

                                <a class="page-link" href="{{ $bordereaux->nextPageUrl() ?? '#' }}">

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
