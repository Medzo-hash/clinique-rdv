<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Médecins — Clinique de Quartier</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; color: #1e293b; }

        .navbar {
            background: #1e40af; padding: 16px 40px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .navbar .logo { color: white; font-size: 20px; font-weight: 700; text-decoration: none; }
        .navbar .nav-links { display: flex; gap: 16px; }
        .navbar .nav-links a {
            color: rgba(255,255,255,0.85); text-decoration: none; font-size: 14px; font-weight: 500;
        }
        .navbar .nav-links a:hover { color: white; }
        .btn-nav {
            background: white; color: #1e40af; padding: 8px 18px;
            border-radius: 6px; font-weight: 600; text-decoration: none; font-size: 14px;
        }

        .hero {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            padding: 60px 40px; text-align: center; color: white;
        }
        .hero h1 { font-size: 36px; font-weight: 800; margin-bottom: 12px; }
        .hero p { font-size: 16px; opacity: 0.9; }

        .container { max-width: 1100px; margin: 0 auto; padding: 48px 24px; }

        .grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;
        }

        .card {
            background: white; border-radius: 12px; overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08); transition: transform 0.2s;
        }
        .card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.12); }

        .card-top {
            background: #eff6ff; padding: 28px; text-align: center;
        }
        .avatar {
            width: 72px; height: 72px; border-radius: 50%; background: #1e40af;
            margin: 0 auto 14px; display: flex; align-items: center; justify-content: center;
            font-size: 26px; font-weight: 700; color: white;
        }
        .card-name { font-size: 17px; font-weight: 700; }
        .card-spec { font-size: 13px; color: #2563eb; font-weight: 600; margin-top: 4px; }

        .card-body { padding: 20px; }
        .info-row {
            display: flex; justify-content: space-between;
            font-size: 13px; margin-bottom: 10px; padding-bottom: 10px;
            border-bottom: 1px solid #f1f5f9;
        }
        .info-row:last-of-type { border-bottom: none; }
        .info-label { color: #6b7280; }
        .info-value { font-weight: 600; }

        .card-footer { padding: 0 20px 20px; }
        .btn-rdv {
            display: block; width: 100%; text-align: center;
            background: #2563eb; color: white; padding: 11px;
            border-radius: 8px; font-weight: 600; font-size: 14px;
            text-decoration: none;
        }
        .btn-rdv:hover { background: #1d4ed8; }

        .empty { text-align: center; padding: 60px; color: #6b7280; font-size: 16px; }

        footer {
            background: #1e293b; color: rgba(255,255,255,0.7);
            text-align: center; padding: 24px; font-size: 13px; margin-top: 40px;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="/" class="logo">🏥 Clinique de Quartier</a>
    <div class="nav-links">
        <a href="/">Accueil</a>
        <a href="/medecins">Médecins</a>
        @auth
            <a href="{{ route('dashboard') }}">Mon espace</a>
            <a href="{{ route('rendezvous.create') }}" class="btn-nav">Prendre RDV</a>
        @else
            <a href="{{ route('login') }}">Connexion</a>
            <a href="{{ route('register') }}" class="btn-nav">S'inscrire</a>
        @endauth
    </div>
</nav>

<div class="hero">
    <h1>👨‍⚕️ Nos Médecins</h1>
    <p>Consultez notre équipe médicale et prenez rendez-vous en ligne</p>
</div>

<div class="container">
    @if ($medecins->isEmpty())
        <div class="empty">Aucun médecin disponible pour le moment.</div>
    @else
        <div class="grid">
            @foreach ($medecins as $medecin)
                <div class="card">
                    <div class="card-top">
                        <div class="avatar">
                            {{ strtoupper(substr($medecin->name, 0, 2)) }}
                        </div>
                        <div class="card-name">Dr. {{ $medecin->name }}</div>
                        <div class="card-spec">{{ $medecin->specialite ?? 'Médecine générale' }}</div>
                    </div>
                    <div class="card-body">
                        <div class="info-row">
                            <span class="info-label">📞 Téléphone</span>
                            <span class="info-value">{{ $medecin->telephone ?? 'N/A' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">🟢 Disponibilité</span>
                            <span class="info-value" style="color: #16a34a;">Disponible</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        @auth
                            <a href="{{ route('rendezvous.create') }}" class="btn-rdv">Prendre RDV</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-rdv">Se connecter pour RDV</a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<footer>
    © {{ date('Y') }} Clinique de Quartier — Dakar, Sénégal
</footer>

</body>
</html>