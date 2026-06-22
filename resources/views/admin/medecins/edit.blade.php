<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier le médecin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.medecins.update', $medecin) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                        <input type="text" name="name" value="{{ old('name', $medecin->name) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                        <input type="text" name="telephone" value="{{ old('telephone', $medecin->telephone) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('telephone') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Spécialité</label>
                        <input type="text" name="specialite" value="{{ old('specialite', $medecin->specialite) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('specialite') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div style="display:flex; justify-content:flex-end; gap:12px;">
                        <a href="{{ route('admin.medecins.index') }}"
                           style="padding:10px 20px; border:1px solid #d1d5db; color:#4b5563; border-radius:6px; text-decoration:none;">
                            Annuler
                        </a>
                        <button type="submit"
                                style="background:#2563eb; color:white; padding:10px 24px; border-radius:6px; font-weight:600; border:none; cursor:pointer;">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>