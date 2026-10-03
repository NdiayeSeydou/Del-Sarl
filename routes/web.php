<?php

use App\Http\Controllers\Admin\BordereauController;
use App\Http\Controllers\Admin\DocumentPdfController;
use App\Http\Controllers\Admin\FactureController;
use App\Http\Controllers\Admin\ProformaController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// page d'accueil
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profil/utilisateur', [ProfileController::class, 'edit'])->name('profil.utilisateur');

    Route::get('/liste/des/factures', [FactureController::class, 'index'])->name('facture.index');
    Route::get('/factures/creer', [FactureController::class, 'create'])->name('facture.create');
    Route::post('/factures', [FactureController::class, 'store'])->name('facture.store');
    Route::get('/factures/{facture}/pdf', [DocumentPdfController::class, 'facture'])->name('facture.pdf');
    Route::get('/factures/{facture}', [FactureController::class, 'show'])->name('facture.show');
    Route::get('/factures/{facture}/edit', [FactureController::class, 'edit'])->name('facture.edit');
    Route::put('/factures/{facture}', [FactureController::class, 'update'])->name('facture.update');
    Route::delete('/factures/{facture}', [FactureController::class, 'destroy'])->name('facture.destroy');

    Route::get('/liste/des/bordereaux', [BordereauController::class, 'index'])->name('bordereau.index');
    Route::get('/bordereaux/creer', [BordereauController::class, 'create'])->name('bordereau.create');
    Route::post('/bordereaux', [BordereauController::class, 'store'])->name('bordereau.store');
    Route::get('/bordereaux/{bordereau}/pdf', [DocumentPdfController::class, 'bordereau'])->name('bordereau.pdf');
    Route::get('/bordereaux/{bordereau}', [BordereauController::class, 'show'])->name('bordereau.show');
    Route::get('/bordereaux/{bordereau}/edit', [BordereauController::class, 'edit'])->name('bordereau.edit');
    Route::put('/bordereaux/{bordereau}', [BordereauController::class, 'update'])->name('bordereau.update');
    Route::delete('/bordereaux/{bordereau}', [BordereauController::class, 'destroy'])->name('bordereau.destroy');

    Route::get('/liste/des/proformas', [ProformaController::class, 'index'])->name('proforma.index');
    Route::get('/proformas/creer', [ProformaController::class, 'create'])->name('proforma.create');
    Route::post('/proformas', [ProformaController::class, 'store'])->name('proforma.store');
    Route::get('/proformas/{proforma}/pdf', [DocumentPdfController::class, 'proforma'])->name('proforma.pdf');
    Route::get('/proformas/{proforma}', [ProformaController::class, 'show'])->name('proforma.show');
    Route::get('/proformas/{proforma}/edit', [ProformaController::class, 'edit'])->name('proforma.edit');
    Route::put('/proformas/{proforma}', [ProformaController::class, 'update'])->name('proforma.update');
    Route::delete('/proformas/{proforma}', [ProformaController::class, 'destroy'])->name('proforma.destroy');
});

// Route globale de secours (Fallback) pour intercepter les URLs inconnues
Route::fallback([NotFoundController::class, 'show']);

// });

// authentification des utilisateurs (laravel breeze)

require __DIR__.'/auth.php';
