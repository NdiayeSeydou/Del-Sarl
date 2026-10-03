@extends('layouts.navbar')
@section('title', 'Mon Profil — DEL SARL')
@section('suite')

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 fw-bold text-dark mb-1">Mon profil</h1>
            <p class="text-muted mb-0">Informations du compte et sécurité.</p>
        </div>
        <span class="badge bg-light text-dark border">{{ $user->fonction ?: 'Utilisateur' }}</span>
    </div>

    <div class="row g-4">
        <div class="col-xl-6">
            <section class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h2 class="h5 mb-0 fw-semibold">Informations personnelles</h2>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profile.update') }}" data-swal-confirm data-swal-title="Enregistrer le profil ?" data-swal-text="Les informations de votre compte seront mises à jour." data-swal-confirm-text="Enregistrer">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nom complet</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" autocomplete="name" required>
                            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" autocomplete="email" required>
                            @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="fonction" class="form-label">Fonction</label>
                            <input id="fonction" name="fonction" type="text" class="form-control" value="{{ old('fonction', $user->fonction) }}" placeholder="Ex. Comptable, Responsable IT">
                            @error('fonction')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

        <div class="col-xl-6">
            <section class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h2 class="h5 mb-0 fw-semibold">Sécurité</h2>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('password.update') }}" data-swal-confirm data-swal-title="Modifier le mot de passe ?" data-swal-text="Vous devrez utiliser le nouveau mot de passe lors de votre prochaine connexion." data-swal-confirm-text="Modifier">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mot de passe actuel</label>
                            <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" required>
                            @error('current_password', 'updatePassword')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" required>
                            @error('password', 'updatePassword')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Mettre à jour le mot de passe</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

        <div class="col-12">
            <section class="card border-danger-subtle shadow-sm">
                <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h2 class="h5 text-danger mb-1">Supprimer le compte</h2>
                        <p class="text-muted mb-0">Cette action est définitive et ferme votre session.</p>
                    </div>
                    <form method="POST" action="{{ route('profile.destroy') }}" class="d-flex flex-column flex-sm-row gap-2 align-items-sm-end" data-swal-confirm data-swal-icon="warning" data-swal-title="Supprimer définitivement le compte ?" data-swal-text="Cette action est irréversible. Votre mot de passe sera demandé par Laravel." data-swal-confirm-text="Supprimer le compte">
                        @csrf
                        @method('DELETE')
                        <div>
                            <label for="delete_password" class="form-label small">Confirmer avec le mot de passe</label>
                            <input id="delete_password" name="password" type="password" class="form-control" autocomplete="current-password" required>
                            @error('password', 'userDeletion')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-outline-danger">Supprimer le compte</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection     