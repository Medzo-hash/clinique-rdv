<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des médecins
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div style="background:#dcfce7; color:#15803d; padding:14px 20px; border-radius:8px; margin-bottom:20px; font-weight:600;">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                    <h3 style="font-size:18px; font-weight:700;">Liste des médecins ({{ $medecins->count() }})</h3>
                    <a href="{{ route('admin.medecins.create') }}"
                       style="background:#2563eb; color:white; padding:10px 20px; border-radius:8px; font-weight:600; text-decoration:none; font-size:14px;">
                        + Ajouter un médecin
                    </a>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Téléphone</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Spécialité</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($medecins as $medecin)
                            <tr>
                                <td class="px-4 py-3 font-semibold">Dr. {{ $medecin->name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $medecin->email }}</td>
                                <td class="px-4 py-3">{{ $medecin->telephone }}</td>
                                <td class="px-4 py-3">
                                    <span style="background:#eff6ff; color:#2563eb; padding:4px 10px; border-radius:20px; font-size:12px; font-weight:600;">
                                        {{ $medecin->specialite }}
                                    </span>
                                </td>
                                <td class="px-4 py-3" style="display:flex; gap:8px;">
                                    <a href="{{ route('admin.medecins.edit', $medecin) }}"
                                       style="background:#f59e0b; color:white; padding:6px 14px; border-radius:6px; font-size:13px; font-weight:600; text-decoration:none;">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.medecins.destroy', $medecin) }}" method="POST"
                                          onsubmit="return confirm('Supprimer ce médecin ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                style="background:#dc2626; color:white; padding:6px 14px; border-radius:6px; font-size:13px; font-weight:600; border:none; cursor:pointer;">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                    Aucun médecin enregistré.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>