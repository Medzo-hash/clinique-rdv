<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — CliniqPlus</title>
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
            display: flex; flex-direction: column;
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

        /* MAIN */
        .auth-container {
            flex: 1; display: flex; align-items: center;
            justify-content: center; padding: 40px 20px;
        }
        .auth-wrapper {
            display: grid; grid-template-columns: 1fr 1fr;
            max-width: 900px; width: 100%;
            background: white; border-radius: 20px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.1); overflow: hidden;
        }

        /* LEFT */
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

        .stats-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 12px; margin-top: 32px;
        }
        .stat-box {
            background: rgba(255,255,255,0.12); border-radius: 12px;
            padding: 16px; text-align: center;
            border: 1px solid rgba(255,255,255,0.15);
        }
        .stat-box .value { font-size: 24px; font-weight: 900; color: white; }
        .stat-box .label { font-size: 12px; color: rgba(255,255,255,0.75); margin-top: 4px; }

        .auth-left-footer {
            position: relative; z-index: 1;
            font-size: 13px; color: rgba(255,255,255,0.6);
        }

        /* RIGHT */
        .auth-right { padding: 48px 40px; }
        .auth-right h1 {
            font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 6px;
        }
        .auth-right .subtitle { font-size: 14px; color: #6b7280; margin-bottom: 32px; }

        /* FORM */
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block; font-size: 13px; font-weight: 600;
            color: #374151; margin-bottom: 6px;
        }
        .form-input {
            width: 100%; padding: 12px 14px;
            border: 1.5px solid #e2e8f0; border-radius: 10px;
            font-size: 14px; outline: none; transition: all 0.2s;
            font-family: 'Segoe UI', sans-serif; color: #0f172a;
        }
        .form-input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(26,86,219,0.1);
        }
        .form-error { font-size: 12px; color: #dc2626; margin-top: 4px; }

        /* REMEMBER + FORGOT */
        .form-row {
            display: flex; justify-content: space-between;
            align-items: center; margin-bottom: 24px;
        }
        .remember-label {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; color: #6b7280; cursor: pointer;
        }
        .remember-label input { cursor: pointer; accent-color: var(--blue); }
        .forgot-link {
            font-size: 13px; color: var(--blue);
            text-decoration: none; font-weight: 600;
        }
        .forgot-link:hover { text-decoration: underline; }

        /* ALERT */
        .alert-error {
            background: #fef2f2; border: 1px solid #fecaca;
            border-radius: 10px; padding: 12px 16px; margin-bottom: 20px;
            color: #b91c1c; font-size: 13px; font-weight: 600;
        }
        .alert-status {
            background: #f0fdf4; border: 1px solid #bbf7d0;
            border-radius: 10px; padding: 12px 16px; margin-bottom: 20px;
            color: #15803d; font-size: 13px; font-weight: 600;
        }

        /* SUBMIT */
        .btn-submit {
            width: 100%; padding: 13px; background: var(--blue);
            color: white; border: none; border-radius: 10px;
            font-size: 15px; font-weight: 700; cursor: pointer;
            transition: all 0.2s; font-family: 'Segoe UI', sans-serif;
        }
        .btn-submit:hover { background: var(--blue-dark); transform: translateY(-1px); }

        /* QUICK LOGIN */
        .quick-login {
            margin-top: 24px; padding: 16px;
            background: #f8fafc; border-radius: 10px;
            border: 1px solid #f1f5f9;
        }
        .quick-login-title {
            font-size: 12px; font-weight: 700; color: #6b7280;
            text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px;
        }
        .quick-btn {
            display: flex; align-items: center; gap: 8px;
            padding: 8px 12px; border-radius: 8px; border: 1px solid #e2e8f0;
            background: white; cursor: pointer; font-size: 12px;
            font-weight: 600; color: #374151; margin-bottom: 6px;
            width: 100%; transition: all 0.2s; font-family: 'Segoe UI', sans-serif;
        }
        .quick-btn:hover { border-color: var(--blue); color: var(--blue); background: var(--blue-light); }
        .quick-btn:last-child { margin-bottom: 0; }

        .auth-footer {
            text-align: center; margin-top: 20px;
            font-size: 14px; color: #6b7280;
        }
        .auth-footer a { color: var(--blue); font-weight: 600; text-decoration: none; }

        @media (max-width: 768px) {
            .auth-wrapper { grid-template-columns: 1fr; }
            .auth-left { display: none; }
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
    <a href="{{ route('register') }}" class="navbar-link">Pas encore inscrit ? S'inscrire →</a>
</nav>

<div class="auth-container">
    <div class="auth-wrapper">

        {{-- LEFT PANEL --}}
        <div class="auth-left">
            <div class="auth-left-content">
                <h2>Bon retour sur CliniqPlus !</h2>
                <p>Connectez-vous pour gérer vos rendez-vous médicaux et accéder à votre espace personnel.</p>
                <div class="stats-grid">
                    <div class="stat-box">
                        <div class="value">{{ \App\Models\User::where('role','medecin')->count() }}+</div>
                        <div class="label">Médecins</div>
                    </div>
                    <div class="stat-box">
                        <div class="value">{{ \App\Models\User::where('role','patient')->count() }}+</div>
                        <div class="label">Patients</div>
                    </div>
                    <div class="stat-box">
                        <div class="value">{{ \App\Models\RendezVous::count() }}+</div>
                        <div class="label">RDV pris</div>
                    </div>
                    <div class="stat-box">
                        <div class="value">24/7</div>
                        <div class="label">Disponible</div>
                    </div>
                </div>
            </div>
            <div class="auth-left-footer">
                © {{ date('Y') }} CliniqPlus — Dakar, Sénégal
            </div>
        </div>

        {{-- RIGHT PANEL --}}
        <div class="auth-right">
            <h1>🔐 Connexion</h1>
            <p class="subtitle">Entrez vos identifiants pour accéder à votre espace</p>

            {{-- STATUS --}}
            @if (session('status'))
                <div class="alert-status">✅ {{ session('status') }}</div>
            @endif

            {{-- ERRORS --}}
            @if ($errors->any())
                <div class="alert-error">
                    ⚠️ Email ou mot de passe incorrect.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Adresse email</label>
                    <input type="email" name="email" class="form-input"
                           value="{{ old('email') }}" placeholder="exemple@email.com"
                           required autofocus autocomplete="username">
                    @error('email') <p class="form-error">⚠️ {{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-input"
                           placeholder="Votre mot de passe"
                           required autocomplete="current-password">
                    @error('password') <p class="form-error">⚠️ {{ $message }}</p> @enderror
                </div>

                <div class="form-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember">
                        Se souvenir de moi
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">
                    🔐 Se connecter
                </button>
            </form>

            {{-- QUICK LOGIN --}}
            <div class="quick-login">
                <div class="quick-login-title">🚀 Connexion rapide (démo)</div>
                <button class="quick-btn" onclick="fillLogin('admin@clinique.sn', 'Admin@2026')">
                    👑 Administrateur — admin@clinique.sn
                </button>
                <button class="quick-btn" onclick="fillLogin('test.medecin@gmail.com', 'password')">
                    👨‍⚕️ Médecin — test.medecin@gmail.com
                </button>
            </div>

            <div class="auth-footer">
                Pas encore de compte ? <a href="{{ route('register') }}">S'inscrire gratuitement</a>
            </div>
        </div>
    </div>
</div>

<script>
    function fillLogin(email, password) {
        document.querySelector('input[name="email"]').value = email;
        document.querySelector('input[name="password"]').value = password;
    }
</script>

</body>
</html>