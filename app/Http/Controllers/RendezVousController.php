<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezVousController extends Controller
{
    /**
     * Liste des rendez-vous (selon le rôle connecté)
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $rendezVous = RendezVous::with(['patient', 'medecin'])->orderBy('date')->get();
        } elseif ($user->isMedecin()) {
            $rendezVous = RendezVous::with('patient')->where('medecin_id', $user->id)->orderBy('date')->get();
        } else {
            $rendezVous = RendezVous::with('medecin')->where('patient_id', $user->id)->orderBy('date')->get();
        }

        return view('rendezvous.index', compact('rendezVous'));
    }

    /**
     * Formulaire de prise de rendez-vous
     */
    public function create()
    {
        $medecins = User::where('role', 'medecin')->get();
        return view('rendezvous.create', compact('medecins'));
    }

    /**
     * Enregistrer un nouveau rendez-vous
     */
    public function store(Request $request)
    {
        $request->validate([
            'medecin_id' => ['required', 'exists:users,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'heure' => ['required'],
            'motif' => ['nullable', 'string', 'max:500'],
        ]);

        // Vérifier que le créneau est libre
        $dejaPris = RendezVous::where('medecin_id', $request->medecin_id)
            ->where('date', $request->date)
            ->where('heure', $request->heure)
            ->where('statut', '!=', 'annule')
            ->exists();

        if ($dejaPris) {
            return back()->withErrors(['heure' => 'Ce créneau est déjà pris. Choisissez un autre horaire.']);
        }

        RendezVous::create([
            'patient_id' => Auth::id(),
            'medecin_id' => $request->medecin_id,
            'date' => $request->date,
            'heure' => $request->heure,
            'motif' => $request->motif,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous demandé avec succès.');
    }

    /**
     * Confirmer un rendez-vous (admin ou médecin)
     */
    public function confirmer(RendezVous $rendezVous)
    {
        $this->autoriserGestion($rendezVous);

        $rendezVous->update(['statut' => 'confirme']);

        return back()->with('success', 'Rendez-vous confirmé.');
    }

    /**
     * Annuler un rendez-vous
     */
    public function annuler(RendezVous $rendezVous)
    {
        $user = Auth::user();

        // Le patient peut annuler son propre RDV, l'admin/médecin aussi
        if ($user->id !== $rendezVous->patient_id && !$user->isAdmin() && $user->id !== $rendezVous->medecin_id) {
            abort(403);
        }

        $rendezVous->update(['statut' => 'annule']);

        return back()->with('success', 'Rendez-vous annulé.');
    }

    /**
     * Vérifie que l'utilisateur a le droit de gérer ce RDV (admin ou médecin concerné)
     */
    private function autoriserGestion(RendezVous $rendezVous): void
    {
        $user = Auth::user();

        if (!$user->isAdmin() && $user->id !== $rendezVous->medecin_id) {
            abort(403);
        }
    }
}