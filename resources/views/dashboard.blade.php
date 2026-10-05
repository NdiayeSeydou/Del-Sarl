@extends('layouts.navbar')
@section('title', 'Centre de Contrôle — DEL SARL')
@section('suite')
    <!-- row -->
    <div class="row mb-6 g-6">
        <div class="col-xl-8 col-lg-6">
            <div class="bg-gradient-mixed p-8 py-10 rounded-3 p-lg-7">
                <!--heading-->
                <h1 class="fs-5">👋 Bonjour {{ auth()->user()->name ?: 'Admin' }},</h1>
                <p class="mb-0">Bienvenue sur le tableau de bord de DOUCOURÉ ÉQUIPEMENT ET LOGISTIQUE SARL !</p>


            </div>
        </div>

    </div>
    <!-- row -->
    <!-- container -->
    <div class="custom-container">
        <div class="row g-6 mb-6">
            <div class="col-xl-3 col-md-6 col-12">
                <!-- card -->
                <div class="card card-lg bg-gradient-success">
                    <!-- card body -->
                    <div class="card-body d-flex flex-column gap-8">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">Total Facturé (Mois)</div>
                            </div>
                            <div class="text-success-emphasis">

                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icon-tabler-shopping-cart">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="9" cy="19" r="2" />
                                    <circle cx="17" cy="19" r="2" />
                                    <path d="M5 6h14l-1 7h-12l-1 -7z" />
                                    <path d="M6 6l-2 -3" />
                                </svg>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1 d-flex flex-column gap-3">
                            <div class="fs-1 fw-bold text-truncate"
                                style="max-width: 100%; font-size: clamp(1.5rem, 3vw, 2.5rem) !important;"
                                title="{{ number_format($montantFacturesMois, 0, ',', ' ') }} F">
                                {{ number_format($montantFacturesMois, 0, ',', ' ') }} F
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <!-- card -->
                <div class="card card-lg bg-gradient-info">
                    <!-- card body -->
                    <div class="card-body d-flex flex-column gap-8">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div>Pro Forma</div>
                            </div>
                            <div class="text-info-emphasis">

                               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 4h16v16h-16z" />
                                    <path d="M8 8h8" />
                                    <path d="M8 12h8" />
                                    <path d="M8 16h5" />
                                </svg>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1 d-flex flex-column gap-3">
                            <div class="fs-1 fw-bold">
                                {{ number_format($totalProformas, 0, ',', ' ') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <!-- card -->
                <div class="card card-lg bg-gradient-danger">
                    <!-- card body -->
                    <div class="card-body d-flex flex-column gap-8">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div>Bordereaux </div>
                            </div>
                            <div class="text-danger-emphasis">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icon-tabler-tool">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 6l7 7l-4 4l-7 -7" />
                                    <path d="M8 8l-5 5l4 4l5 -5" />
                                    <path d="M9 17l-2 2l-4 -4l2 -2" />
                                </svg>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1 d-flex flex-column gap-3">
                            <div class="fs-1 fw-bold">
                                {{ number_format($totalBordereaux, 0, ',', ' ') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <!-- card -->
                <div class="card card-lg bg-gradient-warning">
                    <!-- card body -->
                    <div class="card-body d-flex flex-column gap-8">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div>Factures</div>
                            </div>
                            <div class="text-warning-emphasis">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path
                                        d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25" />
                                </svg>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1 d-flex flex-column gap-3">
                            <div class="fs-1 fw-bold">
                                {{ number_format($totalFactures, 0, ',', ' ') }}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- row  -->



    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-12">

            <div class="card card-lg">

                {{-- Header --}}
                <div class="card-header border-bottom-0">
                    <div>
                        <h5 class="mb-0">Historique des documents générés</h5>
                        <small class="text-muted">
                            Les 5 derniers documents enregistrés
                        </small>
                    </div>
                </div>

                {{-- Tableau --}}
                <div class="table-responsive">

                    <table class="table text-nowrap mb-0 table-centered table-hover">

                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Client</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($documents as $document)
                                <tr>

                                    {{-- Référence --}}
                                    <td>
                                        <span class="fw-semibold">
                                            {{ $document['reference'] }}
                                        </span>
                                    </td>

                                    {{-- Client --}}
                                    <td>
                                        {{ \Illuminate\Support\Str::limit($document['client'], 15, '...') }}
                                    </td>

                                    {{-- Montant --}}
                                    <td>
                                        @if ($document['montant'] !== null)
                                            <span class="fw-semibold">
                                                {{ number_format($document['montant'], 0, ',', ' ') }}
                                                {{ $document['unite'] }}
                                            </span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>

                                    {{-- Date --}}
                                    <td>
                                        {{ \Carbon\Carbon::parse($document['date'])->format('d/m/Y') }}
                                    </td>

                                    {{-- Type --}}
                                    <td>

                                        @if ($document['type'] === 'Facture')
                                            <span class="badge text-primary-emphasis bg-primary-subtle">
                                                Facture
                                            </span>
                                        @elseif ($document['type'] === 'Pro Forma')
                                            <span class="badge text-warning-emphasis bg-warning-subtle">
                                                Pro Forma
                                            </span>
                                        @else
                                            <span class="badge text-secondary-emphasis bg-secondary-subtle">
                                                Bordereau
                                            </span>
                                        @endif

                                    </td>

                                    {{-- Action --}}
                                    <td class="text-end">

                                        <a href="{{ $document['route'] }}"
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

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        Aucun document enregistré.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>
@endsection
