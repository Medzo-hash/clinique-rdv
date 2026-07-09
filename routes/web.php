<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RendezVousController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Le tableau de bord pour les Patients et Médecins
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Liste publique des médecins
Route::get('/medecins', function () {
    $medecins = \App\Models\User::where('role', 'medecin')->get();
    return view('medecins', compact('medecins'));
})->name('medecins');

// Routes protégées par l'authentification
Route::middleware('auth')->group(function () {
    
    // Gestion du profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Espace Admin — Redirection vers sa propre vue dédiée
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard'); // Point vers resources/views/admin/dashboard.blade.php
        })->name('dashboard');

        // CRUD pour la gestion des médecins par l'admin
        Route::resource('medecins', \App\Http\Controllers\Admin\MedecinController::class);
    });

    // Gestion des Rendez-vous
    Route::get('/rendezvous', [RendezVousController::class, 'index'])->name('rendezvous.index');
    Route::get('/rendezvous/creer', [RendezVousController::class, 'create'])->name('rendezvous.create');
    Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');
    Route::patch('/rendezvous/{rendezVous}/confirmer', [RendezVousController::class, 'confirmer'])->name('rendezvous.confirmer');
    Route::patch('/rendezvous/{rendezVous}/annuler', [RendezVousController::class, 'annuler'])->name('rendezvous.annuler');
});

require __DIR__.'/auth.php';
