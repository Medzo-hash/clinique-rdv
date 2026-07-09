<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RendezVousController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/medecins', function () {
    $medecins = \App\Models\User::where('role', 'medecin')->get();
    return view('medecins', compact('medecins'));
})->name('medecins');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// Admin — Tableau de bord et Gestion des médecins
Route::prefix('admin')->name('admin.')->group(function () {
    // Nouvelle route pour le tableau de bord admin (on réutilise temporairement la vue medecins de l'admin ou une vue spécifique)
    Route::get('/dashboard', function () {
        return redirect()->route('admin.medecins.index'); 
    })->name('dashboard');

    Route::resource('medecins', \App\Http\Controllers\Admin\MedecinController::class);
});

    // Rendez-vous
    Route::get('/rendezvous', [RendezVousController::class, 'index'])->name('rendezvous.index');
    Route::get('/rendezvous/creer', [RendezVousController::class, 'create'])->name('rendezvous.create');
    Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');
    Route::patch('/rendezvous/{rendezVous}/confirmer', [RendezVousController::class, 'confirmer'])->name('rendezvous.confirmer');
    Route::patch('/rendezvous/{rendezVous}/annuler', [RendezVousController::class, 'annuler'])->name('rendezvous.annuler');
});

require __DIR__.'/auth.php';