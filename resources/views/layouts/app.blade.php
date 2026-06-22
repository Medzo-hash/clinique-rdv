<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>CliniqPlus — {{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .cliniq-navbar {
                background: white;
                border-bottom: 1px solid #f1f5f9;
                padding: 0 32px;
                height: 64px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                position: sticky;
                top: 0;
                z-index: 100;
                box-shadow: 0 1px 12px rgba(0,0,0,0.06);
            }
            .cliniq-logo {
                display: flex; align-items: center; gap: 10px; text-decoration: none;
            }
            .cliniq-logo-icon {
                width: 38px; height: 38px; background: #1a56db;
                border-radius: 9px; display: flex; align-items: center;
                justify-content: center; font-size: 18px;
            }
            .cliniq-logo-text {
                font-size: 18px; font-weight: 800; color: #1e3a8a;
                font-family: 'Segoe UI', sans-serif;
            }
            .cliniq-logo-text span { color: #1a56db; }
            .cliniq-nav-right {
                display: flex; align-items: center; gap: 8px;
            }
            .cliniq-nav-link {
                padding: 8px 14px; border-radius: 8px; text-decoration: none;
                font-size: 14px; font-weight: 500; color: #6b7280;
                transition: all 0.2s; font-family: 'Segoe UI', sans-serif;
            }
            .cliniq-nav-link:hover { background: #eff6ff; color: #1a56db; }
            .cliniq-nav-link.active { background: #eff6ff; color: #1a56db; font-weight: 600; }
            .cliniq-dropdown {
                position: relative;
            }
            .cliniq-dropdown-btn {
                display: flex; align-items: center; gap: 8px;
                padding: 8px 14px; border-radius: 8px; cursor: pointer;
                background: #f8fafc; border: 1px solid #e2e8f0;
                font-size: 14px; font-weight: 600; color: #0f172a;
                font-family: 'Segoe UI', sans-serif;
            }
            .cliniq-avatar {
                width: 30px; height: 30px; border-radius: 50%;
                background: #1a56db; color: white;
                display: flex; align-items: center; justify-content: center;
                font-size: 12px; font-weight: 700;
            }
            .cliniq-dropdown-menu {
                position: absolute; right: 0; top: calc(100% + 8px);
                background: white; border-radius: 12px; min-width: 200px;
                box-shadow: 0 8px 30px rgba(0,0,0,0.12);
                border: 1px solid #f1f5f9; overflow: hidden;
                display: none; z-index: 200;
            }
            .cliniq-dropdown-menu.open { display: block; }
            .cliniq-dropdown-header {
                padding: 14px 16px; border-bottom: 1px solid #f1f5f9;
                background: #f8fafc;
            }
            .cliniq-dropdown-header .name { font-size: 14px; font-weight: 700; color: #0f172a; }
            .cliniq-dropdown-header .email { font-size: 12px; color: #6b7280; margin-top: 2px; }
            .cliniq-dropdown-item {
                display: block; padding: 11px 16px; text-decoration: none;
                font-size: 14px; color: #374151; transition: background 0.15s;
                font-family: 'Segoe UI', sans-serif;
            }
            .cliniq-dropdown-item:hover { background: #f8fafc; color: #1a56db; }
            .cliniq-dropdown-item.danger { color: #dc2626; }
            .cliniq-dropdown-item.danger:hover { background: #fef2f2; }
            .cliniq-dropdown-divider { border-top: 1px solid #f1f5f9; }
            .cliniq-content { background: #f8fafc; min-height: calc(100vh - 64px); }
            .cliniq-role-badge {
                padding: 4px 10px; border-radius: 20px;
                font-size: 11px; font-weight: 700;
                font-family: 'Segoe UI', sans-serif;
            }
            .role-admin { background: #fef3c7; color: #b45309; }
            .role-medecin { background: #dcfce7; color: #15803d; }
            .role-patient { background: #eff6ff; color: #1a56db; }
        </style>
    </head>
    <body class="font-sans antialiased">

        {{-- NAVBAR CLINIQPLUS --}}
        <nav class="cliniq-navbar">
            <a href="/" class="cliniq-logo">
                <div class="cliniq-logo-icon">🏥</div>
                <div class="cliniq-logo-text">Cliniq<span>Plus</span></div>
            </a>

            <div class="cliniq-nav-right">
                <a href="{{ route('dashboard') }}" class="cliniq-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    🏠 Accueil
                </a>
                <a href="{{ route('rendezvous.index') }}" class="cliniq-nav-link {{ request()->routeIs('rendezvous.*') ? 'active' : '' }}">
                    📅 Rendez-vous
                </a>
                <a href="/medecins" class="cliniq-nav-link">
                    👨‍⚕️ Médecins
                </a>
                @if (Auth::user()->isAdmin())
                    <a href="{{ route('admin.medecins.index') }}" class="cliniq-nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                        ⚙️ Admin
                    </a>
                @endif

                <span class="cliniq-role-badge {{ Auth::user()->isAdmin() ? 'role-admin' : (Auth::user()->isMedecin() ? 'role-medecin' : 'role-patient') }}">
                    {{ Auth::user()->isAdmin() ? '👑 Admin' : (Auth::user()->isMedecin() ? '👨‍⚕️ Médecin' : '👤 Patient') }}
                </span>

                <div class="cliniq-dropdown" id="userDropdown">
                    <div class="cliniq-dropdown-btn" onclick="toggleDropdown()">
                        <div class="cliniq-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                        {{ Auth::user()->name }}
                        <span>▾</span>
                    </div>
                    <div class="cliniq-dropdown-menu" id="dropdownMenu">
                        <div class="cliniq-dropdown-header">
                            <div class="name">{{ Auth::user()->name }}</div>
                            <div class="email">{{ Auth::user()->email }}</div>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="cliniq-dropdown-item">👤 Mon profil</a>
                        @if (Auth::user()->isPatient())
                            <a href="{{ route('rendezvous.create') }}" class="cliniq-dropdown-item">📅 Prendre RDV</a>
                        @endif
                        <div class="cliniq-dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="cliniq-dropdown-item danger" style="width:100%;text-align:left;border:none;background:none;cursor:pointer;">
                                🚪 Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        {{-- CONTENT --}}
        <div class="cliniq-content">
            {{ $slot }}
        </div>

        <script>
            function toggleDropdown() {
                document.getElementById('dropdownMenu').classList.toggle('open');
            }
            document.addEventListener('click', function(e) {
                const dropdown = document.getElementById('userDropdown');
                if (!dropdown.contains(e.target)) {
                    document.getElementById('dropdownMenu').classList.remove('open');
                }
            });
        </script>
    </body>
</html>