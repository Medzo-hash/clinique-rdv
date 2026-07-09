<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <style>
        .dash { max-width: 1100px; margin: 0 auto; padding: 32px 24px; }

        /* WELCOME */
        .welcome-card {
            border-radius: 16px; padding: 28px 32px;
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 28px; position: relative; overflow: hidden;
        }
        /* Changement dynamique de couleur de bannière selon le rôle */
        .welcome-card.admin { background: linear-gradient(135deg, #991b1b, #dc2626); }
        .welcome-card.medecin { background: linear-gradient(135deg, #065f46, #059669); }
        .welcome-card.patient { background: linear-gradient(135deg, #1e3a8a, #1a56db); }

        .welcome-card::before {
            content: ''; position: absolute;
            width: 300px; height: 300px; border-radius: 50%;
            background: rgba(255,255,255,0.05);
            top: -100px; right: -80px;
        }
        .welcome-left { position: relative; z-index: 1; }
        .welcome-left h2 { font-size: 24px; font-weight: 800; color: white; margin-bottom: 6px; }
        .welcome-left p { font-size: 14px; color: rgba(255,255,255,0.8); }
        .welcome-right { position: relative; z-index: 1; }
        .welcome-badge {
            background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 12px 20px; border-radius: 12px; text-align: center;
        }
        .welcome-badge .date { font-size: 13px; color: rgba(255,255,255,0.8); }
        .welcome-badge .time { font-size: 22px; font-weight: 800; color: white; }

        /* STATS */
        .stats-grid { display: grid; gap: 20px; margin-bottom: 28px; }
        .stats-grid-3 { grid-template-columns: repeat(3, 1fr); }

        .stat-card {
            background: white; border-radius: 14px; padding: 22px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            display: flex; align-items: center; gap: 16px;
            border: 1px solid #f1f5f9; transition: all 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
        .stat-icon {
            width: 52px; height: 52px; border-radius: 13px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; flex-shrink: 0;
        }
        .stat-icon.blue { background: #eff6ff; }
        .stat-icon.green { background: #f0fdf4; }
        .stat-icon.red { background: #fef2f2; }
        .stat-value { font-size: 28px; font-weight: 900; color: #0f172a; line-height: 1; }
        .stat-label { font-size: 12px; color: #6b7280; margin-top: 4px; font-weight: 500; }

        /* QUICK ACTIONS */
        .quick-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .action-btn {
            display: flex; flex-direction: column; align-items: center;
            gap: 8px; padding: 20px 12px; border-radius: 12px;
            text-decoration: none; font-size: 13px; font-weight: 600;
            transition: all 0.2s; text-align: center;
        }
        .action-btn .action-icon { font-size: 24px; }
        .action-btn.blue { background: #eff6ff; color: #1a56db; }
        .action-btn.red { background: #fef2f2; color: #dc2626; }
        .action-btn:hover { transform: translateY(-2px); box-shadow: 0 4px 16px rgba(0,0,0,0.1); }

        .dashboard-grid { display: grid; grid-template-columns: 1fr 340px; gap: 20px; }
        .card { background: white; border-radius: 14px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid #f1f5f9; overflow: hidden; }
        .card-header { padding: 18px 24px; border-bottom: 1px solid #f8fafc; }
        .card-title { font-size: 16px; font-weight: 700; color: #0f172a; }
        .card-body { padding: 20px 24px; }

        @media (max-width: 900px) {
            .dashboard-grid { grid-template-columns: 1fr; }
            .stats-grid-3 { grid-template-columns: 1fr; }
        }
    </style>

    <div class="dash">

        {{-- BANNIÈRE DYNAMIQUE --}}
        @php
            $role = Auth::user()->role;
            $isAdmin = ($role === 'administrateur' || $role === 'admin');
            $isMedecin = ($role === 'medecin');
        @endphp

        <div class="welcome-card {{ $isAdmin ? 'admin' : ($isMedecin ? 'medecin' : 'patient') }}">
            <div class="welcome-left">
                <h2>
                    @if ($isAdmin) 👑
                    @elseif ($isMedecin) 👨‍⚕️
                    @else 👋
                    @endif
                    Bonjour, {{ Auth::user()->name }} !
                </h2>
                <p>
                    @if ($isAdmin)
                        Vous gérez l'ensemble de la clinique CliniqPlus (Mode Administrateur)
                    @elseif ($isMedecin)
                        Espace Professionnel — Médecin
                    @else
                        Bienvenue sur votre espace patient CliniqPlus
                    @endif
                </p>
            </div>
            <div class="welcome-right">
                <div class="welcome-badge">
                    <div class="date">{{ now()->locale('fr')->isoFormat('dddd D MMMM') }}</div>
                    <div class="time">{{ now()->format('H:i') }}</div>
                </div>
            </div>
        </div>

        {{-- 1. AFFICHAGE INTERFACE ADMINISTRATEUR --}}
        @if ($isAdmin)
            <div class="stats-grid stats-grid-3">
                <div class="stat-card">
                    <div class="stat-icon red">🩺</div>
                    <div>
                        <div class="stat-value">Actif</div>
                        <div class="stat-label">Gestion Clinique</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon blue">📅</div>
                    <div>
                        <div class="stat-value">Global</div>
                        <div class="stat-label">Flux de Rendez-vous</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">👥</div>
                    <div>
                        <div class="stat-value">Comptes</div>
                        <div class="stat-label">Utilisateurs enregistrés</div>
                    </div>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Outils d'Administration</h3></div>
                    <div class="card-body">
                        <div class="quick-actions">
                            <a href="{{ route('admin.medecins.index') }}" class="action-btn red">
                                <span class="action-icon">👨‍⚕️</span>
                                Gérer les Médecins
                            </a>
                            <a href="#" class="action-btn blue">
                                <span class="action-icon">⚙️</span>
                                Configuration Système
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Statut Plateforme</h3></div>
                    <div class="card-body">
                        <p class="text-sm text-gray-600">Tous les systèmes fonctionnent correctement sur Railway.</p>
                    </div>
                </div>
            </div>

        {{-- 2. AFFICHAGE INTERFACE MÉDECIN --}}
        @elseif ($isMedecin)
            <div class="dashboard-grid">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Mes Consultations du Jour</h3></div>
                    <div class="card-body">
                        <p class="text-gray-500 text-sm">Aucun rendez-vous programmé aujourd'hui.</p>
                    </div>
                </div>
            </div>

        {{-- 3. AFFICHAGE INTERFACE PATIENT (PAR DÉFAUT) --}}
        @else
            <div class="dashboard-grid">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Mes Prochains Rendez-vous</h3></div>
                    <div class="card-body">
                        <p class="text-gray-500 text-sm">Vous n'avez aucun rendez-vous de planifié.</p>
                        <a href="{{ route('rendezvous.create') }}" class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:text-blue-700">
                            Prendre un rendez-vous &rarr;
                        </a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Actions Rapides</h3></div>
                    <div class="card-body">
                        <div class="quick-actions">
                            <a href="{{ route('rendezvous.create') }}" class="action-btn blue">
                                <span class="action-icon">📅</span>
                                Réserver
                            </a>
                            <a href="{{ route('medecins') }}" class="action-btn blue">
                                <span class="action-icon">🔍</span>
                                Annuaire
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</x-app-layout>
