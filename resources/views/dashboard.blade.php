<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- MESSAGE DE BIENVENUE --}}
            <div style="background-color: #eff6ff; border-left: 4px solid #2563eb; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                <p style="font-size: 18px; font-weight: 600; color: #1e40af;">
                    Bonjour, {{ Auth::user()->name }} 👋
                </p>
                <p style="color: #3b82f6; font-size: 14px; margin-top: 4px;">
                    @if (Auth::user()->isAdmin())
                        Vous êtes connecté en tant qu'Administrateur
                    @elseif (Auth::user()->isMedecin())
                        Vous êtes connecté en tant que Médecin — {{ Auth::user()->specialite }}
                    @else
                        Vous êtes connecté en tant que Patient
                    @endif
                </p>
            </div>

            {{-- DASHBOARD PATIENT --}}
            @if (Auth::user()->isPatient())
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;">
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 1px 6px rgba(0,0,0,0.08); border-top: 4px solid #2563eb;">
                        <p style="font-size: 13px; color: #6b7280; text-transform: uppercase; font-weight: 600;">Total RDV</p>
                        <p style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ Auth::user()->rendezVousPatient()->count() }}</p>
                    </div>
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 1px 6px rgba(0,0,0,0.08); border-top: 4px solid #16a34a;">
                        <p style="font-size: 13px; color: #6b7280; text-transform: uppercase; font-weight: 600;">Confirmés</p>
                        <p style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ Auth::user()->rendezVousPatient()->where('statut', 'confirme')->count() }}</p>
                    </div>
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 1px 6px rgba(0,0,0,0.08); border-top: 4px solid #f59e0b;">
                        <p style="font-size: 13px; color: #6b7280; text-transform: uppercase; font-weight: 600;">En attente</p>
                        <p style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ Auth::user()->rendezVousPatient()->where('statut', 'en_attente')->count() }}</p>
                    </div>
                </div>

                <div style="background: white; border-radius: 10px; padding: 24px; box-shadow: 0 1px 6px rgba(0,0,0,0.08);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <h3 style="font-size: 16px; font-weight: 700;">Mes prochains rendez-vous</h3>
                        <a href="{{ route('rendezvous.create') }}"
                           style="background-color: #2563eb; color: white; padding: 8px 16px; border-radius: 6px; font-size: 14px; font-weight: 600; text-decoration: none;">
                            + Prendre un RDV
                        </a>
                    </div>
                    @php $rdvs = Auth::user()->rendezVousPatient()->with('medecin')->where('statut', '!=', 'annule')->orderBy('date')->take(5)->get(); @endphp
                    @forelse ($rdvs as $rdv)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: #f8fafc; border-radius: 8px; margin-bottom: 8px;">
                            <div>
                                <p style="font-weight: 600; font-size: 14px;">{{ $rdv->medecin->name }} @if($rdv->medecin->specialite) — {{ $rdv->medecin->specialite }} @endif</p>
                                <p style="font-size: 13px; color: #6b7280;">{{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }}</p>
                            </div>
                            @if ($rdv->statut === 'confirme')
                                <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">Confirmé</span>
                            @else
                                <span style="background: #fef3c7; color: #b45309; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">En attente</span>
                            @endif
                        </div>
                    @empty
                        <p style="color: #6b7280; text-align: center; padding: 20px;">Aucun rendez-vous à venir.</p>
                    @endforelse
                    <a href="{{ route('rendezvous.index') }}" style="display: block; text-align: center; color: #2563eb; font-size: 14px; margin-top: 12px;">
                        Voir tous mes rendez-vous →
                    </a>
                </div>
            @endif

            {{-- DASHBOARD MÉDECIN --}}
            @if (Auth::user()->isMedecin())
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;">
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 1px 6px rgba(0,0,0,0.08); border-top: 4px solid #2563eb;">
                        <p style="font-size: 13px; color: #6b7280; text-transform: uppercase; font-weight: 600;">Total RDV</p>
                        <p style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ Auth::user()->rendezVousMedecin()->count() }}</p>
                    </div>
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 1px 6px rgba(0,0,0,0.08); border-top: 4px solid #f59e0b;">
                        <p style="font-size: 13px; color: #6b7280; text-transform: uppercase; font-weight: 600;">En attente</p>
                        <p style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ Auth::user()->rendezVousMedecin()->where('statut', 'en_attente')->count() }}</p>
                    </div>
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 1px 6px rgba(0,0,0,0.08); border-top: 4px solid #16a34a;">
                        <p style="font-size: 13px; color: #6b7280; text-transform: uppercase; font-weight: 600;">Confirmés</p>
                        <p style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ Auth::user()->rendezVousMedecin()->where('statut', 'confirme')->count() }}</p>
                    </div>
                </div>

                <div style="background: white; border-radius: 10px; padding: 24px; box-shadow: 0 1px 6px rgba(0,0,0,0.08);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <h3 style="font-size: 16px; font-weight: 700;">Mes prochains rendez-vous</h3>
                        <a href="{{ route('rendezvous.index') }}"
                           style="background-color: #2563eb; color: white; padding: 8px 16px; border-radius: 6px; font-size: 14px; font-weight: 600; text-decoration: none;">
                            Voir tout
                        </a>
                    </div>
                    @php $rdvs = Auth::user()->rendezVousMedecin()->with('patient')->where('statut', '!=', 'annule')->orderBy('date')->take(5)->get(); @endphp
                    @forelse ($rdvs as $rdv)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: #f8fafc; border-radius: 8px; margin-bottom: 8px;">
                            <div>
                                <p style="font-weight: 600; font-size: 14px;">{{ $rdv->patient->name }}</p>
                                <p style="font-size: 13px; color: #6b7280;">{{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }} @if($rdv->motif) — {{ $rdv->motif }} @endif</p>
                            </div>
                            @if ($rdv->statut === 'confirme')
                                <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">Confirmé</span>
                            @else
                                <span style="background: #fef3c7; color: #b45309; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">En attente</span>
                            @endif
                        </div>
                    @empty
                        <p style="color: #6b7280; text-align: center; padding: 20px;">Aucun rendez-vous à venir.</p>
                    @endforelse
                </div>
            @endif

            {{-- DASHBOARD ADMIN --}}
            @if (Auth::user()->isAdmin())
                @php
                    $totalRdv = \App\Models\RendezVous::count();
                    $enAttente = \App\Models\RendezVous::where('statut', 'en_attente')->count();
                    $confirmes = \App\Models\RendezVous::where('statut', 'confirme')->count();
                    $totalPatients = \App\Models\User::where('role', 'patient')->count();
                    $totalMedecins = \App\Models\User::where('role', 'medecin')->count();
                @endphp

                <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; margin-bottom: 24px;">
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 1px 6px rgba(0,0,0,0.08); border-top: 4px solid #2563eb;">
                        <p style="font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: 600;">Total RDV</p>
                        <p style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ $totalRdv }}</p>
                    </div>
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 1px 6px rgba(0,0,0,0.08); border-top: 4px solid #f59e0b;">
                        <p style="font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: 600;">En attente</p>
                        <p style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ $enAttente }}</p>
                    </div>
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 1px 6px rgba(0,0,0,0.08); border-top: 4px solid #16a34a;">
                        <p style="font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: 600;">Confirmés</p>
                        <p style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ $confirmes }}</p>
                    </div>
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 1px 6px rgba(0,0,0,0.08); border-top: 4px solid #8b5cf6;">
                        <p style="font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: 600;">Patients</p>
                        <p style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ $totalPatients }}</p>
                    </div>
                    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 1px 6px rgba(0,0,0,0.08); border-top: 4px solid #0891b2;">
                        <p style="font-size: 12px; color: #6b7280; text-transform: uppercase; font-weight: 600;">Médecins</p>
                        <p style="font-size: 32px; font-weight: 800; color: #1e293b;">{{ $totalMedecins }}</p>
                    </div>
                </div>

                <div style="background: white; border-radius: 10px; padding: 24px; box-shadow: 0 1px 6px rgba(0,0,0,0.08);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <h3 style="font-size: 16px; font-weight: 700;">Derniers rendez-vous</h3>
                        <a href="{{ route('rendezvous.index') }}"
                           style="background-color: #2563eb; color: white; padding: 8px 16px; border-radius: 6px; font-size: 14px; font-weight: 600; text-decoration: none;">
                            Gérer tous les RDV
                        </a>
                    </div>
                    @php $rdvs = \App\Models\RendezVous::with(['patient', 'medecin'])->orderBy('created_at', 'desc')->take(5)->get(); @endphp
                    @forelse ($rdvs as $rdv)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: #f8fafc; border-radius: 8px; margin-bottom: 8px;">
                            <div>
                                <p style="font-weight: 600; font-size: 14px;">{{ $rdv->patient->name }} → {{ $rdv->medecin->name }}</p>
                                <p style="font-size: 13px; color: #6b7280;">{{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }}</p>
                            </div>
                            @if ($rdv->statut === 'confirme')
                                <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">Confirmé</span>
                            @elseif ($rdv->statut === 'annule')
                                <span style="background: #fee2e2; color: #b91c1c; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">Annulé</span>
                            @else
                                <span style="background: #fef3c7; color: #b45309; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">En attente</span>
                            @endif
                        </div>
                    @empty
                        <p style="color: #6b7280; text-align: center; padding: 20px;">Aucun rendez-vous.</p>
                    @endforelse
                </div>
            @endif

        </div>
    </div>
</x-app-layout>