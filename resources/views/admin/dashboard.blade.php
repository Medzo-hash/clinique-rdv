<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panneau d\'Administration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Bannière Admin -->
            <div class="bg-gradient-to-r from-red-600 to-rose-700 text-white rounded-2xl p-8 shadow-lg relative overflow-hidden flex justify-between items-center mb-8">
                <div>
                    <div class="flex items-center space-x-2 text-2xl font-bold mb-2">
                        <span>👑</span>
                        <h3>Bonjour, {{ auth()->user()->name }} !</h3>
                    </div>
                    <p class="text-red-100 text-lg">Bienvenue sur votre espace d'administration CliniqPlus</p>
                </div>
                
                <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 text-center border border-white/20 hidden md:block">
                    <p class="text-xs uppercase tracking-wider text-red-200 mb-1">Mode Administrateur</p>
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Actif</span>
                </div>
            </div>

            <!-- Grille d'actions rapides -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Carte Gestion Médecins -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 mb-4 text-xl">🩺</div>
                        <h4 class="font-bold text-lg text-gray-800 mb-1">Gestion des Médecins</h4>
                        <p class="text-gray-500 text-sm">Ajoutez, modifiez ou supprimez les comptes des praticiens de la clinique.</p>
                    </div>
                    <a href="{{ route('admin.medecins.index') }}" class="mt-6 inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150">
                        Ouvrir le module
                    </a>
                </div>

                <!-- Carte Statistique Globale -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 mb-4 text-xl">📅</div>
                    <h4 class="font-bold text-lg text-gray-800 mb-1">Rendez-vous Globaux</h4>
                    <p class="text-gray-500 text-sm mb-4">Supervisez l'ensemble de l'activité médicale de la plateforme.</p>
                    <span class="text-3xl font-black text-gray-900">Suivi actif</span>
                </div>

                <!-- Carte Sécurité/Logs -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center text-amber-600 mb-4 text-xl">⚙️</div>
                    <h4 class="font-bold text-lg text-gray-800 mb-1">Configuration Système</h4>
                    <p class="text-gray-500 text-sm">Accédez aux paramètres globaux de l'application CliniqPlus.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
