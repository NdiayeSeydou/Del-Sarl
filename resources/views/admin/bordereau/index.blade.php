@extends('layouts.navbar')
@section('title', 'Listes des bordereaux — DEL SARL')
@section('suite')

<div class="custom-container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Liste des bordereaux</h1>
        <a href="{{ route('bordereau.create') }}" class="btn btn-dark" data-swal-confirm data-swal-title="Créer un bordereau ?" data-swal-text="Le formulaire de création va s'ouvrir." data-swal-confirm-text="Continuer">+ Ajouter un bordereau</a>
    </div>

    <!-- Formulaire de filtre -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('bordereau.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="filter-date" class="form-label fw-semibold">Date de bordereau</label>
                    <input id="filter-date" type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-5">
                    <label for="filter-search" class="form-label fw-semibold">Recherche</label>
                    <input id="filter-search" type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Code, numéro ou client...">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                    <a href="{{ route('bordereau.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau des bordereaux -->
    @if($bordereaux->isEmpty())
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
                    @foreach($bordereaux as $bordereau)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bordereau->num_bl }}</td>
                            <td>{{ $bordereau->client }}</td>
                            <td>{{ \Carbon\Carbon::parse($bordereau->date_livraison)->format('d/m/Y') }}</td>
                            <td>{{ $bordereau->articles->count() }}</td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('bordereau.show', $bordereau) }}" class="btn btn-sm btn-outline-primary">Voir</a>
                                    <a href="{{ route('bordereau.pdf', $bordereau) }}" class="btn btn-sm btn-outline-primary">PDF</a>
                                    <a href="{{ route('bordereau.edit', $bordereau) }}" class="btn btn-sm btn-outline-secondary" data-swal-confirm data-swal-title="Modifier ce bordereau ?" data-swal-text="Le formulaire de modification va s'ouvrir." data-swal-confirm-text="Continuer">Modifier</a>
                                    <form action="{{ route('bordereau.destroy', $bordereau) }}" method="POST" data-swal-confirm data-swal-icon="warning" data-swal-title="Supprimer ce bordereau ?" data-swal-text="Cette action est irréversible." data-swal-confirm-text="Supprimer">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection