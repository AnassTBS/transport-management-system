{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleetManager — @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f5f6fa; }
        .sidebar {
            min-height: 100vh;
            background: #1a1f2e;
            width: 240px;
            position: fixed;
            top: 0; left: 0;
            padding: 1.5rem 0;
        }
        .sidebar .brand {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 600;
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,.1);
            margin-bottom: 1rem;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.6);
            padding: .6rem 1.5rem;
            border-radius: 0;
            transition: all .2s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,.08);
            border-left: 3px solid #4e8ef7;
        }
        .sidebar .nav-link i { margin-right: 8px; }
        .main-content { margin-left: 240px; padding: 2rem; }
        .page-header {
            background: #fff;
            border-radius: 10px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
        }
        .card { border: 1px solid #e9ecef; border-radius: 10px; }
        .table th { font-size: .8rem; text-transform: uppercase;
                    letter-spacing: .05em; color: #6c757d; }
        .badge-disponible  { background: #d1fae5; color: #065f46; }
        .badge-en_route    { background: #dbeafe; color: #1e40af; }
        .badge-en_maint    { background: #fef3c7; color: #92400e; }
        .badge-en_cours    { background: #dbeafe; color: #1e40af; }
        .badge-livree      { background: #d1fae5; color: #065f46; }
        .badge-annulee     { background: #fee2e2; color: #991b1b; }
    </style>
    @yield('styles')
</head>
<body>

{{-- Sidebar --}}
<div class="sidebar">
    <div class="brand">
        <i class="bi bi-truck"></i> FleetManager
    </div>
    <nav class="nav flex-column">
        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('trucks.index') }}"
           class="nav-link {{ request()->routeIs('trucks.*') ? 'active' : '' }}">
            <i class="bi bi-truck"></i> Camions
        </a>
        <a href="{{ route('drivers.index') }}"
           class="nav-link {{ request()->routeIs('drivers.*') ? 'active' : '' }}">
            <i class="bi bi-person-badge"></i> Chauffeurs
        </a>
        <a href="{{ route('deliveries.index') }}"
           class="nav-link {{ request()->routeIs('deliveries.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Livraisons
        </a>
        <a href="{{ route('maintenances.index') }}"
           class="nav-link {{ request()->routeIs('maintenances.*') ? 'active' : '' }}">
            <i class="bi bi-tools"></i> Maintenance
        </a>
        <a href="{{ route('fuels.index') }}"
           class="nav-link {{ request()->routeIs('fuels.*') ? 'active' : '' }}">
            <i class="bi bi-fuel-pump"></i> Carburant
        </a>
    </nav>
</div>

{{-- Content --}}
<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>