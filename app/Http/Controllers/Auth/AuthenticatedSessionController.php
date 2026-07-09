<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // 1. Aiguillage pour l'Administrateur (On évite redirect()->intended pour forcer la bonne route)
        if ($user->role === 'administrateur' || $user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // 2. Aiguillage pour le Médecin (Si tu as une route dédiée, sinon redirection par défaut)
        if ($user->role === 'medecin') {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // 3. Comportement par défaut (Patients)
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}