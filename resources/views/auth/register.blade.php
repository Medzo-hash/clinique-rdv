<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire — CliniqPlus</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --blue: #1a56db;
            --blue-dark: #1e3a8a;
            --blue-light: #eff6ff;
        }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */
        .navbar {
            background: white; border-bottom: 1px solid #f1f5f9;
            padding: 0 40px; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 1px 12px rgba(0,0,0,0.06);
        }
        .navbar-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .logo-icon {
            width: 38px; height: 38px; background: var(--blue);
            border-radius: 9px; display: flex; align-items: center;
            justify-content: center; font-size: 18px;
        }
        .logo-text { font-size: 18px; font-weight: 800; color: var(--blue-dark); }
        .logo-text span { color: var(--blue); }
        .navbar-link {
            font-size: 14px; color: #6b7280; text-decoration: none;
            font-weight: 500; padding: 8px 16px; border-radius: 8px;
            transition: all 0.2s;
        }
        .navbar-link:hover { background: var(--blue-light); color: var(--blue); }

        /* MAIN LAYOUT */
        .auth-container {
            flex: 1; display: flex; align-items: center; justify-content: center;
            padding: 40px 20px;
        }
        .auth-wrapper {
            display: grid; grid-template-columns: 1fr 1fr;
            max-width: 960px; width: 100%;
            background: white; border-radius: 20px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.1); overflow: hidden;
        }

        /* LEFT PANEL */
        .auth-left {
            background: linear-gradient(135deg, var(--blue-dark), var(--blue));
            padding: 48px 40px; display: flex; flex-direction: column;
            justify-content: space-between; position: relative; overflow: hidden;
        }
        .auth-left::before {
            content: ''; position: absolute; width: 300px; height: 300px;
            border-radius: 50%; background: rgba(255,255,255,0.07);
            top: -100px; right: -80px;
        }
        .auth-left::after {
            content: ''; position: absolute; width: 200px; height: 200px;
            border-radius: 50%; background: rgba(255,255,255,0.07);
            bottom: -60px; left: -60px;
        }
        .auth-left-content { position: relative; z-index: 1; }
        .auth-left h2 {
            font-size: 28px; font-weight: 800; color: white;
            line-height: 1.3; margin-bottom: 16px;
        }
        .auth-left p { font-size: 15px; color: rgba(255,255,255,0.85); line-height: 1.7; }
        .auth-features { margin-top: 32px; display: flex; flex-direction: column; gap: 16px; }
        .auth-feature {
            display: flex; align-items: center; gap: 12px;
            color: rgba(255,255,255,0.9); font-size: 14px;
        }
        .auth-feature-icon {
            width: 36px; height: 36px; border-radius: 9px;
            background: rgba(255,255,255,0.15); display: flex;
            align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0;
        }
        .auth-left-footer {
            position: relative; z-index: 1;
            font-size: 13px; color: rgba(255,255,255,0.6);
        }

        /* RIGHT PANEL */
        .auth-right { padding: 48px 40px; }
        .auth-right h1 {
            font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 6px;
        }
        .auth-right p { font-size: 14px; color: #6b7280; margin-bottom: 28px; }

        /* FORM */
        .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { margin-bottom: 18px; }
        .form-group.full { grid-column: 1 / -1; }
        .form-label {
            display: block; font-size: 13px; font-weight: 600;
            color: #374151; margin-bottom: 6px;
        }
        .form-input {
            width: 100%; padding: 11px 14px;
            border: 1.5px solid #e2e8f0; border-radius: 10px;
            font-size: 14px; outline: none; transition: all 0.2s;
            font-family: 'Segoe UI', sans-serif; color: #0f172a;
        }
        .form-input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(26,86,219,0.1);
        }
        select.form-input { cursor: pointer; }
        .form-error { font-size: 12px; color: #dc2626; margin-top: 4px; }

        /* ROLE SELECTOR */
        .role-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .role-option {
            border: 2px solid #e2e8f0; border-radius: 10px; padding: 14px;
            cursor: pointer; transition: all 0.2s; text-align: center;
            position: relative;
        }
        .role-option:hover { border-color: var(--blue); background: var(--blue-light); }
        .role-option.selected { border-color: var(--blue); background: var(--blue-light); }
        .role-option input { position: absolute; opacity: 0; width: 0; height: 0; }
        .role-icon { font-size: 24px; margin-bottom: 6px; }
        .role-name { font-size: 13px; font-weight: 700; color: #0f172a; }
        .role-desc { font-size: 11px; color: #6b7280; margin-top: 2px; }
        .role-check {
            position: absolute; top: 8px; right: 8px;
            width: 18px; height: 18px; border-radius: 50%;
            background: var(--blue); color: white; font-size: 10px;
            display: none; align-items: center; justify-content: center;
        }
        .role-option.selected .role-check { display: flex; }

        /* SPECIALITE */
        #specialite-wrapper { display: none; margin-bottom: 18px; }

        /* SUBMIT */
        .btn-submit {
            width: 100%; padding: 13px; background: var(--blue);
            color: white; border: none; border-radius: 10px;
            font-size: 15px; font-weight: 700; cursor: pointer;
            transition: all 0.2s; font-family: 'Segoe UI', sans-serif;
            margin-top: 8px;
        }
        .btn-submit:hover { background: var(--blue-dark); transform: translateY(-1px); }

        .auth-footer {
            text-align: center; margin-top: 20px;
            font-size: 14px; color: #6b7280;
        }
        .auth-footer a { color: var(--blue); font-weight: 600; text-decoration: none; }

        @media (max-width: 768px) {
            .auth-wrapper { grid-template-columns: 1fr; }
            .auth-left { display: none; }
            .form-grid-2 { grid-template-columns: 1fr; }
            .navbar { padding: 0 20px; }
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
    <a href="/" class="navbar-logo">
        <div class="logo-icon">🏥</div>
        <div class="logo-text">Cliniq<span>Plus</span></div>
    </a>
    <a href="{{ route('login') }}" class="navbar-link">Déjà inscrit ? Se connecter →</a>
</nav>

<div class="auth-container">
    <div class="auth-wrapper">

        {{-- LEFT PANEL --}}
        <div class="auth-left">
            <div class="auth-left-content">
                <h2>Rejoignez CliniqPlus dès aujourd'hui</h2>
                <p>Créez votre compte gratuitement et accédez à tous nos services médicaux en ligne.</p>
                <div class="auth-features">
                    <div class="auth-feature">
                        <div class="auth-feature-icon">📅</div>
                        Prise de rendez-vous en ligne 24h/24
                    </div>
                    <div class="auth-feature">
                        <div class="auth-feature-icon">👨‍⚕️</div>
                        Accès à nos médecins spécialistes
                    </div>
                    <div class="auth-feature">
                        <div class="auth-feature-icon">✅</div>
                        Confirmation immédiate de vos RDV
                    </div>
                    <div class="auth-feature">
                        <div class="auth-feature-icon">🔒</div>
                        Données médicales sécurisées
                    </div>
                </div>
            </div>
            <div class="auth-left-footer">
                © {{ date('Y') }} CliniqPlus — Dakar, Sénégal
            </div>
        </div>

        {{-- RIGHT PANEL --}}
        <div class="auth-right">
            <h1>Créer un compte</h1>
            <p>Remplissez le formulaire pour commencer</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-grid-2">
                    {{-- NOM --}}
                    <div class="form-group full">
                        <label class="form-label">Nom complet</label>
                        <input type="text" name="name" class="form-input"
                               value="{{ old('name') }}" placeholder="Ex: Fatou Diallo" required autofocus>
                        @error('name') <p class="form-error">⚠️ {{ $message }}</p> @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="form-group full">
                        <label class="form-label">Adresse email</label>
                        <input type="email" name="email" class="form-input"
                               value="{{ old('email') }}" placeholder="exemple@email.com" required>
                        @error('email') <p class="form-error">⚠️ {{ $message }}</p> @enderror
                    </div>

                    {{-- TÉLÉPHONE --}}
                    <div class="form-group full">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="telephone" class="form-input"
                               value="{{ old('telephone') }}" placeholder="77 XXX XX XX" required>
                        @error('telephone') <p class="form-error">⚠️ {{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- RÔLE --}}
                <div class="form-group">
                    <label class="form-label">Je suis un...</label>
                    <div class="role-grid">
                        <label class="role-option selected" onclick="selectRole(this, 'patient')">
                            <input type="radio" name="role" value="patient" checked>
                            <div class="role-check">✓</div>
                            <div class="role-icon">🧑‍🤝‍🧑</div>
                            <div class="role-name">Patient</div>
                            <div class="role-desc">Je cherche un médecin</div>
                        </label>
                        <label class="role-option" onclick="selectRole(this, 'medecin')">
                            <input type="radio" name="role" value="medecin">
                            <div class="role-check">✓</div>
                            <div class="role-icon">👨‍⚕️</div>
                            <div class="role-name">Médecin</div>
                            <div class="role-desc">Je suis professionnel de santé</div>
                        </label>
                    </div>
                    @error('role') <p class="form-error">⚠️ {{ $message }}</p> @enderror
                </div>

                {{-- SPÉCIALITÉ --}}
                <div id="specialite-wrapper">
                    <label class="form-label">Spécialité médicale</label>
                    <input type="text" name="specialite" class="form-input"
                           value="{{ old('specialite') }}" placeholder="Ex: Cardiologie, Pédiatrie...">
                    @error('specialite') <p class="form-error">⚠️ {{ $message }}</p> @enderror
                </div>

                <div class="form-grid-2">
                    {{-- MOT DE PASSE --}}
                    <div class="form-group">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-input"
                               placeholder="Min. 8 caractères" required autocomplete="new-password">
                        @error('password') <p class="form-error">⚠️ {{ $message }}</p> @enderror
                    </div>

                    {{-- CONFIRMATION --}}
                    <div class="form-group">
                        <label class="form-label">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-input"
                               placeholder="Répétez le mot de passe" required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    ✅ Créer mon compte gratuitement
                </button>
            </form>

            <div class="auth-footer">
                Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
            </div>
        </div>
    </div>
</div>

<script>
    function selectRole(label, role) {
        document.querySelectorAll('.role-option').forEach(l => l.classList.remove('selected'));
        label.classList.add('selected');
        label.querySelector('input[type="radio"]').checked = true;
        document.getElementById('specialite-wrapper').style.display =
            role === 'medecin' ? 'block' : 'none';
    }
</script>

</body>
</html>