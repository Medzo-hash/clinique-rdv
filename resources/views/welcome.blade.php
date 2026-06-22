<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CliniqPlus — Clinique de Quartier Dakar</title>
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
        body { font-family: 'Segoe UI', sans-serif; color: var(--dark); overflow-x: hidden; }

        /* ===== NAVBAR ===== */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            padding: 0 40px; height: 70px;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(255,255,255,0.95); backdrop-filter: blur(10px);
            box-shadow: 0 1px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }
        .navbar-logo {
            display: flex; align-items: center; gap: 10px; text-decoration: none;
        }
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
            font-size: 14px; font-weight: 500; color: var(--gray);
            transition: all 0.2s;
        }
        .nav-links a:hover { background: var(--blue-light); color: var(--blue); }
        .btn-login {
            border: 1.5px solid var(--blue) !important; color: var(--blue) !important;
        }
        .btn-register {
            background: var(--blue) !important; color: white !important;
            font-weight: 600 !important;
        }
        .btn-register:hover { background: var(--blue-dark) !important; }

        /* ===== HERO SLIDER ===== */
        .hero {
            position: relative; height: 100vh; min-height: 600px;
            overflow: hidden; margin-top: 70px;
        }
        .slides { display: flex; height: 100%; transition: transform 0.8s ease; }
        .slide {
            min-width: 100%; height: 100%; position: relative; flex-shrink: 0;
        }
        .slide img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .slide-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(15,23,42,0.75) 0%, rgba(26,86,219,0.5) 100%);
        }
        .slide-content {
            position: absolute; inset: 0;
            display: flex; flex-direction: column;
            align-items: flex-start; justify-content: center;
            padding: 0 80px; max-width: 700px;
        }
        .slide-badge {
            background: rgba(255,255,255,0.2); backdrop-filter: blur(10px);
            color: white; padding: 8px 18px; border-radius: 30px;
            font-size: 13px; font-weight: 600; margin-bottom: 24px;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .slide-content h1 {
            font-size: 52px; font-weight: 900; color: white;
            line-height: 1.15; margin-bottom: 20px;
        }
        .slide-content p {
            font-size: 18px; color: rgba(255,255,255,0.88);
            line-height: 1.7; margin-bottom: 36px; max-width: 500px;
        }
        .slide-buttons { display: flex; gap: 14px; flex-wrap: wrap; }
        .btn-slide-primary {
            background: white; color: var(--blue);
            padding: 15px 32px; border-radius: 10px;
            font-weight: 700; font-size: 15px; text-decoration: none;
            transition: all 0.2s; box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .btn-slide-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,0.3); }
        .btn-slide-secondary {
            border: 2px solid white; color: white;
            padding: 13px 32px; border-radius: 10px;
            font-weight: 600; font-size: 15px; text-decoration: none;
            transition: all 0.2s;
        }
        .btn-slide-secondary:hover { background: rgba(255,255,255,0.15); }

        /* Slider controls */
        .slider-dots {
            position: absolute; bottom: 30px; left: 50%;
            transform: translateX(-50%);
            display: flex; gap: 10px; z-index: 10;
        }
        .dot {
            width: 10px; height: 10px; border-radius: 50%;
            background: rgba(255,255,255,0.5); cursor: pointer;
            transition: all 0.3s; border: none;
        }
        .dot.active { background: white; width: 28px; border-radius: 5px; }
        .slider-arrow {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 48px; height: 48px; border-radius: 50%;
            background: rgba(255,255,255,0.2); backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3); color: white;
            font-size: 20px; cursor: pointer; z-index: 10;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s;
        }
        .slider-arrow:hover { background: rgba(255,255,255,0.35); }
        .slider-arrow.prev { left: 24px; }
        .slider-arrow.next { right: 24px; }

        /* ===== STATS BAR ===== */
        .stats-bar {
            background: white; box-shadow: 0 4px 30px rgba(0,0,0,0.08);
            padding: 0 40px;
        }
        .stats-inner {
            max-width: 1100px; margin: 0 auto;
            display: grid; grid-template-columns: repeat(4, 1fr);
        }
        .stat-item {
            padding: 28px 20px; text-align: center;
            border-right: 1px solid #f1f5f9;
        }
        .stat-item:last-child { border-right: none; }
        .stat-number { font-size: 36px; font-weight: 900; color: var(--blue); }
        .stat-label { font-size: 13px; color: var(--gray); margin-top: 4px; font-weight: 500; }

        /* ===== SECTIONS ===== */
        section { padding: 80px 40px; }
        .section-inner { max-width: 1100px; margin: 0 auto; }
        .section-tag {
            display: inline-block; background: var(--blue-light); color: var(--blue);
            padding: 6px 16px; border-radius: 30px; font-size: 13px;
            font-weight: 700; margin-bottom: 16px; text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .section-title { font-size: 36px; font-weight: 800; line-height: 1.2; margin-bottom: 12px; }
        .section-sub { font-size: 16px; color: var(--gray); line-height: 1.7; max-width: 560px; }

        /* ===== SERVICES ===== */
        .services-section { background: #f8fafc; }
        .services-header { text-align: center; margin-bottom: 52px; }
        .services-header .section-sub { margin: 0 auto; }
        .services-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;
        }
        .service-card {
            background: white; border-radius: 16px; padding: 32px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
            transition: all 0.3s; border: 1px solid #f1f5f9;
            position: relative; overflow: hidden;
        }
        .service-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0;
            height: 4px; background: var(--blue); transform: scaleX(0);
            transition: transform 0.3s; transform-origin: left;
        }
        .service-card:hover { transform: translateY(-6px); box-shadow: 0 12px 40px rgba(26,86,219,0.12); }
        .service-card:hover::before { transform: scaleX(1); }
        .service-icon {
            width: 56px; height: 56px; border-radius: 14px;
            background: var(--blue-light); display: flex;
            align-items: center; justify-content: center;
            font-size: 26px; margin-bottom: 20px;
        }
        .service-card h3 { font-size: 17px; font-weight: 700; margin-bottom: 10px; }
        .service-card p { font-size: 14px; color: var(--gray); line-height: 1.7; }

        /* ===== ABOUT ===== */
        .about-section { background: white; }
        .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
        .about-image {
            border-radius: 20px; overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
            position: relative;
        }
        .about-image img { width: 100%; height: 460px; object-fit: cover; }
        .about-badge {
            position: absolute; bottom: 24px; left: 24px;
            background: white; border-radius: 12px; padding: 16px 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            display: flex; align-items: center; gap: 12px;
        }
        .about-badge-icon { font-size: 28px; }
        .about-badge-text .value { font-size: 22px; font-weight: 800; color: var(--blue); }
        .about-badge-text .label { font-size: 12px; color: var(--gray); }
        .about-content { padding: 20px 0; }
        .about-features { margin-top: 32px; display: flex; flex-direction: column; gap: 16px; }
        .about-feature {
            display: flex; align-items: flex-start; gap: 14px;
        }
        .feature-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: var(--blue-light); display: flex;
            align-items: center; justify-content: center;
            font-size: 18px; flex-shrink: 0;
        }
        .feature-text h4 { font-size: 15px; font-weight: 700; margin-bottom: 4px; }
        .feature-text p { font-size: 13px; color: var(--gray); line-height: 1.6; }

        /* ===== STEPS ===== */
        .steps-section { background: var(--blue-dark); }
        .steps-header { text-align: center; margin-bottom: 52px; }
        .steps-header .section-title { color: white; }
        .steps-header .section-sub { color: rgba(255,255,255,0.7); margin: 0 auto; }
        .steps-header .section-tag { background: rgba(255,255,255,0.15); color: white; }
        .steps-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
        .step-card {
            background: rgba(255,255,255,0.08); border-radius: 16px;
            padding: 32px 24px; text-align: center;
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s;
        }
        .step-card:hover { background: rgba(255,255,255,0.15); transform: translateY(-4px); }
        .step-number {
            width: 52px; height: 52px; border-radius: 50%;
            background: var(--blue); color: white;
            font-size: 22px; font-weight: 800;
            margin: 0 auto 20px; display: flex;
            align-items: center; justify-content: center;
            box-shadow: 0 4px 20px rgba(26,86,219,0.5);
        }
        .step-card h3 { font-size: 16px; font-weight: 700; color: white; margin-bottom: 10px; }
        .step-card p { font-size: 13px; color: rgba(255,255,255,0.65); line-height: 1.7; }

        /* ===== DOCTORS PREVIEW ===== */
        .doctors-section { background: #f8fafc; }
        .doctors-header {
            display: flex; justify-content: space-between;
            align-items: flex-end; margin-bottom: 40px;
        }
        .doctors-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .doctor-card {
            background: white; border-radius: 16px; overflow: hidden;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06); transition: all 0.3s;
        }
        .doctor-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(0,0,0,0.1); }
        .doctor-top {
            background: linear-gradient(135deg, var(--blue-dark), var(--blue));
            padding: 32px; text-align: center;
        }
        .doctor-avatar {
            width: 80px; height: 80px; border-radius: 50%;
            background: rgba(255,255,255,0.2); border: 3px solid rgba(255,255,255,0.5);
            margin: 0 auto 14px; display: flex;
            align-items: center; justify-content: center;
            font-size: 28px; font-weight: 800; color: white;
        }
        .doctor-name { font-size: 17px; font-weight: 700; color: white; }
        .doctor-spec {
            font-size: 13px; color: rgba(255,255,255,0.8);
            margin-top: 4px; font-weight: 500;
        }
        .doctor-body { padding: 20px; }
        .doctor-info {
            display: flex; justify-content: space-between;
            font-size: 13px; padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .doctor-info:last-of-type { border: none; }
        .doctor-info span:first-child { color: var(--gray); }
        .doctor-info span:last-child { font-weight: 600; }
        .doctor-footer { padding: 0 20px 20px; }
        .btn-rdv {
            display: block; width: 100%; text-align: center;
            background: var(--blue); color: white;
            padding: 12px; border-radius: 10px;
            font-weight: 700; font-size: 14px; text-decoration: none;
            transition: all 0.2s;
        }
        .btn-rdv:hover { background: var(--blue-dark); transform: translateY(-1px); }

        /* ===== CTA ===== */
        .cta-section {
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, var(--blue-dark), var(--blue));
            text-align: center;
        }
        .cta-section::before {
            content: ''; position: absolute;
            width: 400px; height: 400px; border-radius: 50%;
            background: rgba(255,255,255,0.05);
            top: -100px; right: -100px;
        }
        .cta-section::after {
            content: ''; position: absolute;
            width: 300px; height: 300px; border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: -80px; left: -80px;
        }
        .cta-inner { position: relative; z-index: 1; max-width: 700px; margin: 0 auto; }
        .cta-section h2 { font-size: 38px; font-weight: 800; color: white; margin-bottom: 16px; }
        .cta-section p { font-size: 17px; color: rgba(255,255,255,0.85); margin-bottom: 36px; line-height: 1.7; }
        .cta-buttons { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
        .btn-cta-white {
            background: white; color: var(--blue);
            padding: 15px 36px; border-radius: 10px;
            font-weight: 700; font-size: 15px; text-decoration: none;
            transition: all 0.2s; box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .btn-cta-white:hover { transform: translateY(-2px); }
        .btn-cta-outline {
            border: 2px solid rgba(255,255,255,0.6); color: white;
            padding: 13px 36px; border-radius: 10px;
            font-weight: 600; font-size: 15px; text-decoration: none;
            transition: all 0.2s;
        }
        .btn-cta-outline:hover { border-color: white; background: rgba(255,255,255,0.1); }

        /* ===== FOOTER ===== */
        footer {
            background: var(--dark); color: rgba(255,255,255,0.6);
            padding: 48px 40px 24px;
        }
        .footer-grid {
            max-width: 1100px; margin: 0 auto;
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px; margin-bottom: 40px;
        }
        .footer-brand .logo-text { color: white; font-size: 22px; }
        .footer-brand p { font-size: 14px; margin-top: 12px; line-height: 1.7; }
        .footer-col h4 { color: white; font-size: 14px; font-weight: 700; margin-bottom: 16px; }
        .footer-col a {
            display: block; color: rgba(255,255,255,0.6);
            text-decoration: none; font-size: 14px; margin-bottom: 10px;
            transition: color 0.2s;
        }
        .footer-col a:hover { color: white; }
        .footer-bottom {
            max-width: 1100px; margin: 0 auto;
            border-top: 1px solid rgba(255,255,255,0.08);
            padding-top: 24px; text-align: center; font-size: 13px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .navbar { padding: 0 20px; }
            .nav-links a:not(.btn-login):not(.btn-register) { display: none; }
            .slide-content { padding: 0 24px; }
            .slide-content h1 { font-size: 32px; }
            .stats-inner { grid-template-columns: repeat(2, 1fr); }
            section { padding: 52px 20px; }
            .services-grid { grid-template-columns: 1fr; }
            .about-grid { grid-template-columns: 1fr; }
            .steps-grid { grid-template-columns: repeat(2, 1fr); }
            .doctors-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .doctors-header { flex-direction: column; gap: 16px; align-items: flex-start; }
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
        <a href="#services">Services</a>
        @auth
            <a href="{{ route('dashboard') }}">Mon espace</a>
            <a href="{{ route('rendezvous.create') }}" class="btn-register">📅 Prendre RDV</a>
        @else
            <a href="{{ route('login') }}" class="btn-login">Connexion</a>
            <a href="{{ route('register') }}" class="btn-register">S'inscrire</a>
        @endauth
    </div>
</nav>

{{-- HERO SLIDER --}}
<section class="hero">
    <div class="slides" id="slides">

        <div class="slide">
            <img src="https://images.unsplash.com/photo-1551190822-a9333d879b1f?w=1600&q=80" alt="Clinique">
            <div class="slide-overlay"></div>
            <div class="slide-content">
                <span class="slide-badge">🏥 Clinique de Quartier — Dakar</span>
                <h1>Votre santé, notre priorité absolue</h1>
                <p>Consultez nos médecins spécialistes depuis chez vous. Réservation en ligne rapide et confirmation immédiate.</p>
                <div class="slide-buttons">
                    @auth
                        <a href="{{ route('rendezvous.create') }}" class="btn-slide-primary">📅 Prendre un RDV</a>
                    @else
                        <a href="{{ route('register') }}" class="btn-slide-primary">📅 Prendre un RDV</a>
                    @endauth
                    <a href="/medecins" class="btn-slide-secondary">Voir nos médecins</a>
                </div>
            </div>
        </div>

        <div class="slide">
            <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=1600&q=80" alt="Médecins">
            <div class="slide-overlay"></div>
            <div class="slide-content">
                <span class="slide-badge">👨‍⚕️ Équipe médicale qualifiée</span>
                <h1>Des spécialistes à votre service</h1>
                <p>Une équipe de médecins expérimentés dans toutes les spécialités pour prendre soin de vous et de votre famille.</p>
                <div class="slide-buttons">
                    <a href="/medecins" class="btn-slide-primary">Voir les médecins</a>
                    <a href="#services" class="btn-slide-secondary">Nos services</a>
                </div>
            </div>
        </div>

        <div class="slide">
            <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=1600&q=80" alt="Soins">
            <div class="slide-overlay"></div>
            <div class="slide-content">
                <span class="slide-badge">💊 Soins de qualité</span>
                <h1>Réservez en ligne, soignez-vous sereinement</h1>
                <p>Fini les longues files d'attente. Prenez rendez-vous en quelques clics et arrivez à l'heure exacte de votre consultation.</p>
                <div class="slide-buttons">
                    @auth
                        <a href="{{ route('rendezvous.create') }}" class="btn-slide-primary">📅 Réserver maintenant</a>
                    @else
                        <a href="{{ route('register') }}" class="btn-slide-primary">📅 Commencer</a>
                    @endauth
                    <a href="#how" class="btn-slide-secondary">Comment ça marche ?</a>
                </div>
            </div>
        </div>

    </div>

    <button class="slider-arrow prev" onclick="changeSlide(-1)">‹</button>
    <button class="slider-arrow next" onclick="changeSlide(1)">›</button>

    <div class="slider-dots">
        <button class="dot active" onclick="goToSlide(0)"></button>
        <button class="dot" onclick="goToSlide(1)"></button>
        <button class="dot" onclick="goToSlide(2)"></button>
    </div>
</section>

{{-- STATS BAR --}}
<div class="stats-bar">
    <div class="stats-inner">
        <div class="stat-item">
            <div class="stat-number">{{ \App\Models\User::where('role','medecin')->count() }}+</div>
            <div class="stat-label">Médecins disponibles</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ \App\Models\User::where('role','patient')->count() }}+</div>
            <div class="stat-label">Patients inscrits</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ \App\Models\RendezVous::count() }}+</div>
            <div class="stat-label">Rendez-vous pris</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">24/7</div>
            <div class="stat-label">Disponibilité en ligne</div>
        </div>
    </div>
