<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Prendre un rendez-vous
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('rendezvous.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="medecin_id" class="block text-sm font-medium text-gray-700">Médecin</label>
                        <select id="medecin_id" name="medecin_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">— Choisir un médecin —</option>
                            @foreach ($medecins as $medecin)
                                <option value="{{ $medecin->id }}">
                                    {{ $medecin->name }} @if($medecin->specialite) — {{ $medecin->specialite }} @endif
                                </option>
                            @endforeach
                        </select>
                        @error('medecin_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" id="date" name="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required min="{{ date('Y-m-d') }}">
                        @error('date') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="heure" class="block text-sm font-medium text-gray-700">Heure</label>
                        <input type="time" id="heure" name="heure" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @error('heure') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="motif" class="block text-sm font-medium text-gray-700">Motif (optionnel)</label>
                        <textarea id="motif" name="motif" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        @error('motif') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3 mt-6 pb-6">
                        <a href="{{ route('rendezvous.index') }}"
                           style="padding: 10px 20px; border: 1px solid #d1d5db; color: #4b5563; border-radius: 6px; text-decoration: none;">
                            Annuler
                        </a>
                        <button type="submit"
                                style="background-color: #2563eb; color: white; padding: 10px 24px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer;">
                            Confirmer le rendez-vous
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>