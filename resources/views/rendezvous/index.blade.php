<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes rendez-vous
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (Auth::user()->isPatient())
                    <a href="{{ route('rendezvous.create') }}" class="inline-block mb-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        + Prendre un rendez-vous
                    </a>
                @endif

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Heure</th>
                            @if (Auth::user()->isAdmin())
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Patient</th>
                            @endif
                            @if (Auth::user()->isAdmin() || Auth::user()->isPatient())
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Médecin</th>
                            @endif
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($rendezVous as $rdv)
                            <tr>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }}</td>
                                @if (Auth::user()->isAdmin())
                                    <td class="px-4 py-3">{{ $rdv->patient->name }}</td>
                                @endif
                                @if (Auth::user()->isAdmin() || Auth::user()->isPatient())
                                    <td class="px-4 py-3">{{ $rdv->medecin->name }}</td>
                                @endif
                                <td class="px-4 py-3">
                                    @if ($rdv->statut === 'confirme')
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Confirmé</span>
                                    @elseif ($rdv->statut === 'annule')
                                        <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Annulé</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">En attente</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 space-x-2">
                                    @if ($rdv->statut === 'en_attente' && (Auth::user()->isAdmin() || Auth::user()->isMedecin()))
                                        <form action="{{ route('rendezvous.confirmer', $rdv) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-600 hover:underline text-sm">Confirmer</button>
                                        </form>
                                    @endif
                                    @if ($rdv->statut !== 'annule')
                                        <form action="{{ route('rendezvous.annuler', $rdv) }}" method="POST" class="inline" onsubmit="return confirm('Annuler ce rendez-vous ?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">Annuler</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">Aucun rendez-vous pour le moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>