</div>

{{-- SERVICES --}}
<section class="services-section" id="services">
    <div class="section-inner">
        <div class="services-header">
            <span class="section-tag">Nos services</span>
            <h2 class="section-title">Une prise en charge complète</h2>
            <p class="section-sub">Des soins de qualité pour toute la famille, avec des spécialistes expérimentés dans chaque domaine.</p>
        </div>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">🩺</div>
                <h3>Médecine générale</h3>
                <p>Consultations de routine, suivi des maladies chroniques et soins primaires pour toute la famille.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">❤️</div>
                <h3>Cardiologie</h3>
                <p>Diagnostic et traitement des maladies cardiovasculaires avec des équipements modernes.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">👶</div>
                <h3>Pédiatrie</h3>
                <p>Soins spécialisés pour les nourrissons, enfants et adolescents dans un environnement adapté.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">🦷</div>
                <h3>Dentisterie</h3>
                <p>Soins dentaires préventifs et curatifs, détartrage, extraction et soins esthétiques.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">👁️</div>
                <h3>Ophtalmologie</h3>
                <p>Examens de la vue complets, prescription de lunettes et traitement des troubles oculaires.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">🤰</div>
                <h3>Gynécologie</h3>
                <p>Suivi gynécologique, prénatal et accompagnement maternité par des spécialistes dévoués.</p>
            </div>
        </div>
    </div>
