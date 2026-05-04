{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleetManager — @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
            background: #f1f5f9; 
            color: #334155;
        }
        
        /* Modern Sidebar */
        .sidebar {
            height: 100vh;
            background: #ffffff;
            width: 280px;
            position: fixed;
            top: 0; left: 0;
            padding: 1.5rem 1.25rem;
            box-shadow: 4px 0 24px rgba(15, 23, 42, 0.04);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #e2e8f0;
            overflow-y: auto;
        }
        .sidebar .brand {
            color: #0f172a;
            font-size: 1.35rem;
            font-weight: 700;
            padding: 0.5rem 0.5rem 2.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .sidebar .brand .brand-icon {
            background: linear-gradient(135deg, #0ea5e9 0%, #4f46e5 100%);
            color: white;
            width: 42px; height: 42px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }
        .sidebar .nav-section {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94a3b8;
            font-weight: 700;
            margin: 1.5rem 1rem 0.75rem;
        }
        .sidebar .nav-link {
            color: #64748b;
            padding: 0.85rem 1.25rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            margin-bottom: 0.35rem;
        }
        .sidebar .nav-link i { 
            margin-right: 14px; 
            font-size: 1.2rem;
            transition: all 0.3s ease;
            color: #94a3b8;
        }
        .sidebar .nav-link:hover {
            color: #0f172a;
            background: #f8fafc;
            transform: translateX(4px);
        }
        .sidebar .nav-link:hover i {
            color: #0ea5e9;
        }
        .sidebar .nav-link.active {
            color: white;
            background: linear-gradient(135deg, #0ea5e9 0%, #4f46e5 100%);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
            font-weight: 600;
        }
        .sidebar .nav-link.active i { color: white; }
        
        .main-content { 
            margin-left: 280px; 
            padding: 2.5rem; 
            min-height: 100vh; 
        }
        
        /* Modern Alerts */
        .alert-modern {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            font-weight: 500;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
        }
        .alert-success-modern {
            background: #ecfdf5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }
        
        /* Legacy Overrides for un-modernized pages */
        .page-header {
            background: #fff;
            border-radius: 16px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .card { border: 1px solid rgba(226, 232, 240, 0.8); border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .table th { font-size: .8rem; text-transform: uppercase; letter-spacing: .05em; color: #64748b; font-weight: 600; }
    </style>
    @yield('styles')
</head>
<body>

{{-- Sidebar --}}
<div class="sidebar">
    <a href="{{ route('dashboard') }}" class="brand">
        <div class="brand-icon">
            <i class="bi bi-truck-front-fill"></i>
        </div>
        <span>FleetManager</span>
    </a>
    
    <nav class="nav flex-column flex-grow-1">
        <div class="nav-section">Principal</div>
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Tableau de bord
        </a>
        
        <div class="nav-section">Flotte</div>
        <a href="{{ route('trucks.index') }}" class="nav-link {{ request()->routeIs('trucks.*') ? 'active' : '' }}">
            <i class="bi bi-truck"></i> Camions
        </a>
        <a href="{{ route('drivers.index') }}" class="nav-link {{ request()->routeIs('drivers.*') ? 'active' : '' }}">
            <i class="bi bi-person-vcard"></i> Chauffeurs
        </a>
        
        <div class="nav-section">Opérations</div>
        <a href="{{ route('deliveries.index') }}" class="nav-link {{ request()->routeIs('deliveries.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Livraisons
        </a>
        <a href="{{ route('maintenances.index') }}" class="nav-link {{ request()->routeIs('maintenances.*') ? 'active' : '' }}">
            <i class="bi bi-tools"></i> Maintenance
        </a>
        <a href="{{ route('fuels.index') }}" class="nav-link {{ request()->routeIs('fuels.*') ? 'active' : '' }}">
            <i class="bi bi-fuel-pump"></i> Carburant
        </a>
    </nav>
    
    @auth
    <div class="border-top pt-4 mt-4">
        <div class="d-flex align-items-center gap-3 px-2 mb-3">
            <div class="bg-light text-primary d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; border-radius: 12px; border: 1px solid #cbd5e1;">
                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <div class="fw-bold text-dark text-truncate" style="font-size: 0.9rem;">{{ Auth::user()->name }}</div>
                <div class="text-muted text-truncate" style="font-size: 0.75rem;">{{ Auth::user()->email }}</div>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link w-100 text-start text-danger" style="background: none; border: none; padding: 0.85rem 1.25rem; border-radius: 12px; font-weight: 600;">
                <i class="bi bi-box-arrow-right text-danger"></i> Se déconnecter
            </button>
        </form>
    </div>
    @endauth
</div>

{{-- Content --}}
<div class="main-content">
    @if(session('success'))
        <div class="alert alert-modern alert-success-modern alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>