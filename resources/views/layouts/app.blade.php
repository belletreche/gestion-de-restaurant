<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GestionResto - {{ trim($__env->yieldContent('page-title', 'Dashboard')) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #c0392b;
            --primary-dark: #a93226;
            --secondary: #d35400;
            --accent: #f39c12;
            --dark: #1a1a2e;
            --darker: #16213e;
            --gold: #d4a017;
            --cream: #fdf5e6;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            overflow-x: hidden;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 260px;
            background: linear-gradient(180deg, var(--dark) 0%, var(--darker) 100%);
            z-index: 1000;
            transition: transform .3s;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-brand h4 {
            font-family: 'Playfair Display', serif;
            color: #fff;
            font-weight: 700;
            margin: 0;
        }
        .sidebar-brand h4 i { color: var(--accent); margin-right: 8px; }
        .sidebar-brand small { color: var(--accent); font-size: .7rem; letter-spacing: 2px; text-transform: uppercase; }
        .sidebar .nav-item { margin: 2px 10px; }
        .sidebar .nav-link {
            color: rgba(255,255,255,.6);
            padding: 10px 16px;
            border-radius: 10px;
            font-size: .9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all .2s;
        }
        .sidebar .nav-link:hover { background: rgba(255,255,255,.08); color: #fff; }
        .sidebar .nav-link.active { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; box-shadow: 0 4px 15px rgba(192,57,43,.3); }
        .sidebar .nav-link i { font-size: 1.1rem; width: 22px; text-align: center; }
        .main-content { margin-left: 260px; min-height: 100vh; }
        .topbar {
            background: #fff;
            padding: 12px 28px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .topbar-left { display: flex; align-items: center; gap: 16px; }
        .topbar-left h5 { margin: 0; font-weight: 600; color: var(--dark); }
        .btn-toggle-sidebar {
            background: none; border: none; font-size: 1.3rem;
            color: #6c757d; cursor: pointer; display: none;
        }
        .topbar-user { display: flex; align-items: center; gap: 12px; }
        .topbar-user .avatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff; display: flex; align-items: center; justify-content: center;
            font-weight: 600; font-size: .9rem;
        }
        .page-content { padding: 24px 28px; }
        .page-header { margin-bottom: 24px; }
        .page-header h4 { font-weight: 700; color: var(--dark); margin: 0; }
        .page-header p { color: #6c757d; margin: 4px 0 0; font-size: .9rem; }
        .stat-card {
            border: none; border-radius: 16px; overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,.1); }
        .stat-card .card-body { padding: 24px; }
        .stat-card .stat-icon {
            width: 54px; height: 54px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem;
        }
        .stat-card .stat-number { font-size: 2rem; font-weight: 700; margin: 8px 0 2px; }
        .stat-card .stat-label { font-size: .85rem; opacity: .85; margin: 0; }
        .card-custom {
            border: none; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,.06);
        }
        .card-custom .card-header {
            background: transparent; border-bottom: 1px solid #e9ecef;
            padding: 16px 24px; font-weight: 600;
        }
        .card-custom .card-body { padding: 0; }
        .card-custom .table { margin: 0; }
        .card-custom .table th { border-top: none; background: #f8f9fa; color: #495057; font-weight: 600; font-size: .8rem; text-transform: uppercase; letter-spacing: .5px; padding: 12px 16px; }
        .card-custom .table td { padding: 12px 16px; vertical-align: middle; border-color: #f0f0f0; }
        .card-custom .table tr:hover { background: #fafafa; }
        .card-custom .card-footer {
            background: transparent; border-top: 1px solid #e9ecef; padding: 12px 24px;
        }
        .badge-cat {
            background: rgba(212,160,23,.12); color: #b8860b; padding: 4px 12px;
            border-radius: 20px; font-weight: 500; font-size: .75rem;
        }
        .btn-action { border-radius: 8px; padding: 4px 12px; font-size: .8rem; font-weight: 500; }
        .dish-img {
            width: 52px; height: 52px; border-radius: 12px; object-fit: cover;
            border: 2px solid #fff; box-shadow: 0 2px 8px rgba(0,0,0,.08);
        }
        .alert-flash {
            border: none; border-radius: 12px; padding: 14px 20px;
        }
        .pagination { margin: 0; }
        .pagination .page-link {
            border: none; border-radius: 8px !important; margin: 0 2px;
            color: #495057; font-weight: 500; padding: 6px 14px;
        }
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 4px 12px rgba(192,57,43,.3);
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .btn-toggle-sidebar { display: block; }
            .page-content { padding: 16px; }
        }
        .welcome-section {
            background: linear-gradient(135deg, var(--dark), #2c3e50);
            border-radius: 20px; padding: 36px; color: #fff; margin-bottom: 28px;
            position: relative; overflow: hidden;
        }
        .welcome-section::before {
            content: ''; position: absolute; top: -50%; right: -20%;
            width: 400px; height: 400px; border-radius: 50%;
            background: rgba(192,57,43,.15);
        }
        .welcome-section::after {
            content: ''; position: absolute; bottom: -30%; right: 10%;
            width: 250px; height: 250px; border-radius: 50%;
            background: rgba(212,160,23,.1);
        }
        .welcome-section h3 { font-weight: 700; position: relative; }
        .welcome-section p { opacity: .8; position: relative; }
        .welcome-section .chef-icon {
            position: absolute; right: 40px; top: 50%; transform: translateY(-50%);
            font-size: 5rem; opacity: .1;
        }
        .form-custom { border-radius: 10px; border: 1px solid #e0e0e0; padding: 10px 14px; font-size: .9rem; }
        .form-custom:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(192,57,43,.12); }
        .modal-content-custom { border-radius: 16px; border: none; }
        .modal-header-custom { background: linear-gradient(135deg, var(--dark), var(--darker)); color: #fff; border-radius: 16px 16px 0 0; }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand text-center">
            <div class="mb-1">
                <svg width="42" height="42" viewBox="0 0 100 100" fill="none">
                    <circle cx="50" cy="50" r="46" fill="#c0392b" stroke="#f39c12" stroke-width="3"/>
                    <path d="M32 60 L50 72 L68 60" stroke="#f39c12" stroke-width="3" fill="none" stroke-linecap="round"/>
                    <path d="M28 48 C28 35, 40 25, 50 25 C60 25, 72 35, 72 48" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round"/>
                    <circle cx="42" cy="42" r="3" fill="#f39c12"/>
                    <circle cx="58" cy="42" r="3" fill="#f39c12"/>
                    <path d="M35 55 L50 65 L65 55" stroke="#fff" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                    <line x1="50" y1="25" x2="50" y2="18" stroke="#f39c12" stroke-width="3" stroke-linecap="round"/>
                    <line x1="42" y1="20" x2="44" y2="26" stroke="#f39c12" stroke-width="2" stroke-linecap="round"/>
                    <line x1="58" y1="20" x2="56" y2="26" stroke="#f39c12" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <h4 class="fs-5">GestionResto</h4>
            <small>Restaurant Management</small>
        </div>
        <ul class="nav flex-column pt-3">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                    <i class="bi bi-list-ul"></i> Catégories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('plats.*') ? 'active' : '' }}" href="{{ route('plats.index') }}">
                    <i class="bi bi-egg-fried"></i> Plats
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('commandes.*') ? 'active' : '' }}" href="{{ route('commandes.index') }}">
                    <i class="bi bi-cart-check-fill"></i> Commandes
                </a>
            </li>
            <li class="nav-item mt-4">
                <hr style="border-color: rgba(255,255,255,.08); margin: 0 10px;">
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link" href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-circle"></i> Profile
                </a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link w-100 text-start" style="border: none; background: none;">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-left">
                <button class="btn-toggle-sidebar" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list"></i>
                </button>
                <h5>@yield('page-title', 'Dashboard')</h5>
            </div>
            <div class="topbar-user">
                <span class="d-none d-sm-inline text-muted" style="font-size:.9rem;">{{ Auth::user()->name }}</span>
                <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
            </div>
        </div>

        <div class="page-content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show alert-flash mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            {{ $slot }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !e.target.closest('.btn-toggle-sidebar')) {
                sidebar.classList.remove('show');
            }
        });
    </script>
</body>
</html>
