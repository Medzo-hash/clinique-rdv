<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord
        </h2>
    </x-slot>

    <style>
        .dash { max-width: 1100px; margin: 0 auto; padding: 32px 24px; }

        /* WELCOME */
        .welcome-card {
            background: linear-gradient(135deg, #1e3a8a, #1a56db);
            border-radius: 16px; padding: 28px 32px;
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 28px; position: relative; overflow: hidden;
        }
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
        .stats-grid {
            display: grid; gap: 20px; margin-bottom: 28px;
        }
        .stats-grid-5 { grid-template-columns: repeat(5, 1fr); }
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
        .stat-icon.orange { background: #fff7ed; }
        .stat-icon.red { background: #fef2f2; }
        .stat-icon.purple { background: #faf5ff; }
        .stat-value { font-size: 28px; font-weight: 900; color: #0f172a; line-height: 1; }
        .stat-label { font-size: 12px; color: #6b7280; margin-top: 4px; font-weight: 500; }
        .stat-change { font-size: 12px; margin-top: 6px; font-weight: 600; }
        .stat-change.up { color: #16a34a; }
        .stat-change.neutral { color: #6b7280; }

        /* CARDS */
        .card {
            background: white; border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border: 1px solid #f1f5f9; overflow: hidden;
        }
        .card-header {
            padding: 18px 24px; border-bottom: 1px solid #f8fafc;
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-title { font-size: 16px; font-weight: 700; color: #0f172a; }
        .card-body { padding: 20px 24px; }
        .card-link {
            font-size: 13px; font-weight: 600; color: #1a56db;
            text-decoration: none;
        }

        /* GRID LAYOUT */
        .dashboard-grid { display: grid; grid-template-columns: 1fr 340px; gap: 20px; }

        /* RDV LIST */
        .rdv-item {
            display: flex; align-items: center; gap: 14px;
            padding: 14px; border-radius: 10px; margin-bottom: 10px;
            background: #f8fafc; border: 1px solid #f1f5f9;
            transition: all 0.2s;
        }
        .rdv-item:hover { background: #eff6ff; border-color: #bfdbfe; }
        .rdv-item:last-child { margin-bottom: 0; }
        .rdv-date {
            min-width: 52px; text-align: center; padding: 8px;
            background: #1a56db; border-radius: 10px;
        }
        .rdv-date .day { font-size: 18px; font-weight: 900; color: white; line-height: 1; }
        .rdv-date .month { font-size: 10px; color: rgba(255,255,255,0.8); font-weight: 600; text-transform: uppercase; }
        .rdv-info { flex: 1; }
        .rdv-info .name { font-size: 14px; font-weight: 700; color: #0f172a; }
        .rdv-info .time { font-size: 12px; color: #6b7280; margin-top: 2px; }
        .rdv-badge {
            padding: 4px 10px; border-radius: 20px;
            font-size: 11px; font-weight: 700;
        }
        .rdv-badge.confirme { background: #dcfce7; color: #15803d; }
        .rdv-badge.en_attente { background: #fef3c7; color: #b45309; }
        .rdv-badge.annule { background: #fee2e2; color: #b91c1c; }

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
        .action-btn.green { background: #f0fdf4; color: #16a34a; }
        .action-btn.orange { background: #fff7ed; color: #ea580c; }
        .action-btn.purple { background: #faf5ff; color: #7c3aed; }
        .action-btn:hover { transform: translateY(-2px); box-shadow: 0 4px 16px rgba(0,0,0,0.1); }

        /* OCCUPATION */
        .occupation-item { margin-bottom: 16px; }
        .occupation-item:last-child { margin-bottom: 0; }
        .occupation-header {
            display: flex; justify-content: space-between;
            font-size: 13px; margin-bottom: 6px;
        }
        .occupation-header span:first-child { font-weight: 600; color: #0f172a; }
        .occupation-header span:last-child { color: #6b7280; font-weight: 600; }
        .progress-bar {
            height: 8px; background: #f1f5f9; border-radius: 99px; overflow: hidden;
        }
        .progress-fill { height: 100%; border-radius: 99px; transition: width 0.5s; }

        /* TABLE */
        .table { width: 100%; border-collapse: collapse; }
        .table th {
            padding: 12px 16px; text-align: left;
            font-size: 11px; text-transform: uppercase;
            letter-spacing: 0.5px; color: #6b7280;
            border-bottom: 1px solid #f1f5f9; font-weight: 700;
        }
        .table td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid #f8fafc; }
        .table tr:last-child td { border: none; }
        .table tr:hover td { background: #f8fafc; }

        @media (max-width: 900px) {
            .stats-grid-5 { grid-template-columns: repeat(2, 1fr); }
            .dashboard-grid { grid-template-columns: 1fr; }
            .quick-actions { grid-template-columns: repeat(4, 1fr); }
        }
    </style>

    <div class="dash">

        {{-- WELCOME CARD --}}
        <div class="welcome-card">
            <div class="welcome-left">
                <h2>
                    @if (Auth::user()->isAdmin()) 👑
                    @elseif (Auth::user()->isMedecin()) 👨‍⚕️
                    @else 👋
                    @endif
                    Bonjour, {{ Auth::user()->name }} !
                </h2>
                <p>
                    @if (Auth::user()->isAdmin())
                        Vous gérez l'ensemble de la clinique CliniqPlus
                    @elseif (Auth::user()->isMedecin())
                        Médecin — {{ Auth::user()->specialite }}
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

        {{-- DASHBOARD PATIENT --}}
        @if (Auth::user()->isPatient())
            <div class="stats-grid stats-grid-3" style="margin-bottom:28px">
                <div class="stat-card">
                    <div class="stat-icon blue">📅</div>
                    <div>
                        <div class="stat-value">{{ Auth::user()->rendezVousPatient()->count() }}</div>
                        <div class="stat-label">Total rendez-vous</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">✅</div>
                    <div>
                        <div class="stat-value">{{ Auth::user()->rendezVousPatient()->where('statut','confirme')->count() }}</div>
                        <div class="stat-label">Confirmés</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon orange">⏳</div>
                    <div>
                        <div class="stat-value">{{ Auth::user()->rendezVousPatient()->where('statut','en_attente')->count() }}</div>
                        <div class="stat-label">En attente</div>
                    </div>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">📋 Mes rendez-vous</span>
                        <a href="{{ route('rendezvous.index') }}" class="card-link">Voir tout →</a>
                    </div>
                    <div class="card-body">
                        @php $rdvs = Auth::user()->rendezVousPatient()->with('medecin')->orderBy('date')->take(5)->get(); @endphp
                        @forelse ($rdvs as $rdv)
                            <div class="rdv-item">
                                <div class="rdv-date">
                                    <div class="day">{{ \Carbon\Carbon::parse($rdv->date)->format('d') }}</div>
                                    <div class="month">{{ \Carbon\Carbon::parse($rdv->date)->locale('fr')->isoFormat('MMM') }}</div>
                                </div>
                                <div class="rdv-info">
                                    <div class="name">Dr. {{ $rdv->medecin->name }}</div>
                                    <div class="time">🕐 {{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }} @if($rdv->medecin->specialite) — {{ $rdv->medecin->specialite }} @endif</div>
                                </div>
                                <span class="rdv-badge {{ $rdv->statut }}">
                                    @if($rdv->statut === 'confirme') ✅ Confirmé
                                    @elseif($rdv->statut === 'annule') ❌ Annulé
                                    @else ⏳ En attente
                                    @endif
                                </span>
                            </div>
                        @empty
                            <div style="text-align:center;padding:40px;color:#6b7280">
                                <div style="font-size:40px;margin-bottom:12px">📅</div>
                                <p style="font-weight:600;margin-bottom:8px">Aucun rendez-vous</p>
                                <a href="{{ route('rendezvous.create') }}" style="color:#1a56db;font-weight:700;text-decoration:none">Prendre mon premier RDV →</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div style="display:flex;flex-direction:column;gap:20px">
                    <div class="card">
                        <div class="card-header"><span class="card-title">⚡ Actions rapides</span></div>
                        <div class="card-body">
                            <div class="quick-actions">
                                <a href="{{ route('rendezvous.create') }}" class="action-btn blue">
                                    <span class="action-icon">📅</span>Prendre RDV
                                </a>
                                <a href="{{ route('rendezvous.index') }}" class="action-btn green">
                                    <span class="action-icon">📋</span>Mes RDV
                                </a>
                                <a href="/medecins" class="action-btn orange">
                                    <span class="action-icon">👨‍⚕️</span>Médecins
                                </a>
                                <a href="{{ route('profile.edit') }}" class="action-btn purple">
                                    <span class="action-icon">👤</span>Profil
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header"><span class="card-title">💡 Conseils santé</span></div>
                        <div class="card-body">
                            <div style="display:flex;flex-direction:column;gap:12px">
                                <div style="display:flex;gap:10px;align-items:flex-start">
                                    <span style="font-size:20px">💧</span>
                                    <p style="font-size:13px;color:#6b7280;line-height:1.6">Buvez au moins 2 litres d'eau par jour pour rester hydraté.</p>
                                </div>
                                <div style="display:flex;gap:10px;align-items:flex-start">
                                    <span style="font-size:20px">🏃</span>
                                    <p style="font-size:13px;color:#6b7280;line-height:1.6">30 minutes de marche quotidienne réduisent les risques cardiaques.</p>
                                </div>
                                <div style="display:flex;gap:10px;align-items:flex-start">
                                    <span style="font-size:20px">😴</span>
                                    <p style="font-size:13px;color:#6b7280;line-height:1.6">Dormez 7 à 8 heures par nuit pour un système immunitaire fort.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- DASHBOARD MÉDECIN --}}
        @if (Auth::user()->isMedecin())
            <div class="stats-grid stats-grid-3" style="margin-bottom:28px">
                <div class="stat-card">
                    <div class="stat-icon blue">📅</div>
                    <div>
                        <div class="stat-value">{{ Auth::user()->rendezVousMedecin()->count() }}</div>
                        <div class="stat-label">Total rendez-vous</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon orange">⏳</div>
                    <div>
                        <div class="stat-value">{{ Auth::user()->rendezVousMedecin()->where('statut','en_attente')->count() }}</div>
                        <div class="stat-label">En attente</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">✅</div>
                    <div>
                        <div class="stat-value">{{ Auth::user()->rendezVousMedecin()->where('statut','confirme')->count() }}</div>
                        <div class="stat-label">Confirmés</div>
                    </div>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">📋 Mes patients du jour</span>
                        <a href="{{ route('rendezvous.index') }}" class="card-link">Voir tout →</a>
                    </div>
                    <div class="card-body">
                        @php $rdvs = Auth::user()->rendezVousMedecin()->with('patient')->where('statut','!=','annule')->orderBy('date')->take(5)->get(); @endphp
                        @forelse ($rdvs as $rdv)
                            <div class="rdv-item">
                                <div class="rdv-date">
                                    <div class="day">{{ \Carbon\Carbon::parse($rdv->date)->format('d') }}</div>
                                    <div class="month">{{ \Carbon\Carbon::parse($rdv->date)->locale('fr')->isoFormat('MMM') }}</div>
                                </div>
                                <div class="rdv-info">
                                    <div class="name">{{ $rdv->patient->name }}</div>
                                    <div class="time">🕐 {{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }} @if($rdv->motif) — {{ Str::limit($rdv->motif, 30) }} @endif</div>
                                </div>
                                <span class="rdv-badge {{ $rdv->statut }}">
                                    @if($rdv->statut === 'confirme') ✅ Confirmé
                                    @else ⏳ En attente
                                    @endif
                                </span>
                            </div>
                        @empty
                            <div style="text-align:center;padding:40px;color:#6b7280">
                                <div style="font-size:40px;margin-bottom:12px">📅</div>
                                <p style="font-weight:600">Aucun rendez-vous à venir</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div style="display:flex;flex-direction:column;gap:20px">
                    <div class="card">
                        <div class="card-header"><span class="card-title">⚡ Actions rapides</span></div>
                        <div class="card-body">
                            <div class="quick-actions">
                                <a href="{{ route('rendezvous.index') }}" class="action-btn blue">
                                    <span class="action-icon">📋</span>Mes RDV
                                </a>
                                <a href="{{ route('profile.edit') }}" class="action-btn purple">
                                    <span class="action-icon">👤</span>Profil
                                </a>
                                <a href="/medecins" class="action-btn orange">
                                    <span class="action-icon">👨‍⚕️</span>Équipe
                                </a>
                                <a href="/" class="action-btn green">
                                    <span class="action-icon">🏥</span>Accueil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- DASHBOARD ADMIN --}}
        @if (Auth::user()->isAdmin())
            @php
                $totalRdv = \App\Models\RendezVous::count();
                $enAttente = \App\Models\RendezVous::where('statut','en_attente')->count();
                $confirmes = \App\Models\RendezVous::where('statut','confirme')->count();
                $annules = \App\Models\RendezVous::where('statut','annule')->count();
                $totalPatients = \App\Models\User::where('role','patient')->count();
                $totalMedecins = \App\Models\User::where('role','medecin')->count();
            @endphp

            <div class="stats-grid stats-grid-5" style="margin-bottom:28px">
                <div class="stat-card">
                    <div class="stat-icon blue">📅</div>
                    <div>
                        <div class="stat-value">{{ $totalRdv }}</div>
                        <div class="stat-label">Total RDV</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon orange">⏳</div>
                    <div>
                        <div class="stat-value">{{ $enAttente }}</div>
                        <div class="stat-label">En attente</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">✅</div>
                    <div>
                        <div class="stat-value">{{ $confirmes }}</div>
                        <div class="stat-label">Confirmés</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon purple">👥</div>
                    <div>
                        <div class="stat-value">{{ $totalPatients }}</div>
                        <div class="stat-label">Patients</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon blue">👨‍⚕️</div>
                    <div>
                        <div class="stat-value">{{ $totalMedecins }}</div>
                        <div class="stat-label">Médecins</div>
                    </div>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">📋 Derniers rendez-vous</span>
                        <a href="{{ route('rendezvous.index') }}" class="card-link">Gérer →</a>
                    </div>
                    <div class="card-body" style="padding:0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Médecin</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Models\RendezVous::with(['patient','medecin'])->orderBy('created_at','desc')->take(6)->get() as $rdv)
                                <tr>
                                    <td style="font-weight:600">{{ $rdv->patient->name }}</td>
                                    <td style="color:#6b7280">Dr. {{ $rdv->medecin->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="rdv-badge {{ $rdv->statut }}">
                                            @if($rdv->statut === 'confirme') ✅ Confirmé
                                            @elseif($rdv->statut === 'annule') ❌ Annulé
                                            @else ⏳ En attente
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="display:flex;flex-direction:column;gap:20px">
                    <div class="card">
                        <div class="card-header"><span class="card-title">⚡ Actions rapides</span></div>
                        <div class="card-body">
                            <div class="quick-actions">
                                <a href="{{ route('admin.medecins.create') }}" class="action-btn blue">
                                    <span class="action-icon">➕</span>Ajouter médecin
                                </a>
                                <a href="{{ route('rendezvous.index') }}" class="action-btn green">
                                    <span class="action-icon">📋</span>Gérer RDV
                                </a>
                                <a href="{{ route('admin.medecins.index') }}" class="action-btn orange">
                                    <span class="action-icon">👨‍⚕️</span>Médecins
                                </a>
                                <a href="{{ route('profile.edit') }}" class="action-btn purple">
                                    <span class="action-icon">⚙️</span>Paramètres
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header"><span class="card-title">📊 Occupation</span></div>
                        <div class="card-body">
                            @php
                                $medecins = \App\Models\User::where('role','medecin')->take(4)->get();
                            @endphp
                            @foreach ($medecins as $med)
                                @php
                                    $total = $med->rendezVousMedecin()->count();
                                    $pct = $totalRdv > 0 ? min(100, round(($total / max(1,$totalRdv)) * 100)) : 0;
                                    $colors = ['#1a56db','#16a34a','#ea580c','#7c3aed'];
                                    $color = $colors[$loop->index % 4];
                                @endphp
                                <div class="occupation-item">
                                    <div class="occupation-header">
                                        <span>Dr. {{ $med->name }}</span>
                                        <span>{{ $total }} RDV</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width:{{ $pct }}%;background:{{ $color }}"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</x-app-layout>