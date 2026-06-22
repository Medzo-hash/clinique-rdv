<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MedecinController extends Controller
{
    public function index()
    {
        $this->autoriserAdmin();
        $medecins = User::where('role', 'medecin')->get();
        return view('admin.medecins.index', compact('medecins'));
    }

    public function create()
    {
        $this->autoriserAdmin();
        return view('admin.medecins.create');
    }

    public function store(Request $request)
    {
        $this->autoriserAdmin();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'telephone' => ['required', 'string', 'max:20'],
            'specialite' => ['required', 'string', 'max:255'],
            'password' => ['required', 'min:8'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'specialite' => $request->specialite,
            'role' => 'medecin',
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.medecins.index')
            ->with('success', 'Médecin ajouté avec succès.');
    }

    public function edit(User $medecin)
    {
        $this->autoriserAdmin();
        return view('admin.medecins.edit', compact('medecin'));
    }

    public function update(Request $request, User $medecin)
    {
        $this->autoriserAdmin();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:20'],
            'specialite' => ['required', 'string', 'max:255'],
        ]);

        $medecin->update([
            'name' => $request->name,
            'telephone' => $request->telephone,
            'specialite' => $request->specialite,
        ]);

        return redirect()->route('admin.medecins.index')
            ->with('success', 'Médecin modifié avec succès.');
    }

    public function destroy(User $medecin)
    {
        $this->autoriserAdmin();
        $medecin->delete();
        return redirect()->route('admin.medecins.index')
            ->with('success', 'Médecin supprimé avec succès.');
    }

    private function autoriserAdmin()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
    }
}