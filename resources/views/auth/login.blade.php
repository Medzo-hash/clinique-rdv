<x-guest-layout>
    <div class="min-h-screen flex flex-col md:flex-row bg-gray-50">
        
        {{-- Section Gauche : Statistique --}}
        <div class="w-full md:w-5/12 bg-gradient-to-br from-blue-700 to-indigo-900 p-10 flex flex-col justify-between text-white relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex items-center space-x-3 mb-8">
                    <x-application-logo class="w-10 h-10 fill-current text-white" />
                    <span class="text-2xl font-black tracking-wider">CliniqPlus</span>
                </div>
                <h1 class="text-3xl font-extrabold mb-4 leading-tight">Bon retour sur CliniqPlus !</h1>
                <p class="text-blue-100 text-sm leading-relaxed max-w-md">
                    Connectez-vous pour gérer vos rendez-vous médicaux et accéder à votre espace personnel.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 my-8 relative z-10">
                <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 border border-white/10">
                    <div class="text-2xl font-black">1+</div>
                    <div class="text-xs text-blue-200 mt-1">Médecins</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 border border-white/10">
                    <div class="text-2xl font-black">0+</div>
                    <div class="text-xs text-blue-200 mt-1">Patients</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 border border-white/10">
                    <div class="text-2xl font-black">0+</div>
                    <div class="text-xs text-blue-200 mt-1">RDV pris</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 border border-white/10">
                    <div class="text-2xl font-black">24/7</div>
                    <div class="text-xs text-blue-200 mt-1">Disponible</div>
                </div>
            </div>

            <div class="text-xs text-blue-300 relative z-10">
                &copy; 2026 CliniqPlus &mdash; Dakar, Sénégal
            </div>
        </div>

        {{-- Section Droite : Formulaire --}}
        <div class="w-full md:w-7/12 flex items-center justify-center p-8 md:p-16 bg-white">
            <div class="w-full max-w-md space-y-6">
                <div>
                    <div class="flex items-center space-x-2 text-gray-900">
                        <span class="text-2xl">🔐</span>
                        <h2 class="text-2xl font-black tracking-tight">Connexion</h2>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                        Entrez vos identifiants pour accéder à votre espace
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Adresse email</label>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe</label>
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between text-sm">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                            <span class="ms-2 text-gray-600">Se souvenir de moi</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="font-semibold text-blue-600 hover:text-blue-500 transition duration-150" href="{{ route('password.request') }}">
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                            👤 Se connecter
                        </button>
                    </div>
                </form>

                <div class="text-center pt-4 border-t border-gray-100">
                    <p class="text-sm text-gray-600">
                        Pas encore de compte ? 
                        <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-500 transition duration-150">
                            S'inscrire gratuitement
                        </a>
                    </p>
                </div>
            </div>
        </div>

    </div>
</x-guest-layout>
