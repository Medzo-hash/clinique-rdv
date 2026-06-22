<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Médecins — CliniqPlus</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --blue: #1a56db;
            --blue-dark: #1e3a8a;
            --blue-light: #eff6ff;
            --white: #ffffff;
            --gray: #6b7280;
            --dark: #0f172a;
        }
        body { font-family: 'Segoe UI', sans-serif; color: var(--dark); }

        /* NAVBAR */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            padding: 0 40px; height: 70px;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(255,255,255,0.95); backdrop-filter: blur(10px);
            box-shadow: 0 1px 20px rgba(0,0,0,0.08);
        }
        .navbar-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .logo-icon {
            width: 42px; height: 42px; background: var(--blue);
            border-radius: 10px; display: flex; align-items: center;
            justify-content: center; font-size: 20px;
        }
        .logo-text { font-size: 20px; font-weight: 800; color: var(--blue-dark); }
        .logo-text span { color: var(--blue); }
        .nav-links { display: flex; align-items: center; gap: 8px; }
        .nav-links a {
            padding: 8px 16px; border-radius: 8px; text-decoration: none;
            font-size: 14px; font-weight: 500; color: var(--gray); transition: all 0.2s;
        }
        .nav-links a:hover { background: var(--blue-light); color: var(--blue); }
        .btn-login { border: 1.5px solid var(--blue) !important; color: var(--blue) !important; }
        .btn-register { background: var(--blue) !important; color: white !important; font-weight: 600 !important; }

        /* HERO */
        .hero {
            margin-top: 70px;
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue) 100%);
            padding: 70px 40px; text-align: center; position: relative; overflow: hidden;
        }
        .hero::before {
            content: ''; position: absolute; width: 500px; height: 500px;
            border-radius: 50%; background: rgba(255,255,255,0.05);
            top: -200px; right: -100px;
        }
        .hero::after {
            content: ''; position: absolute; width: 300px; height: 300px;
            border-radius: 50%; background: rgba(255,255,255,0.05);
            bottom: -100px; left: -80px;
        }
        .hero-inner { position: relative; z-index: 1; max-width: 700px; margin: 0 auto; }
        .hero-tag {
            display: inline-block; background: rgba(255,255,255,0.15);
            color: white; padding: 6px 18px; border-radius: 30px;
            font-size: 13px; font-weight: 600; margin-bottom: 20px;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .hero h1 { font-size: 42px; font-weight: 900; color: white; margin-bottom: 14px; }
        .hero p { font-size: 17px; color: rgba(255,255,255,0.85); line-height: 1.7; margin-bottom: 32px; }

        /* SEARCH */
        .search-bar {
            display: flex; gap: 12px; max-width: 600px; margin: 0 auto;
            background: white; padding: 8px; border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }
        .search-bar input {
            flex: 1; border: none; outline: none; font-size: 14px;
            padding: 8px 12px; font-family: inherit; color: var(--dark);
        }
        .search-bar select {
            border: none; outline: none; font-size: 14px;
            padding: 8px 12px; font-family: inherit; color: var(--dark);
            background: var(--blue-light); border-radius: 8px; cursor: pointer;
        }
        .search-bar button {
            background: var(--blue); color: white; border: none;
            padding: 10px 20px; border-radius: 8px; font-weight: 700;
            font-size: 14px; cursor: pointer; white-space: nowrap;
        }

        /* STATS */
        .stats-bar { background: white; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
        .stats-inner {
            max-width: 1100px; margin: 0 auto;
            display: grid; grid-template-columns: repeat(3, 1fr);
        }
        .stat-item { padding: 24px; text-align: center; border-right: 1px solid #f1f5f9; }
        .stat-item:last-child { border: none; }
        .stat-number { font-size: 30px; font-weight: 900; color: var(--blue); }
        .stat-label { font-size: 13px; color: var(--gray); margin-top: 4px; }

        /* MAIN CONTENT */
        .main { max-width: 1100px; margin: 0 auto; padding: 52px 40px; }

        /* FILTER TABS */
        .filter-tabs {
            display: flex; gap: 8px; margin-bottom: 36px; flex-wrap: wrap;
        }
        .filter-tab {
            padding: 9px 20px; border-radius: 30px; font-size: 14px;
            font-weight: 600; cursor: pointer; border: 1.5px solid #e2e8f0;
            background: white; color: var(--gray); transition: all 0.2s;
        }
        .filter-tab:hover, .filter-tab.active {
            background: var(--blue); color: white; border-color: var(--blue);
        }

        /* DOCTORS GRID */
        .doctors-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }

        .doctor-card {
            background: white; border-radius: 16px; overflow: hidden;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            transition: all 0.3s; border: 1px solid #f1f5f9;
        }
        .doctor-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(26,86,219,0.12);
            border-color: var(--blue-light);
        }
        .doctor-top {
            background: linear-gradient(135deg, var(--blue-dark), var(--blue));
            padding: 32px 24px; text-align: center; position: relative;
        }
        .doctor-available {
            position: absolute; top: 14px; right: 14px;
            background: #22c55e; color: white;
            padding: 4px 10px; border-radius: 20px;
            font-size: 11px; font-weight: 700;
        }
        .doctor-avatar {
            width: 82px; height: 82px; border-radius: 50%;
            background: rgba(255,255,255,0.2);
            border: 3px solid rgba(255,255,255,0.5);
            margin: 0 auto 14px; display: flex;
            align-items: center; justify-content: center;
            font-size: 30px; font-weight: 800; color: white;
        }
        .doctor-name { font-size: 17px; font-weight: 700; color: white; margin-bottom: 4px; }
        .doctor-spec {
            display: inline-block; background: rgba(255,255,255,0.2);
            color: white; padding: 4px 12px; border-radius: 20px;
            font-size: 12px; font-weight: 600; margin-top: 6px;
        }

        .doctor-body { padding: 20px 24px; }
        .doctor-info {
            display: flex; justify-content: space-between; align-items: center;
            padding: 10px 0; border-bottom: 1px solid #f8fafc;
            font-size: 13px;
        }
        .doctor-info:last-child { border: none; }
        .doctor-info .label { color: var(--gray); display: flex; align-items: center; gap: 6px; }
        .doctor-info .value { font-weight: 600; color: var(--dark); }

        .doctor-footer { padding: 0 24px 24px; display: flex; gap: 10px; }
        .btn-rdv {
            flex: 1; text-align: center; background: var(--blue); color: white;
            padding: 12px; border-radius: 10px; font-weight: 700;
            font-size: 14px; text-decoration: none; transition: all 0.2s;
        }
        .btn-rdv:hover { background: var(--blue-dark); transform: translateY(-1px); }
        .btn-profile {
            width: 44px; height: 44px; border-radius: 10px;
            background: var(--blue-light); display: flex;
            align-items: center; justify-content: center;
            text-decoration: none; font-size: 18px; transition: all 0.2s;
        }
        .btn-profile:hover { background: var(--blue); }

        /* EMPTY */
        .empty {
            grid-column: 1/-1; text-align: center; padding: 80px;
            color: var(--gray);
        }
        .empty-icon { font-size: 48px; margin-bottom: 16px; }
        .empty h3 { font-size: 20px; font-weight: 700; margin-bottom: 8px; color: var(--dark); }

        /* CTA */
        .cta-section {
            background: linear-gradient(135deg, var(--blue-dark), var(--blue));
            padding: 64px 40px; text-align: center; margin-top: 60px;
        }
        .cta-section h2 { font-size: 32px; font-weight: 800; color: white; margin-bottom: 12px; }
        .cta-section p { color: rgba(255,255,255,0.85); font-size: 16px; margin-bottom: 28px; }
        .btn-cta {
            background: white; color: var(--blue); padding: 14px 32px;
            border-radius: 10px; font-weight: 700; font-size: 15px;
            text-decoration: none; display: inline-block; transition: all 0.2s;
        }
        .btn-cta:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.2); }

        /* FOOTER */
        footer {
            background: var(--dark); color: rgba(255,255,255,0.6);
            padding: 32px 40px; display: flex;
            justify-content: space-between; align-items: center; font-size: 13px;
        }
        .footer-logo { display: flex; align-items: center; gap: 10px; }
        .footer-logo .logo-text { color: white; }
        footer .links { display: flex; gap: 20px; }
        footer .links a { color: rgba(255,255,255,0.6); text-decoration: none; }
        footer .links a:hover { color: white; }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar { padding: 0 20px; }
            .nav-links a:not(.btn-login):not(.btn-register) { display: none; }
            .hero { padding: 48px 20px; }
            .hero h1 { font-size: 28px; }
            .search-bar { flex-direction: column; }
            .stats-inner { grid-template-columns: 1fr; }
            .main { padding: 36px 20px; }
            .doctors-grid { grid-template-columns: 1fr; }
            footer { flex-direction: column; gap: 16px; text-align: center; }
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
    <div class="nav-links">
        <a href="/">Accueil</a>
        <a href="/medecins">Médecins</a>
        @auth
            <a href="{{ route('dashboard') }}">Mon espace</a>
            <a href="{{ route('rendezvous.create') }}" class="btn-register">📅 Prendre RDV</a>
        @else
            <a href="{{ route('login') }}" class="btn-login">Connexion</a>
            <a href="{{ route('register') }}" class="btn-register">S'inscrire</a>
        @endauth
    </div>
</nav>

{{-- HERO --}}
<section class="hero">
    <div class="hero-inner">
        <span class="hero-tag">👨‍⚕️ Notre équipe médicale</span>
        <h1>Trouvez votre médecin idéal</h1>
        <p>Consultez nos spécialistes qualifiés et prenez rendez-vous en ligne en quelques clics.</p>
        <div class="search-bar">
            <input type="text" placeholder="🔍  Rechercher un médecin...">
            <select>
                <option>Toutes spécialités</option>
                <option>Médecine générale</option>
                <option>Cardiologie</option>
                <option>Pédiatrie</option>
                <option>Gynécologie</option>
            </select>
            <button>Rechercher</button>
        </div>
    </div>
</section>

{{-- STATS --}}
<div class="stats-bar">
    <div class="stats-inner">
        <div class="stat-item">
            <div class="stat-number">{{ $medecins->count() }}</div>
            <div class="stat-label">Médecins disponibles</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">6+</div>
            <div class="stat-label">Spécialités couvertes</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">24/7</div>
            <div class="stat-label">Prise de RDV en ligne</div>
        </div>
    </div>
</div>

{{-- MAIN --}}
<div class="main">

    {{-- FILTER TABS --}}
    <div class="filter-tabs">
        <div class="filter-tab active">Tous</div>
        <div class="filter-tab">Médecine générale</div>
        <div class="filter-tab">Cardiologie</div>
        <div class="filter-tab">Pédiatrie</div>
        <div class="filter-tab">Gynécologie</div>
    </div>

    {{-- DOCTORS GRID --}}
    <div class="doctors-grid">
        @forelse ($medecins as $medecin)
        <div class="doctor-card">
            <div class="doctor-top">
                <span class="doctor-available">🟢 Disponible</span>
                <div class="doctor-avatar">
                    {{ strtoupper(substr($medecin->name, 0, 2)) }}
                </div>
                <div class="doctor-name">Dr. {{ $medecin->name }}</div>
                <span class="doctor-spec">{{ $medecin->specialite ?? 'Médecine générale' }}</span>
            </div>
            <div class="doctor-body">
                <div class="doctor-info">
                    <span class="label">📞 Téléphone</span>
                    <span class="value">{{ $medecin->telephone ?? 'N/A' }}</span>
                </div>
                <div class="doctor-info">
                    <span class="label">🎓 Spécialité</span>
                    <span class="value">{{ $medecin->specialite ?? 'Généraliste' }}</span>
                </div>
                <div class="doctor-info">
                    <span class="label">📅 RDV en ligne</span>
                    <span class="value" style="color:#16a34a">✅ Disponible</span>
                </div>
            </div>
            <div class="doctor-footer">
                @auth
                    <a href="{{ route('rendezvous.create') }}" class="btn-rdv">📅 Prendre RDV</a>
                @else
                    <a href="{{ route('login') }}" class="btn-rdv">📅 Prendre RDV</a>
                @endauth
                <a href="#" class="btn-profile">👤</a>
            </div>
        </div>
        @empty
        <div class="empty">
            <div class="empty-icon">👨‍⚕️</div>
            <h3>Aucun médecin disponible</h3>
            <p>Revenez bientôt, notre équipe s'agrandit !</p>
        </div>
        @endforelse
    </div>
</div>

{{-- CTA --}}
<section class="cta-section">
    <h2>Prêt à consulter ?</h2>
    <p>Inscrivez-vous gratuitement et prenez votre premier rendez-vous en moins de 2 minutes.</p>
    @auth
        <a href="{{ route('rendezvous.create') }}" class="btn-cta">📅 Prendre un RDV maintenant</a>
    @else
        <a href="{{ route('register') }}" class="btn-cta">📅 S'inscrire gratuitement</a>
    @endauth
</section>

{{-- FOOTER --}}
<footer>
    <div class="footer-logo">
        <div class="logo-icon">🏥</div>
        <div class="logo-text">Cliniq<span style="color:var(--blue)">Plus</span></div>
    </div>
    <div>© {{ date('Y') }} CliniqPlus — Dakar, Sénégal</div>
    <div class="links">
        <a href="/">Accueil</a>
        <a href="{{ route('login') }}">Connexion</a>
        <a href="{{ route('register') }}">S'inscrire</a>
    </div>
</footer>

</body>
</html>