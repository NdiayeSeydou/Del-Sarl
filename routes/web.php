<?php

use App\Http\Controllers\Admin\BordereauController;
use App\Http\Controllers\Admin\FactureController;
use App\Http\Controllers\Admin\ProformaController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


//page d'accueil
Route::get('/', function () {
    return view('welcome');
});


//page d'accueil du dashboard

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


//routes pour le profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//routes pour les factures
// Route::prefix('admin')->name('admin.')->group(function () {

 Route::get('/liste/des/factures', [FactureController::class, 'index'])->name('facture.index');
 Route::get('/voir/une/facture', [FactureController::class, 'show'])->name('facture.show');
 Route::get('/modifier/une/facture', [FactureController::class, 'edit'])->name('facture.edit');
 Route::get('/creer/une/facture', [FactureController::class, 'create'])->name('facture.create');


//routes pour les bordereaux
Route::get('/liste/des/bordereaux', [BordereauController::class, 'index'])->name('bordereau.index');
Route::get('/voir/un/bordereau', [BordereauController::class, 'show'])->name('bordereau.show');
Route::get('/modifier/un/bordereau', [BordereauController::class, 'edit'])->name('bordereau.edit');
Route::get('/creer/un/bordereau', [BordereauController::class, 'create'])->name('bordereau.create');

//routes pour les proformas
Route::get('/liste/des/proformas', [ProformaController::class, 'index'])->name('proforma.index');
Route::get('/voir/un/proforma', [ProformaController::class, 'show'])->name('proforma.show');
Route::get('/modifier/un/proforma', [ProformaController::class, 'edit'])->name('proforma.edit');
Route::get('/creer/un/proforma', [ProformaController::class, 'create'])->name('proforma.create');

//routes pour le profil utilisateur
Route::get('/profil/utilisateur', [App\Http\Controllers\Admin\ProfilController::class, 'profil'])->name('profil.utilisateur');

// Route globale de secours (Fallback) pour intercepter les URLs inconnues
Route::fallback([NotFoundController::class, 'show']);

// });






//authentification des utilisateurs (laravel breeze)

require __DIR__.'/auth.php';
