<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frozeria - Stok Opname</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F9FAFB;
        }

        [x-cloak] {
            display: none !important;
        }

        .nav-link {
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .nav-link-active {
            color: #EA580C;
            border-bottom: 2px solid #EA580C;
            padding-bottom: 4px;
        }

        .nav-link-inactive {
            color: #6B7280;
        }

        .nav-link-inactive:hover {
            color: #111827;
        }
    </style>
</head>

<body style="margin: 0; padding: 0;">
    <!-- Manual Fixed Navbar -->
    <nav style="position: fixed; top: 0; left: 0; right: 0; height: 80px; background: white; border-bottom: 1px solid #E5E7EB; z-index: 1000; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);">
        <div style="max-width: 1280px; margin: 0 auto; padding: 0 32px; height: 100%; display: flex; justify-content: space-between; align-items: center;">
            <!-- Brand -->
            <div style="display: flex; align-items: center;">
                <a href="{{ route('dashboard') }}" style="text-decoration: none; color: black; font-size: 24px; font-weight: 900; letter-spacing: -1px;">
                    FROZERIA<span style="color: #EA580C;">.</span>
                </a>
            </div>

            <!-- Navigation (Manual Spacing) -->
            <div style="display: flex; align-items: center;">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') || request()->routeIs('items.*') ? 'nav-link-active' : 'nav-link-inactive' }}">
                    Dashboard
                </a>
                <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'nav-link-active' : 'nav-link-inactive' }}" style="margin-left: 48px;">
                    Kategori
                </a>
                <a href="{{ route('help') }}" class="nav-link {{ request()->routeIs('help') ? 'nav-link-active' : 'nav-link-inactive' }}" style="margin-left: 48px;">
                    Bantuan
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <main style="padding-top: 120px; padding-bottom: 80px; padding-left: 32px; padding-right: 32px;">
        <div style="max-width: 1280px; margin: 0 auto;">
            @yield('content')
        </div>
    </main>

    <!-- Success Toast -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        style="position: fixed; bottom: 32px; right: 32px; background: #111827; color: white; padding: 16px 24px; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); font-weight: 700; z-index: 1001;">
        {{ session('success') }}
    </div>
    @endif
</body>

</html>