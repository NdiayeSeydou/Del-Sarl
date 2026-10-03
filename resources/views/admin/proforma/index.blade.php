@extends('layouts.navbar')

@section('title', 'Listes des proformas — DEL SARL')

@section('suite')

    <div class="custom-container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0">Liste des proformas</h1>

            <a href="{{ route('proforma.create') }}" class="btn btn-dark">
                <i class="bi bi-plus-circle me-1"></i>
                Ajouter une proforma
            </a>
        </div>

        {{-- Formulaire de filtre --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <form method="GET" action="{{ route('proforma.index') }}" class="row g-3 align-items-end">

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>

                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Recherche</label>
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Numéro ou client">
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">

                            Filtrer
                        </button>

                        <a href="{{ route('proforma.index') }}" class="btn btn-outline-secondary w-100">
                            Reset
                        </a>
                    </div>

                </form>
            </div>
        </div>

        {{-- Tableau des proformas --}}
        @if ($proformas->isEmpty())

            <div class="alert alert-light border text-center">
                Aucune proforma enregistrée.
            </div>
        @else
            <div class="table-responsive">

                <table class="table table-striped table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Numéro</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Devise</th>
                            <th>Montant</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($proformas as $proforma)
                            <tr>
                                <td>{{ $proformas->firstItem() + $loop->index }}</td>

                                <td>
                                    <span class="fw-semibold">
                                        {{ $proforma->num_proforma }}
                                    </span>
                                </td>

                                <td>{{ \Illuminate\Support\Str::limit($proforma->client, 14, '...') }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($proforma->date_proforma)->format('d/m/Y') }}
                                </td>

                                <td>{{ $proforma->devise }}</td>

                                <td>
                                    {{ number_format($proforma->grand_total, 0, ',', ' ') }}
                                    {{ $proforma->devise === 'XOF' ? 'FCFA' : $proforma->devise }}
                                </td>
                                <td class="text-end">
                                    <div class="invoice-actions">

                                        {{-- VOIR --}}
                                        <a href="{{ route('proforma.show', $proforma) }}"
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
                                        <a href="{{ route('proforma.pdf', $proforma) }}"
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
                                        <a href="{{ route('proforma.edit', $proforma) }}"
                                            class="btn btn-ghost btn-icon btn-sm rounded-circle" title="Modifier"
                                            data-swal-confirm data-swal-title="Modifier cette proforma ?"
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
                                        <form action="{{ route('proforma.destroy', $proforma) }}" method="POST"
                                            style="display: inline;" data-swal-confirm data-swal-icon="warning"
                                            data-swal-title="Supprimer cette proforma ?"
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

            </div>

            {{-- Pagination --}}
            @if ($proformas->lastPage() > 1)
                <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">

                    <div class="text-muted small">
                        Affichage de {{ $proformas->firstItem() }}
                        à {{ $proformas->lastItem() }}
                        sur {{ $proformas->total() }} proformas
                    </div>

                    <div>
                        {{ $proformas->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            @endif

        @endif

    </div>

@endsection
