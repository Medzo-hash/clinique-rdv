<x-app-layout>
    <style>
        .rdv-page { max-width: 1100px; margin: 0 auto; padding: 40px 24px; }

        /* HEADER */
        .page-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 28px;
        }
        .page-header-left h1 { font-size: 24px; font-weight: 800; color: #0f172a; }
        .page-header-left p { font-size: 14px; color: #6b7280; margin-top: 4px; }
        .btn-new-rdv {
            background: #1a56db; color: white; padding: 12px 22px;
            border-radius: 10px; font-weight: 700; font-size: 14px;
            text-decoration: none; transition: all 0.2s; display: flex;
            align-items: center; gap: 8px;
        }
        .btn-new-rdv:hover { background: #1e3a8a; transform: translateY(-1px); }

        /* STATS */
        .stats-row {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 16px; margin-bottom: 28px;
        }
        .stat-mini {
            background: white; border-radius: 12px; padding: 18px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;
            display: flex; align-items: center; gap: 14px;
        }
        .stat-mini-icon {
            width: 44px; height: 44px; border-radius: 11px;
            display: flex; align-items: center; justify-content: center; font-size: 20px;
        }
        .stat-mini-icon.blue { background: #eff6ff; }
        .stat-mini-icon.yellow { background: #fef3c7; }
        .stat-mini-icon.green { background: #dcfce7; }
        .stat-mini-icon.red { background: #fee2e2; }
        .stat-mini-value { font-size: 22px; font-weight: 900; color: #0f172a; line-height: 1; }
        .stat-mini-label { font-size: 12px; color: #6b7280; margin-top: 3px; font-weight: 500; }

        /* FILTERS */
        .filters-bar {
            background: white; border-radius: 12px; padding: 16px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;
            display: flex; gap: 10px; align-items: center; margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .filter-tab {
            padding: 7px 16px; border-radius: 20px; font-size: 13px;
            font-weight: 600; cursor: pointer; border: 1.5px solid #e2e8f0;
            background: white; color: #6b7280; transition: all 0.2s;
        }
        .filter-tab:hover, .filter-tab.active {
            background: #1a56db; color: white; border-color: #1a56db;
        }

        /* TABLE CARD */
        .table-card {
            background: white; border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid #f1f5f9;
            overflow: hidden;
        }
        .table-card-header {
            padding: 18px 24px; border-bottom: 1px solid #f8fafc;
            display: flex; justify-content: space-between; align-items: center;
        }
        .table-card-title { font-size: 15px; font-weight: 700; color: #0f172a; }

        /* TABLE */
        .rdv-table { width: 100%; border-collapse: collapse; }
        .rdv-table th {
            padding: 12px 20px; text-align: left; font-size: 11px;
            text-transform: uppercase; letter-spacing: 0.5px;
            color: #6b7280; border-bottom: 1px solid #f1f5f9; font-weight: 700;
            background: #fafafa;
        }
        .rdv-table td {
            padding: 16px 20px; font-size: 14px;
            border-bottom: 1px solid #f8fafc; vertical-align: middle;
        }
        .rdv-table tr:last-child td { border-bottom: none; }
        .rdv-table tr:hover td { background: #fafafa; }

        /* DATE CELL */
        .date-cell { display: flex; align-items: center; gap: 12px; }
        .date-box {
            min-width: 46px; padding: 6px 8px; text-align: center;
            background: #1a56db; border-radius: 8px;
        }
        .date-box .day { font-size: 16px; font-weight: 900; color: white; line-height: 1; }
        .date-box .month { font-size: 9px; color: rgba(255,255,255,0.8); font-weight: 600; text-transform: uppercase; }
        .date-info .time { font-size: 13px; font-weight: 700; color: #0f172a; }
        .date-info .weekday { font-size: 11px; color: #6b7280; }

        /* PERSON CELL */
        .person-cell { display: flex; align-items: center; gap: 10px; }
        .person-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: #1a56db; color: white;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; flex-shrink: 0;
        }
        .person-name { font-size: 14px; font-weight: 600; color: #0f172a; }
        .person-spec { font-size: 12px; color: #6b7280; }

        /* BADGE */
        .badge {
            padding: 5px 12px; border-radius: 20px;
            font-size: 12px; font-weight: 700; display: inline-flex;
            align-items: center; gap: 5px;
        }
        .badge-confirme { background: #dcfce7; color: #15803d; }
        .badge-en_attente { background: #fef3c7; color: #b45309; }
        .badge-annule { background: #fee2e2; color: #b91c1c; }

        /* ACTIONS */
        .actions-cell { display: flex; gap: 8px; align-items: center; }
        .btn-action {
            padding: 7px 14px; border-radius: 8px; font-size: 12px;
            font-weight: 700; border: none; cursor: pointer;
            transition: all 0.2s; text-decoration: none; display: inline-block;
        }
        .btn-confirm { background: #dcfce7; color: #15803d; }
        .btn-confirm:hover { background: #16a34a; color: white; }
        .btn-cancel-rdv { background: #fee2e2; color: #b91c1c; }
        .btn-cancel-rdv:hover { background: #dc2626; color: white; }

        /* EMPTY */
        .empty-state {
            text-align: center; padding: 60px 20px; color: #6b7280;
        }
        .empty-state .icon { font-size: 48px; margin-bottom: 16px; }
        .empty-state h3 { font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
        .empty-state p { font-size: 14px; margin-bottom: 20px; }
        .btn-empty {
            background: #1a56db; color: white; padding: 11px 24px;
            border-radius: 10px; font-weight: 700; font-size: 14px;
            text-decoration: none; display: inline-block;
        }

        /* SUCCESS */
        .alert-success {
            background: #f0fdf4; border: 1px solid #bbf7d0;
            border-radius: 10px; padding: 14px 18px; margin-bottom: 20px;
            color: #15803d; font-size: 14px; font-weight: 600;
            display: flex; align-items: center; gap: 10px;
        }

        @media (max-width: 768px) {
            .stats-row { grid-template-columns: repeat(2, 1fr); }
            .page-header { flex-direction: column; gap: 16px; align-items: flex-start; }
            .rdv-table { font-size: 13px; }
        }
    </style>

    <div class="rdv-page">

        {{-- HEADER --}}
        <div class="page-header">
            <div class="page-header-left">
                <h1>📋 Mes rendez-vous</h1>
                <p>
                    @if (Auth::user()->isAdmin()) Gestion de tous les rendez-vous
                    @elseif (Auth::user()->isMedecin()) Vos consultations à venir
                    @else Suivi de vos rendez-vous médicaux
                    @endif
                </p>
            </div>
            @if (Auth::user()->isPatient())
                <a href="{{ route('rendezvous.create') }}" class="btn-new-rdv">
                    + Nouveau rendez-vous
                </a>
            @endif
        </div>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- STATS --}}
        <div class="stats-row">
            <div class="stat-mini">
                <div class="stat-mini-icon blue">📅</div>
                <div>
                    <div class="stat-mini-value">{{ $rendezVous->count() }}</div>
                    <div class="stat-mini-label">Total</div>
                </div>
            </div>
            <div class="stat-mini">
                <div class="stat-mini-icon yellow">⏳</div>
                <div>
                    <div class="stat-mini-value">{{ $rendezVous->where('statut','en_attente')->count() }}</div>
                    <div class="stat-mini-label">En attente</div>
                </div>
            </div>
            <div class="stat-mini">
                <div class="stat-mini-icon green">✅</div>
                <div>
                    <div class="stat-mini-value">{{ $rendezVous->where('statut','confirme')->count() }}</div>
                    <div class="stat-mini-label">Confirmés</div>
                </div>
            </div>
            <div class="stat-mini">
                <div class="stat-mini-icon red">❌</div>
                <div>
                    <div class="stat-mini-value">{{ $rendezVous->where('statut','annule')->count() }}</div>
                    <div class="stat-mini-label">Annulés</div>
                </div>
            </div>
        </div>

        {{-- FILTERS --}}
        <div class="filters-bar">
            <span style="font-size:13px;font-weight:600;color:#374151">Filtrer :</span>
            <div class="filter-tab active">Tous</div>
            <div class="filter-tab">En attente</div>
            <div class="filter-tab">Confirmés</div>
            <div class="filter-tab">Annulés</div>
        </div>

        {{-- TABLE --}}
        <div class="table-card">
            <div class="table-card-header">
                <span class="table-card-title">Liste des rendez-vous</span>
                <span style="font-size:13px;color:#6b7280">{{ $rendezVous->count() }} rendez-vous</span>
            </div>

            @if ($rendezVous->isEmpty())
                <div class="empty-state">
                    <div class="icon">📅</div>
                    <h3>Aucun rendez-vous</h3>
                    <p>Vous n'avez pas encore de rendez-vous enregistré.</p>
                    @if (Auth::user()->isPatient())
                        <a href="{{ route('rendezvous.create') }}" class="btn-empty">
                            + Prendre mon premier RDV
                        </a>
                    @endif
                </div>
            @else
                <table class="rdv-table">
                    <thead>
                        <tr>
                            <th>Date & Heure</th>
                            @if (Auth::user()->isAdmin())
                                <th>Patient</th>
                            @endif
                            @if (Auth::user()->isAdmin() || Auth::user()->isPatient())
                                <th>Médecin</th>
                            @endif
                            @if (Auth::user()->isMedecin())
                                <th>Patient</th>
                            @endif
                            <th>Motif</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rendezVous as $rdv)
                        <tr>
                            <td>
                                <div class="date-cell">
                                    <div class="date-box">
                                        <div class="day">{{ \Carbon\Carbon::parse($rdv->date)->format('d') }}</div>
                                        <div class="month">{{ \Carbon\Carbon::parse($rdv->date)->locale('fr')->isoFormat('MMM') }}</div>
                                    </div>
                                    <div class="date-info">
                                        <div class="time">{{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }}</div>
                                        <div class="weekday">{{ \Carbon\Carbon::parse($rdv->date)->locale('fr')->isoFormat('dddd') }}</div>
                                    </div>
                                </div>
                            </td>

                            @if (Auth::user()->isAdmin())
                                <td>
                                    <div class="person-cell">
                                        <div class="person-avatar">{{ strtoupper(substr($rdv->patient->name, 0, 2)) }}</div>
                                        <div>
                                            <div class="person-name">{{ $rdv->patient->name }}</div>
                                        </div>
                                    </div>
                                </td>
                            @endif

                            @if (Auth::user()->isAdmin() || Auth::user()->isPatient())
                                <td>
                                    <div class="person-cell">
                                        <div class="person-avatar">{{ strtoupper(substr($rdv->medecin->name, 0, 2)) }}</div>
                                        <div>
                                            <div class="person-name">Dr. {{ $rdv->medecin->name }}</div>
                                            <div class="person-spec">{{ $rdv->medecin->specialite ?? 'Généraliste' }}</div>
                                        </div>
                                    </div>
                                </td>
                            @endif

                            @if (Auth::user()->isMedecin())
                                <td>
                                    <div class="person-cell">
                                        <div class="person-avatar">{{ strtoupper(substr($rdv->patient->name, 0, 2)) }}</div>
                                        <div>
                                            <div class="person-name">{{ $rdv->patient->name }}</div>
                                        </div>
                                    </div>
                                </td>
                            @endif

                            <td style="color:#6b7280;font-size:13px">
                                {{ $rdv->motif ? \Illuminate\Support\Str::limit($rdv->motif, 30) : '—' }}
                            </td>

                            <td>
                                <span class="badge badge-{{ $rdv->statut }}">
                                    @if($rdv->statut === 'confirme') ✅ Confirmé
                                    @elseif($rdv->statut === 'annule') ❌ Annulé
                                    @else ⏳ En attente
                                    @endif
                                </span>
                            </td>

                            <td>
                                <div class="actions-cell">
                                    @if ($rdv->statut === 'en_attente' && (Auth::user()->isAdmin() || Auth::user()->isMedecin()))
                                        <form action="{{ route('rendezvous.confirmer', $rdv) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn-action btn-confirm">✅ Confirmer</button>
                                        </form>
                                    @endif
                                    @if ($rdv->statut !== 'annule')
                                        <form action="{{ route('rendezvous.annuler', $rdv) }}" method="POST"
                                              onsubmit="return confirm('Annuler ce rendez-vous ?')">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn-action btn-cancel-rdv">❌ Annuler</button>
                                        </form>
                                    @endif
                                    @if ($rdv->statut === 'annule')
                                        <span style="color:#94a3b8;font-size:13px">—</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>