<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GestionResto - {{ request()->routeIs('login') ? 'Connexion' : 'Inscription' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #2c3e50 100%);
            min-height: 100vh;
            font-family: 'Figtree', sans-serif;
        }
        .auth-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,.3);
            padding: 2rem;
        }
        .auth-logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .auth-logo h4 {
            font-family: 'Figtree', serif;
            font-weight: 700;
            color: #c0392b;
            margin-top: 8px;
        }
        .auth-logo small {
            color: #d35400;
            font-size: .75rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="min-h-screen d-flex flex-column justify-content-center align-items-center py-5 px-3">
        <div class="auth-logo">
            <svg width="56" height="56" viewBox="0 0 100 100" fill="none">
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
            <h4>GestionResto</h4>
            <small>Restaurant Management</small>
        </div>

        <div class="w-100" style="max-width: 440px;">
            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>

        <p class="mt-4 text-white-50 small" style="color: rgba(255,255,255,.5) !important;">
            &copy; {{ date('Y') }} GestionResto. Tous droits r&#233;serv&#233;s.
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