</section>

{{-- ABOUT --}}
<section class="about-section">
    <div class="section-inner">
        <div class="about-grid">
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1538108149393-fbbd81895907?w=800&q=80" alt="Notre clinique">
                <div class="about-badge">
                    <div class="about-badge-icon">⭐</div>
                    <div class="about-badge-text">
                        <div class="value">4.9/5</div>
                        <div class="label">Note de satisfaction</div>
                    </div>
                </div>
            </div>
            <div class="about-content">
                <span class="section-tag">À propos</span>
                <h2 class="section-title">Une clinique au cœur de Dakar</h2>
                <p class="section-sub">CliniqPlus est une clinique de quartier moderne dédiée à offrir des soins de santé accessibles et de qualité aux habitants de Dakar.</p>
                <div class="about-features">
                    <div class="about-feature">
                        <div class="feature-icon">🕐</div>
                        <div class="feature-text">
                            <h4>Prise de RDV 24h/24</h4>
                            <p>Réservez votre consultation à n'importe quelle heure depuis votre téléphone ou ordinateur.</p>
                        </div>
                    </div>
                    <div class="about-feature">
                        <div class="feature-icon">✅</div>
                        <div class="feature-text">
                            <h4>Confirmation immédiate</h4>
                            <p>Votre rendez-vous est confirmé instantanément. Fini les appels téléphoniques interminables.</p>
                        </div>
                    </div>
                    <div class="about-feature">
                        <div class="feature-icon">🔒</div>
                        <div class="feature-text">
                            <h4>Données sécurisées</h4>
                            <p>Vos informations médicales sont protégées et accessibles uniquement par les professionnels autorisés.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STEPS --}}
