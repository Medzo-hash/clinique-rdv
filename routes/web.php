<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RendezVousController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Espace général (Patients / Médecins par défaut)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Liste publique des médecins
Route::get('/medecins', function () {
    $medecins = \App\Models\User::where('role', 'medecin')->get();
    return view('medecins', compact('medecins'));
})->name('medecins');

// Routes protégées par Authentification
Route::middleware('auth')->group(function () {
    
    // Gestion du profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ZONE ADMIN — Tableau de bord & Gestion de la clinique
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Vrai Tableau de bord Administrateur stylisé pour le Jury
        Route::get('/dashboard', function () {
            $nbMedecins = \App\Models\User::where('role', 'medecin')->count();
            $nbPatients = \App\Models\User::where('role', 'patient')->count();
            $nbRdv = \App\Models\RendezVous::count();

            return "
            <div style='font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; padding: 40px; background: #f1f5f9; min-height: 100vh;'>
                <div style='max-width: 1000px; margin: 0 auto;'>
                    
                    <div style='background: white; padding: 24px 32px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center;'>
                        <div>
                            <h1 style='color: #0f172a; margin: 0; font-size: 24px; font-weight: 800;'>👑 Panneau d'Administration</h1>
                            <p style='color: #64748b; margin: 4px 0 0 0; font-size: 14px;'>Gestion globale de la plateforme CliniqPlus</p>
                        </div>
                        <span style='background: #dbeafe; color: #1e40af; padding: 6px 12px; border-radius: 9999px; font-size: 13px; font-weight: 600;'>Session Super Admin Active</span>
                    </div>

                    <div style='display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 24px;'>
                        <div style='background: white; padding: 24px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); border-left: 4px solid #1a56db;'>
                            <div style='color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase;'>Médecins Partenaires</div>
                            <div style='color: #1e293b; font-size: 32px; font-weight: 800; margin-top: 8px;'>{$nbMedecins}</div>
                        </div>
                        <div style='background: white; padding: 24px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); border-left: 4px solid #10b981;'>
                            <div style='color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase;'>Patients Inscrits</div>
                            <div style='color: #1e293b; font-size: 32px; font-weight: 800; margin-top: 8px;'>{$nbPatients}</div>
                        </div>
                        <div style='background: white; padding: 24px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); border-left: 4px solid #f59e0b;'>
                            <div style='color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase;'>Consultations & RDV</div>
                            <div style='color: #1e293b; font-size: 32px; font-weight: 800; margin-top: 8px;'>{$nbRdv}</div>
                        </div>
                    </div>

                    <div style='background: white; padding: 32px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05);'>
                        <h3 style='color: #1e293b; margin-top: 0; margin-bottom: 12px; font-size: 18px;'>Actions d'administration disponibles</h3>
                        <p style='color: #64748b; font-size: 14px; margin-bottom: 24px;'>Vous pouvez ajouter, modifier les plannings ou révoquer l'accès des praticiens de la santé inscrits sur CliniqPlus.</p>
                        
                        <a href='" . route('admin.medecins.index') . "' style='display: inline-flex; align-items: center; background: #1a56db; color: white; padding: 12px 24px; text-decoration: none; border-radius: 10px; font-weight: 600; font-size: 14px; box-shadow: 0 4px 12px rgba(26, 86, 219, 0.2);'>
                            👨‍⚕️ Accéder au Module de Gestion des Médecins →
                        </a>
                    </div>

                </div>
            </div>
            ";
        })->name('dashboard');

        // CRUD complet pour la gestion des médecins
        Route::resource('medecins', \App\Http\Controllers\Admin\MedecinController::class);
    });

    // Gestion des Rendez-vous médicaux
    Route::get('/rendezvous', [RendezVousController::class, 'index'])->name('rendezvous.index');
    Route::get('/rendezvous/creer', [RendezVousController::class, 'create'])->name('rendezvous.create');
    Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');
    Route::patch('/rendezvous/{rendezVous}/confirmer', [RendezVousController::class, 'confirmer'])->name('rendezvous.confirmer');
    Route::patch('/rendezvous/{rendezVous}/annuler', [RendezVousController::class, 'annuler'])->name('rendezvous.annuler');
});

require __DIR__.'/auth.php';