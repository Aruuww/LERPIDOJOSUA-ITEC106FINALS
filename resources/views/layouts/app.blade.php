<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Porsche Records') — PRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --porsche-red: #D5001C;
            --porsche-dark: #1a1a1a;
            --porsche-light: #f5f5f5;
            --porsche-gold: #c9a84c;
            --sidebar-width: 240px;
        }

        body { background: var(--porsche-light); font-family: 'Segoe UI', sans-serif; margin: 0; }

        /* ── Sidebar ── */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--porsche-dark);
            position: fixed;
            top: 0; left: 0;
            z-index: 1045;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }
        .sidebar-brand {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid #333;
            flex-shrink: 0;
        }
        .sidebar-brand .brand-name {
            font-size: 1.3rem; font-weight: 700;
            color: #fff; letter-spacing: 2px; text-transform: uppercase;
        }
        .sidebar-brand .brand-sub {
            font-size: 0.65rem; color: var(--porsche-gold);
            letter-spacing: 3px; text-transform: uppercase;
        }
        .porsche-crest { margin-bottom: 0.5rem; }
        .nav-section-label {
            font-size: 0.6rem; letter-spacing: 2px;
            text-transform: uppercase; color: #666;
            padding: 1rem 1.25rem 0.25rem;
        }
        #sidebar .nav-link {
            color: #aaa; padding: 0.6rem 1.25rem;
            border-radius: 0; font-size: 0.875rem;
            display: flex; align-items: center; gap: 0.6rem;
            transition: all 0.2s; border-left: 3px solid transparent;
            white-space: nowrap;
        }
        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            color: #fff; background: rgba(255,255,255,0.05);
            border-left-color: var(--porsche-red);
        }
        #sidebar .nav-link i { font-size: 1rem; width: 18px; flex-shrink: 0; }
        .sidebar-footer {
            margin-top: auto; padding: 1rem 1.25rem;
            border-top: 1px solid #333; flex-shrink: 0;
        }
        .sidebar-user-name { color: #fff; font-size: 0.8rem; font-weight: 600; }
        .sidebar-user-email { color: #666; font-size: 0.7rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 140px; }
        .avatar-sm {
            width: 32px; height: 32px; border-radius: 50%;
            object-fit: cover; border: 2px solid var(--porsche-red); flex-shrink: 0;
        }
        .avatar-placeholder {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--porsche-red);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 0.8rem;
            border: 2px solid var(--porsche-red); flex-shrink: 0;
        }

        /* ── Overlay (mobile) ── */
        #sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1044;
        }
        #sidebar-overlay.show { display: block; }

        /* ── Main content ── */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        .topbar {
            background: #fff; border-bottom: 1px solid #e0e0e0;
            padding: 0.75rem 1.25rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 99;
        }
        .topbar-title { font-weight: 700; font-size: 1.05rem; color: var(--porsche-dark); }
        .page-body { padding: 1.25rem; }

        /* ── Stat cards ── */
        .stat-card {
            background: #fff; border-radius: 8px; border: none;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08); padding: 1.25rem;
            height: 100%;
        }
        .stat-card .stat-icon {
            width: 48px; height: 48px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center; font-size: 1.4rem;
        }
        .stat-card .stat-value { font-size: 1.8rem; font-weight: 700; color: var(--porsche-dark); }
        .stat-card .stat-label { font-size: 0.75rem; color: #888; text-transform: uppercase; letter-spacing: 1px; }

        /* ── Cards / Tables ── */
        .card { border: none; box-shadow: 0 1px 4px rgba(0,0,0,0.08); border-radius: 8px; }
        .card-header {
            background: #fff; border-bottom: 1px solid #f0f0f0;
            font-weight: 600; font-size: 0.9rem; padding: 1rem 1.25rem;
            border-radius: 8px 8px 0 0 !important;
        }
        .table th {
            font-size: 0.7rem; text-transform: uppercase;
            letter-spacing: 1px; color: #888;
            border-bottom: 2px solid #f0f0f0; font-weight: 600;
        }
        .table td { font-size: 0.875rem; vertical-align: middle; }

        /* ── Buttons ── */
        .btn-porsche {
            background: var(--porsche-red); color: #fff; border: none;
            font-size: 0.8rem; font-weight: 600; letter-spacing: 0.5px;
        }
        .btn-porsche:hover { background: #b0001a; color: #fff; }

        /* ── Auth ── */
        .auth-wrapper {
            min-height: 100vh; background: var(--porsche-dark);
            display: flex; align-items: center; justify-content: center;
            padding: 1rem;
        }
        .auth-card {
            background: #fff; border-radius: 12px; padding: 2.5rem;
            width: 100%; max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        }
        .auth-logo { text-align: center; margin-bottom: 1.5rem; }
        .auth-logo .crest {
            width: 56px; height: 56px; background: var(--porsche-red);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; font-weight: 900; color: #fff; margin: 0 auto 0.75rem;
        }
        .auth-logo h4 { font-weight: 800; letter-spacing: 3px; text-transform: uppercase; margin: 0; }
        .auth-logo small { color: #888; font-size: 0.7rem; letter-spacing: 2px; text-transform: uppercase; }
        .form-control:focus, .form-select:focus {
            border-color: var(--porsche-red);
            box-shadow: 0 0 0 0.2rem rgba(213,0,28,0.15);
        }
        .form-label { font-size: 0.8rem; font-weight: 600; color: #555; text-transform: uppercase; letter-spacing: 0.5px; }

        /* ── Toast ── */
        .toast-container { z-index: 9999; }

        /* ── Responsive breakpoints ── */
        @media (max-width: 991.98px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #main-content { margin-left: 0; }
        }

        @media (max-width: 575.98px) {
            .auth-card { padding: 1.75rem 1.25rem; }
            .page-body { padding: 0.75rem; }
            .stat-card .stat-value { font-size: 1.4rem; }
            .topbar { padding: 0.6rem 0.75rem; }
        }
    </style>
    @stack('styles')
</head>
@php use Illuminate\Support\Facades\Storage; @endphp
<body>

@auth
{{-- Sidebar overlay for mobile --}}
<div id="sidebar-overlay" onclick="closeSidebar()"></div>

<div id="sidebar">
    <div class="sidebar-brand">
        <div class="porsche-crest">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 110" width="42" height="42">
                <path d="M50 4 L88 18 L88 58 Q88 84 50 98 Q12 84 12 58 L12 18 Z" fill="#1a1a1a" stroke="#c9a84c" stroke-width="2.5"/>
                <path d="M50 4 L12 18 L12 54 L50 54 Z" fill="#D5001C"/>
                <path d="M50 4 L88 18 L88 54 L50 54 Z" fill="#D5001C"/>
                <path d="M12 54 L12 58 Q12 70 22 78 L22 54 Z" fill="#1a1a1a"/>
                <path d="M88 54 L88 58 Q88 70 78 78 L78 54 Z" fill="#1a1a1a"/>
                <line x1="50" y1="4" x2="50" y2="98" stroke="#c9a84c" stroke-width="1.5"/>
                <line x1="12" y1="54" x2="88" y2="54" stroke="#c9a84c" stroke-width="1.5"/>
                <ellipse cx="50" cy="33" rx="9" ry="12" fill="#c9a84c"/>
                <ellipse cx="55" cy="23" rx="4" ry="5" fill="#c9a84c" transform="rotate(-15,55,23)"/>
                <rect x="44" y="43" width="2.5" height="7" rx="1" fill="#c9a84c"/>
                <rect x="48" y="43" width="2.5" height="8" rx="1" fill="#c9a84c"/>
                <rect x="52" y="43" width="2.5" height="7" rx="1" fill="#c9a84c"/>
                <path d="M53 21 Q59 13 57 9" stroke="#c9a84c" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                <path d="M55 19 Q62 15 61 11" stroke="#c9a84c" stroke-width="1.4" fill="none" stroke-linecap="round"/>
            </svg>
        </div>
        <div class="brand-name">Porsche</div>
        <div class="brand-sub">Records System</div>
    </div>

    <div class="nav-section-label">Main</div>
    <nav class="nav flex-column">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </nav>

    <div class="nav-section-label">Management</div>
    <nav class="nav flex-column">
        <a href="{{ route('vehicles.index') }}" class="nav-link {{ request()->routeIs('vehicles.*') ? 'active' : '' }}">
            <i class="bi bi-car-front"></i> My Vehicles
        </a>
        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Users
        </a>
    </nav>

    <div class="nav-section-label">Account</div>
    <nav class="nav flex-column">
        <a href="{{ route('profile.show') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> Profile
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="d-flex align-items-center gap-2">
            @if(auth()->user()->profile_picture)
                <img src="{{ Storage::url(auth()->user()->profile_picture) }}" class="avatar-sm" alt="avatar">
            @else
                <div class="avatar-placeholder">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            @endif
            <div style="min-width:0;">
                <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                <div class="sidebar-user-email">{{ auth()->user()->email }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button class="btn btn-sm w-100 text-start text-danger p-0 bg-transparent border-0" style="font-size:0.8rem;">
                <i class="bi bi-box-arrow-left"></i> Sign Out
            </button>
        </form>
    </div>
</div>

<div id="main-content">
    <div class="topbar">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm border-0 d-lg-none p-1" onclick="openSidebar()" aria-label="Toggle menu">
                <i class="bi bi-list fs-4"></i>
            </button>
            <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('profile.show') }}" class="text-decoration-none d-flex align-items-center gap-2">
                @if(auth()->user()->profile_picture)
                    <img src="{{ Storage::url(auth()->user()->profile_picture) }}" class="avatar-sm" alt="avatar">
                @else
                    <div class="avatar-placeholder" style="width:28px;height:28px;font-size:0.75rem;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <span class="d-none d-sm-inline text-dark" style="font-size:0.85rem;font-weight:600;">{{ auth()->user()->name }}</span>
            </a>
        </div>
    </div>
    <div class="page-body">
        @yield('content')
    </div>
</div>
@endauth

@guest
    @yield('content')
@endguest

<!-- Toast Notifications -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    @if(session('toast_success'))
    <div class="toast align-items-center text-bg-success border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body"><i class="bi bi-check-circle me-2"></i>{{ session('toast_success') }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif
    @if(session('toast_error'))
    <div class="toast align-items-center text-bg-danger border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body"><i class="bi bi-exclamation-circle me-2"></i>{{ session('toast_error') }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
<script>
    function openSidebar() {
        document.getElementById('sidebar').classList.add('show');
        document.getElementById('sidebar-overlay').classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('show');
        document.getElementById('sidebar-overlay').classList.remove('show');
        document.body.style.overflow = '';
    }
    // Close sidebar on nav link click (mobile)
    document.querySelectorAll('#sidebar .nav-link').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 992) closeSidebar();
        });
    });
    // Auto-hide toasts after 4s
    document.querySelectorAll('.toast').forEach(t => {
        setTimeout(() => new bootstrap.Toast(t, { delay: 4000 }).hide(), 100);
    });
</script>
</body>
</html>