<section class="steps-section" id="how">
    <div class="section-inner">
        <div class="steps-header">
            <span class="section-tag">Comment ça marche</span>
            <h2 class="section-title">Prendre RDV en 4 étapes</h2>
            <p class="section-sub">Simple, rapide et efficace. Votre santé ne devrait pas attendre.</p>
        </div>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-number">1</div>
                <h3>Créez un compte</h3>
                <p>Inscription gratuite et rapide avec votre email et vos informations de base.</p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h3>Choisissez un médecin</h3>
                <p>Parcourez notre liste de spécialistes et choisissez celui qui correspond à votre besoin.</p>
            </div>
            <div class="step-card">
                <div class="step-number">3</div>
                <h3>Réservez un créneau</h3>
                <p>Sélectionnez la date et l'heure disponibles qui vous conviennent le mieux.</p>
            </div>
            <div class="step-card">
                <div class="step-number">4</div>
                <h3>Consultez sereinement</h3>
                <p>Arrivez à l'heure exacte de votre RDV, sans attente et sans stress.</p>
            </div>
        </div>
    </div>
</section>

{{-- DOCTORS PREVIEW --}}
@php $medecins = \App\Models\User::where('role','medecin')->take(3)->get(); @endphp
@if ($medecins->count() > 0)
<section class="doctors-section">
    <div class="section-inner">
        <div class="doctors-header">
            <div>
                <span class="section-tag">Notre équipe</span>
                <h2 class="section-title">Nos médecins</h2>
            </div>
            <a href="/medecins" style="color:var(--blue);font-weight:700;text-decoration:none;font-size:14px;">
                Voir tous les médecins →
            </a>
        </div>
        <div class="doctors-grid">
            @foreach ($medecins as $medecin)
            <div class="doctor-card">
                <div class="doctor-top">
                    <div class="doctor-avatar">{{ strtoupper(substr($medecin->name, 0, 2)) }}</div>
                    <div class="doctor-name">Dr. {{ $medecin->name }}</div>
                    <div class="doctor-spec">{{ $medecin->specialite ?? 'Médecine générale' }}</div>
                </div>
                <div class="doctor-body">
                    <div class="doctor-info">
                        <span>📞 Téléphone</span>
                        <span>{{ $medecin->telephone ?? 'N/A' }}</span>
                    </div>
                    <div class="doctor-info">
                        <span>🟢 Disponibilité</span>
                        <span style="color:#16a34a">Disponible</span>
                    </div>
                </div>
                <div class="doctor-footer">
                    @auth
                        <a href="{{ route('rendezvous.create') }}" class="btn-rdv">Prendre RDV</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-rdv">Se connecter pour RDV</a>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="cta-section">
    <div class="cta-inner">
        <h2>Prenez soin de votre santé dès aujourd'hui</h2>
        <p>Rejoignez des centaines de patients qui nous font confiance pour leurs soins médicaux à Dakar.</p>
        <div class="cta-buttons">
            @auth
                <a href="{{ route('rendezvous.create') }}" class="btn-cta-white">📅 Prendre un RDV maintenant</a>
                <a href="/medecins" class="btn-cta-outline">Voir nos médecins</a>
            @else
                <a href="{{ route('register') }}" class="btn-cta-white">📅 S'inscrire gratuitement</a>
                <a href="{{ route('login') }}" class="btn-cta-outline">Se connecter</a>
            @endauth
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer>
    <div class="footer-grid">
        <div class="footer-brand">
            <div class="navbar-logo" style="margin-bottom:12px">
                <div class="logo-icon">🏥</div>
                <div class="logo-text">Cliniq<span>Plus</span></div>
            </div>
            <p>Clinique de quartier moderne dédiée à offrir des soins de santé accessibles et de qualité aux habitants de Dakar.</p>
        </div>
        <div class="footer-col">
            <h4>Navigation</h4>
            <a href="/">Accueil</a>
            <a href="/medecins">Médecins</a>
            <a href="#services">Services</a>
        </div>
        <div class="footer-col">
            <h4>Compte</h4>
            <a href="{{ route('login') }}">Connexion</a>
            <a href="{{ route('register') }}">S'inscrire</a>
            @auth
            <a href="{{ route('dashboard') }}">Mon espace</a>
            @endauth
        </div>
        <div class="footer-col">
            <h4>Contact</h4>
            <a href="#">📍 Dakar, Sénégal</a>
            <a href="#">📞 +221 77 000 00 00</a>
            <a href="#">✉️ contact@cliniqplus.sn</a>
        </div>
    </div>
    <div class="footer-bottom">
        © {{ date('Y') }} CliniqPlus — Tous droits réservés — Dakar, Sénégal
    </div>
</footer>

{{-- SLIDER SCRIPT --}}
<script>
    let current = 0;
    const total = 3;
    let autoPlay;

    function goToSlide(index) {
        current = index;
        document.getElementById('slides').style.transform = `translateX(-${current * 100}%)`;
        document.querySelectorAll('.dot').forEach((d, i) => {
            d.classList.toggle('active', i === current);
        });
    }

    function changeSlide(dir) {
        current = (current + dir + total) % total;
        goToSlide(current);
        resetAutoPlay();
    }

    function resetAutoPlay() {
        clearInterval(autoPlay);
        autoPlay = setInterval(() => changeSlide(1), 5000);
    }

    autoPlay = setInterval(() => changeSlide(1), 5000);
</script>

</body>
</html>