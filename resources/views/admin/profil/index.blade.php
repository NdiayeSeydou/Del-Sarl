@extends('layouts.navbar')
@section('title', 'Mon Profil — DEL SARL')
@section('suite')

<div class="container-fluid py-4">
    <!-- En-tête de la page -->
    <div class="mb-4 pb-2">
        <h2 class="fw-bold text-dark mb-0">Mon Profil</h2>
        <p class="text-muted small mb-0">Gérez vos informations personnelles et vos paramètres de sécurité.</p>
    </div>

    <!-- Alertes de succès / erreur (Laravel) -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Section 1 : Informations personnelles (Email & Fonction) -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title mb-0 fw-bold text-dark">Informations du compte</h5>
                </div>
                <div class="card-body p-4">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Adresse Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="seydou@delsarl.com" placeholder="exemple@delsarl.com" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">Fonction / Rôle <span class="text-danger">*</span></label>
                            <input type="text" name="fonction" class="form-control" value="Développeur Full-Stack" placeholder="ex: Responsable IT, Comptable..." required>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark rounded-3 px-4">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Section 2 : Modification du mot de passe -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title mb-0 fw-bold text-dark">Sécurité & Mot de passe</h5>
                </div>
                <div class="card-body p-4">
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Mot de passe actuel <span class="text-danger">*</span></label>
                            <input type="password" name="current_password" class="form-control" placeholder="••••••••" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Nouveau mot de passe <span class="text-danger">*</span></label>
                            <input type="password" name="new_password" class="form-control" placeholder="••••••••" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">Confirmer le nouveau mot de passe <span class="text-danger">*</span></label>
                            <input type="password" name="new_password_confirmation" class="form-control" placeholder="••••••••" required>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-dark rounded-3 px-4">
                                Mettre à jour le mot de passe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection     