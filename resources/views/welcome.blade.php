<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinique de Quartier — Dakar</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; color: #1e293b; }

        /* NAVBAR */
        .navbar {
            background: #1e40af; padding: 16px 40px;
            display: flex; justify-content: space-between; align-items: center;
            position: sticky; top: 0; z-index: 100;
        }
        .logo { color: white; font-size: 20px; font-weight: 700; text-decoration: none; }
        .nav-links { display: flex; align-items: center; gap: 20px; }
        .nav-links a { color: rgba(255,255,255,0.85); text-decoration: none; font-size: 14px; font-weight: 500; }
        .nav-links a:hover { color: white; }
        .btn-white { background: white; color: #1e40af !important; padding: 8px 18px; border-radius: 6px; font-weight: 700 !important; }
        .btn-outline { border: 2px solid white; color: white !important; padding: 7px 18px; border-radius: 6px; font-weight: 600 !important; }

        /* HERO */
        .hero {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 60%, #3b82f6 100%);
            padding: 90px 40px; display: flex; align-items: center;
            justify-content: space-between; gap: 40px; min-height: 520px;
        }
        .hero-content { max-width: 560px; }
        .hero-badge {
            display: inline-block; background: rgba(255,255,255,0.2);
            color: white; padding: 6px 16px; border-radius: 20px; font-size: 13px;
            font-weight: 600; margin-bottom: 20px;
        }
        .hero h1 { font-size: 44px; font-weight: 800; color: white; line-height: 1.2; margin-bottom: 16px; }
        .hero p { font-size: 17px; color: rgba(255,255,255,0.9); line-height: 1.6; margin-bottom: 32px; }
        .hero-buttons { display: flex; gap: 14px; flex-wrap: wrap; }
        .btn-hero-primary {
            background: white; color: #1e40af; padding: 14px 28px;
            border-radius: 8px; font-weight: 700; font-size: 15px; text-decoration: none;
        }
        .btn-hero-primary:hover { background: #f1f5f9; }
        .btn-hero-secondary {
            border: 2px solid white; color: white; padding: 12px 28px;
            border-radius: 8px; font-weight: 600; font-size: 15px; text-decoration: none;
        }
        .btn-hero-secondary:hover { background: rgba(255,255,255,0.1); }

        .hero-card {
            background: white; border-radius: 16px; padding: 28px;
            min-width: 280px; box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }
        .hero-card h3 { font-size: 16px; font-weight: 700; margin-bottom: 16px; color: #1e293b; }
        .hero-stat { display: flex; align-items: center; gap: 12px; margin-bottom: 14px; }
        .hero-stat-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 18px;
        }
        .hero-stat-info .value { font-size: 20px; font-weight: 800; color: #1e293b; }
        .hero-stat-info .label { font-size: 12px; color: #6b7280; }

        /* SERVICES */
        .section { padding: 64px 40px; max-width: 1100px; margin: 0 auto; }
        .section-title { text-align: center; font-size: 30px; font-weight: 800; margin-bottom: 8px; }
        .section-sub { text-align: center; color: #6b7280; font-size: 15px; margin-bottom: 40px; }

        .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .service-card {
            background: white; border-radius: 12px; padding: 28px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06); text-align: center;
            transition: transform 0.2s;
        }
        .service-card:hover { transform: translateY(-4px); }
        .service-icon {
            width: 60px; height: 60px; border-radius: 14px; background: #eff6ff;
            margin: 0 auto 16px; display: flex; align-items: center;
            justify-content: center; font-size: 26px;
        }
        .service-card h3 { font-size: 16px; font-weight: 700; margin-bottom: 8px; }
        .service-card p { font-size: 13px; color: #6b7280; line-height: 1.6; }

        /* STEPS */
        .steps-section { background: #eff6ff; padding: 64px 40px; }
        .steps-inner { max-width: 900px; margin: 0 auto; }
        .steps-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-top: 40px; }
        .step-card { text-align: center; padding: 20px; }
        .step-number {
            width: 48px; height: 48px; border-radius: 50%; background: #2563eb;
            color: white; font-size: 20px; font-weight: 800;
            margin: 0 auto 14px; display: flex; align-items: center; justify-content: center;
        }
        .step-card h3 { font-size: 15px; font-weight: 700; margin-bottom: 6px; }
        .step-card p { font-size: 13px; color: #6b7280; }

        /* CTA */
        .cta-section {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            padding: 64px 40px; text-align: center; color: white;
        }
        .cta-section h2 { font-size: 32px; font-weight: 800; margin-bottom: 12px; }
        .cta-section p { font-size: 16px; opacity: 0.9; margin-bottom: 32px; }
        .cta-buttons { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
        .btn-cta-primary {
            background: white; color: #1e40af; padding: 14px 32px;
            border-radius: 8px; font-weight: 700; font-size: 15px; text-decoration: none;
        }
        .btn-cta-secondary {
            border: 2px solid white; color: white; padding: 12px 32px;
            border-radius: 8px; font-weight: 600; font-size: 15px; text-decoration: none;
        }

        /* FOOTER */
        footer {
            background: #0f172a; color: rgba(255,255,255,0.6);
            padding: 32px 40px; display: flex;
            justify-content: space-between; align-items: center; font-size: 13px;
        }
        footer .footer-logo { color: white; font-size: 16px; font-weight: 700; }
        footer .footer-links { display: flex; gap: 20px; }
        footer .footer-links a { color: rgba(255,255,255,0.6); text-decoration: none; }
        footer .footer-links a:hover { color: white; }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
    <a href="/" class="logo">🏥 Clinique de Quartier</a>
    <div class="nav-links">
        <a href="/">Accueil</a>
        <a href="/medecins">Médecins</a>
        @auth
            <a href="{{ route('dashboard') }}">Mon espace</a>
            <a href="{{ route('rendezvous.create') }}" class="btn-white">Prendre RDV</a>
        @else
            <a href="{{ route('login') }}" class="btn-outline">Connexion</a>
            <a href="{{ route('register') }}" class="btn-white">S'inscrire</a>
        @endauth
    </div>
</nav>

{{-- HERO --}}
<section class="hero">
    <div class="hero-content">
        <span class="hero-badge">🏥 Clinique de Quartier — Dakar</span>
        <h1>Prenez rendez-vous en ligne facilement</h1>
        <p>Consultez nos médecins spécialistes depuis chez vous. Réservation rapide, confirmation immédiate.</p>
        <div class="hero-buttons">
            @auth
                <a href="{{ route('rendezvous.create') }}" class="btn-hero-primary">📅 Prendre un RDV</a>
                <a href="/medecins" class="btn-hero-secondary">Voir les médecins</a>
            @else
                <a href="{{ route('register') }}" class="btn-hero-primary">📅 Prendre un RDV</a>
                <a href="/medecins" class="btn-hero-secondary">Voir les médecins</a>
            @endauth
        </div>
    </div>
    <div class="hero-card">
        <h3>📊 En chiffres</h3>
        <div class="hero-stat">
            <div class="hero-stat-icon" style="background:#eff6ff">👨‍⚕️</div>
            <div class="hero-stat-info">
                <div class="value">{{ \App\Models\User::where('role','medecin')->count() }}</div>
                <div class="label">Médecins disponibles</div>
            </div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-icon" style="background:#f0fdf4">👥</div>
            <div class="hero-stat-info">
                <div class="value">{{ \App\Models\User::where('role','patient')->count() }}</div>
                <div class="label">Patients inscrits</div>
            </div>
        </div>
        <div class="hero-stat">
            <div class="hero-stat-icon" style="background:#fef3c7">📅</div>
            <div class="hero-stat-info">
                <div class="value">{{ \App\Models\RendezVous::count() }}</div>
                <div class="label">Rendez-vous pris</div>
            </div>
        </div>
    </div>
</section>

{{-- SERVICES --}}
<div class="section">
    <h2 class="section-title">Nos services</h2>
    <p class="section-sub">Une prise en charge complète pour toute la famille</p>
    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon">🩺</div>
            <h3>Médecine générale</h3>
            <p>Consultations de routine, suivi des maladies chroniques et soins primaires.</p>
        </div>
        <div class="service-card">
            <div class="service-icon">❤️</div>
            <h3>Cardiologie</h3>
            <p>Diagnostic et traitement des maladies cardiovasculaires avec des équipements modernes.</p>
        </div>
        <div class="service-card">
            <div class="service-icon">👶</div>
            <h3>Pédiatrie</h3>
            <p>Soins spécialisés pour les nourrissons, enfants et adolescents.</p>
        </div>
        <div class="service-card">
            <div class="service-icon">🦷</div>
            <h3>Dentisterie</h3>
            <p>Soins dentaires préventifs et curatifs pour toute la famille.</p>
        </div>
        <div class="service-card">
            <div class="service-icon">👁️</div>
            <h3>Ophtalmologie</h3>
            <p>Examens de la vue et traitement des troubles oculaires.</p>
        </div>
        <div class="service-card">
            <div class="service-icon">🤰</div>
            <h3>Gynécologie</h3>
            <p>Suivi gynécologique, prénatal et accompagnement maternité.</p>
        </div>
    </div>
</div>

{{-- ÉTAPES --}}
<div class="steps-section">
    <div class="steps-inner">
        <h2 class="section-title">Comment ça marche ?</h2>
        <p class="section-sub">Prendre rendez-vous en 4 étapes simples</p>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-number">1</div>
                <h3>Créez un compte</h3>
                <p>Inscription rapide avec vos informations de base</p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h3>Choisissez un médecin</h3>
                <p>Consultez notre liste de médecins et leurs spécialités</p>
            </div>
            <div class="step-card">
                <div class="step-number">3</div>
                <h3>Réservez un créneau</h3>
                <p>Choisissez la date et l'heure qui vous conviennent</p>
            </div>
            <div class="step-card">
                <div class="step-number">4</div>
                <h3>Confirmé !</h3>
                <p>Votre rendez-vous est enregistré et confirmé par la clinique</p>
            </div>
        </div>
    </div>
</div>

{{-- CTA --}}
<section class="cta-section">
    <h2>Prêt à prendre soin de votre santé ?</h2>
    <p>Rejoignez des centaines de patients qui nous font confiance</p>
    <div class="cta-buttons">
        @auth
            <a href="{{ route('rendezvous.create') }}" class="btn-cta-primary">📅 Prendre un RDV maintenant</a>
            <a href="/medecins" class="btn-cta-secondary">Voir nos médecins</a>
        @else
            <a href="{{ route('register') }}" class="btn-cta-primary">📅 S'inscrire gratuitement</a>
            <a href="{{ route('login') }}" class="btn-cta-secondary">Se connecter</a>
        @endauth
    </div>
</section>

{{-- FOOTER --}}
<footer>
    <div class="footer-logo">🏥 Clinique de Quartier</div>
    <div>© {{ date('Y') }} — Dakar, Sénégal</div>
    <div class="footer-links">
        <a href="/medecins">Médecins</a>
        <a href="{{ route('login') }}">Connexion</a>
        <a href="{{ route('register') }}">S'inscrire</a>
    </div>
</footer>

</body>
</html>