{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    /* Global Overrides */
    body {
        font-family: 'Outfit', sans-serif;
        background-color: #f8fafc;
    }
    
    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }

    /* Beautiful Hero */
    .dashboard-hero {
        position: relative;
        border-radius: 28px;
        background: linear-gradient(135deg, #0ea5e9 0%, #4f46e5 100%);
        color: white;
        padding: 3rem;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(79, 70, 229, 0.25);
    }
    .dashboard-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('data:image/svg+xml;utf8,<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.15)"/></svg>') repeat;
        opacity: 0.8;
    }
    .dashboard-hero::after {
        content: '';
        position: absolute;
        bottom: -50%; right: -10%;
        width: 50%; height: 100%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    .dashboard-hero .hero-content {
        position: relative;
        z-index: 2;
    }
    .dashboard-hero h1 {
        font-weight: 700;
        letter-spacing: -0.02em;
        font-size: 2.5rem;
    }

    /* Glassy Stat Cards */
    .stat-card {
        background: white;
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 1.75rem;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 160px;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
        border-color: rgba(14, 165, 233, 0.3);
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; height: 4px;
        background: linear-gradient(90deg, #0ea5e9, #4f46e5);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .icon-wrapper {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .icon-blue { background: rgba(14, 165, 233, 0.1); color: #0ea5e9; }
    .icon-indigo { background: rgba(79, 70, 229, 0.1); color: #4f46e5; }
    .icon-rose { background: rgba(244, 63, 94, 0.1); color: #f43f5e; }
    .icon-amber { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }

    .stat-card:hover .icon-wrapper {
        transform: scale(1.1) rotate(5deg);
    }

    .stat-value {
        font-size: 2.25rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.1;
        margin-top: 1rem;
    }
    .stat-label {
        color: #64748b;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .stat-desc {
        font-size: 0.875rem;
        font-weight: 500;
        margin-top: 0.5rem;
    }

    /* Content Cards (Charts, Tables) */
    .content-card {
        background: white;
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.02);
        padding: 1.75rem;
        height: 100%;
        transition: box-shadow 0.3s ease;
    }
    .content-card:hover {
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.05);
    }
    .content-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    .content-card-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
    .content-card-subtitle {
        color: #64748b;
        font-size: 0.875rem;
    }

    /* Modern Badges */
    .modern-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .badge-glass { 
        background: rgba(255, 255, 255, 0.2); 
        color: white; 
        border: 1px solid rgba(255,255,255,0.3);
        backdrop-filter: blur(8px);
    }
    .badge-success { background: rgba(16, 185, 129, 0.1); color: #059669; }
    .badge-primary { background: rgba(14, 165, 233, 0.1); color: #0284c7; }
    .badge-warning { background: rgba(245, 158, 11, 0.1); color: #d97706; }
    .badge-danger { background: rgba(239, 68, 68, 0.1); color: #dc2626; }
    .badge-secondary { background: rgba(100, 116, 139, 0.1); color: #475569; }

    /* Modern Table */
    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 0.5rem;
    }
    .table-modern th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        font-weight: 600;
        padding: 0.75rem 1rem;
        border: none;
    }
    .table-modern td {
        padding: 1rem;
        background: #f8fafc;
        border: none;
        color: #334155;
        font-weight: 500;
        vertical-align: middle;
    }
    .table-modern tr td:first-child { border-top-left-radius: 16px; border-bottom-left-radius: 16px; }
    .table-modern tr td:last-child { border-top-right-radius: 16px; border-bottom-right-radius: 16px; }
    .table-modern tbody tr {
        transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.2s ease;
    }
    .table-modern tbody tr:hover {
        transform: scale(1.005) translateX(2px);
        box-shadow: 0 5px 15px rgba(15, 23, 42, 0.04);
        background: #f1f5f9;
    }
    .table-modern tbody tr:hover td {
        background: white;
    }

    /* Progress Bars */
    .progress-wrapper { margin-bottom: 1.25rem; }
    .progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #334155;
    }
    .progress-modern {
        height: 6px;
        border-radius: 4px;
        background: #e2e8f0;
        overflow: hidden;
    }
    .progress-modern .progress-bar {
        border-radius: 4px;
        transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .bg-gradient-success { background: linear-gradient(90deg, #10b981, #059669); }
    .bg-gradient-primary { background: linear-gradient(90deg, #0ea5e9, #0284c7); }
    .bg-gradient-warning { background: linear-gradient(90deg, #f59e0b, #d97706); }
</style>
@endsection

@section('content')

@php
    $trucksDisponiblesPct = $total_trucks ? round($trucks_disponible * 100 / $total_trucks) : 0;
    $trucksEnRoutePct = $total_trucks ? round($trucks_en_route * 100 / $total_trucks) : 0;
    $trucksMaintPct = $total_trucks ? round($trucks_maint * 100 / $total_trucks) : 0;
@endphp

<div class="dashboard-hero mb-4 animate-fade-in">
    <div class="hero-content d-flex flex-column flex-md-row align-items-start justify-content-between gap-4">
        <div>
            <div class="modern-badge badge-glass mb-3"><i class="bi bi-stars"></i> Tableau de Bord</div>
            <h1 class="mb-2">Vue globale des opérations</h1>
            <p class="mb-0 text-white-50" style="font-size: 1.1rem; max-width: 600px;">Surveillance fluide de la flotte, maintenance intelligente et performances optimisées en temps réel.</p>
        </div>
        <div class="d-flex flex-wrap gap-2 align-items-center">
            <span class="modern-badge badge-glass"><i class="bi bi-arrow-repeat"></i> Mise à jour continue</span>
            <span class="modern-badge badge-glass"><i class="bi bi-lightning-charge"></i> Analyse 24/7</span>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Stat 1 -->
    <div class="col-md-6 col-xl-3 animate-fade-in delay-1">
        <div class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Flotte Totale</span>
                <div class="icon-wrapper icon-blue">
                    <i class="bi bi-truck"></i>
                </div>
            </div>
            <div>
                <div class="stat-value">{{ $total_trucks }}</div>
                <div class="stat-desc text-success"><i class="bi bi-check-circle-fill me-1"></i> {{ $trucks_disponible }} disponibles</div>
            </div>
        </div>
    </div>
    
    <!-- Stat 2 -->
    <div class="col-md-6 col-xl-3 animate-fade-in delay-1">
        <div class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Livraisons</span>
                <div class="icon-wrapper icon-indigo">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
            <div>
                <div class="stat-value">{{ $livraisons_cours }}</div>
                <div class="stat-desc text-primary"><i class="bi bi-cursor-fill me-1"></i> {{ $trucks_en_route }} camions en route</div>
            </div>
        </div>
    </div>

    <!-- Stat 3 -->
    <div class="col-md-6 col-xl-3 animate-fade-in delay-2">
        <div class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Carburant Mensuel</span>
                <div class="icon-wrapper icon-rose">
                    <i class="bi bi-fuel-pump"></i>
                </div>
            </div>
            <div>
                <div class="stat-value">{{ number_format($fuel_mois, 0, ',', ' ') }}</div>
                <div class="stat-desc text-danger fw-bold">MAD</div>
            </div>
        </div>
    </div>

    <!-- Stat 4 -->
    <div class="col-md-6 col-xl-3 animate-fade-in delay-2">
        <div class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Maintenance Mensuelle</span>
                <div class="icon-wrapper icon-amber">
                    <i class="bi bi-tools"></i>
                </div>
            </div>
            <div>
                <div class="stat-value">{{ number_format($maint_mois, 0, ',', ' ') }}</div>
                <div class="stat-desc text-warning fw-bold">MAD</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Chart Dépenses -->
    <div class="col-lg-8 animate-fade-in delay-3">
        <div class="content-card">
            <div class="content-card-header">
                <div>
                    <h2 class="content-card-title">Dépenses Financières</h2>
                    <span class="content-card-subtitle">6 derniers mois (MAD)</span>
                </div>
                <span class="modern-badge badge-primary"><i class="bi bi-graph-up"></i> Tendance globale</span>
            </div>
            <div style="height: 300px; position: relative;">
                <canvas id="chartDepenses"></canvas>
            </div>
        </div>
    </div>

    <!-- Status Camions -->
    <div class="col-lg-4 animate-fade-in delay-3">
        <div class="content-card d-flex flex-column">
            <div class="content-card-header mb-2">
                <div>
                    <h2 class="content-card-title">État des Camions</h2>
                    <span class="content-card-subtitle">Répartition en direct</span>
                </div>
            </div>
            <div class="flex-grow-1 d-flex flex-column justify-content-center">
                <div style="height: 180px; position: relative; margin-bottom: 2rem;">
                    <canvas id="chartStatus"></canvas>
                </div>
                
                <div class="mt-auto">
                    <div class="progress-wrapper">
                        <div class="progress-label">
                            <span class="d-flex align-items-center gap-2"><div style="width:8px;height:8px;border-radius:50%;background:#10b981;"></div> Disponible</span>
                            <span>{{ $trucks_disponible }}</span>
                        </div>
                        <div class="progress-modern">
                            <div class="progress-bar bg-gradient-success" role="progressbar" data-width="{{ $trucksDisponiblesPct }}"></div>
                        </div>
                    </div>

                    <div class="progress-wrapper">
                        <div class="progress-label">
                            <span class="d-flex align-items-center gap-2"><div style="width:8px;height:8px;border-radius:50%;background:#0ea5e9;"></div> En route</span>
                            <span>{{ $trucks_en_route }}</span>
                        </div>
                        <div class="progress-modern">
                            <div class="progress-bar bg-gradient-primary" role="progressbar" data-width="{{ $trucksEnRoutePct }}"></div>
                        </div>
                    </div>

                    <div class="progress-wrapper mb-0">
                        <div class="progress-label">
                            <span class="d-flex align-items-center gap-2"><div style="width:8px;height:8px;border-radius:50%;background:#f59e0b;"></div> Maintenance</span>
                            <span>{{ $trucks_maint }}</span>
                        </div>
                        <div class="progress-modern">
                            <div class="progress-bar bg-gradient-warning" role="progressbar" data-width="{{ $trucksMaintPct }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-card animate-fade-in delay-3 mb-4">
    <div class="content-card-header">
        <div>
            <h2 class="content-card-title">Dernières Livraisons</h2>
            <span class="content-card-subtitle">Suivi des trajets récents de la flotte</span>
        </div>
        <span class="modern-badge badge-success"><i class="bi bi-clock-history"></i> Temps réel</span>
    </div>
    
    <div class="table-responsive">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Camion</th>
                    <th>Chauffeur</th>
                    <th>Destination</th>
                    <th>Départ</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($last_deliveries as $d)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-wrapper icon-blue" style="width: 40px; height: 40px; font-size: 1rem;">
                                <i class="bi bi-truck"></i>
                            </div>
                            <span class="fw-bold">{{ $d->truck->matricule }}</span>
                        </div>
                    </td>
                    <td>{{ $d->driver->nom }}</td>
                    <td><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $d->destination }}</td>
                    <td>{{ \Carbon\Carbon::parse($d->date_depart)->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $badgeData = match($d->status) {
                                'en_cours' => ['class' => 'badge-primary', 'icon' => 'bi-arrow-right-circle-fill'],
                                'livree'   => ['class' => 'badge-success', 'icon' => 'bi-check-circle-fill'],
                                'annulee'  => ['class' => 'badge-danger', 'icon' => 'bi-x-circle-fill'],
                                default    => ['class' => 'badge-secondary', 'icon' => 'bi-info-circle-fill']
                            };
                        @endphp
                        <span class="modern-badge {{ $badgeData['class'] }}">
                            <i class="bi {{ $badgeData['icon'] }}"></i> {{ ucfirst(str_replace('_', ' ', $d->status)) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-2 d-block mb-2 text-black-50"></i>
                        Aucune livraison récente
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
@php
    $fuelData = $fuel_chart->pluck('total')->toArray();
    $maintData = $maint_chart->pluck('total')->toArray();
    $fuelLabels = $fuel_chart
        ->map(fn($r) => \Carbon\Carbon::create($r->annee, $r->mois)->translatedFormat('M Y'))
        ->toArray();
@endphp
<script id="chart-data-fuel" type="application/json">{!! json_encode($fuelData, JSON_UNESCAPED_UNICODE) !!}</script>
<script id="chart-data-maint" type="application/json">{!! json_encode($maintData, JSON_UNESCAPED_UNICODE) !!}</script>
<script id="chart-data-labels" type="application/json">{!! json_encode($fuelLabels, JSON_UNESCAPED_UNICODE) !!}</script>
<script id="chart-data-status" type="application/json">{!! json_encode($trucks_status, JSON_UNESCAPED_UNICODE) !!}</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fuelData  = JSON.parse(document.getElementById('chart-data-fuel').textContent);
    const maintData = JSON.parse(document.getElementById('chart-data-maint').textContent);
    const fuelLabels = JSON.parse(document.getElementById('chart-data-labels').textContent);
    const trucksStatus = JSON.parse(document.getElementById('chart-data-status').textContent);

    Chart.defaults.font.family = "'Outfit', sans-serif";
    Chart.defaults.color = '#64748b';

    // ── Chart 1 : Barres groupées ──
    const ctxDepenses = document.getElementById('chartDepenses').getContext('2d');
    
    // Gradients for bars
    const fuelGradient = ctxDepenses.createLinearGradient(0, 0, 0, 400);
    fuelGradient.addColorStop(0, '#0ea5e9');
    fuelGradient.addColorStop(1, '#0284c7');

    const maintGradient = ctxDepenses.createLinearGradient(0, 0, 0, 400);
    maintGradient.addColorStop(0, '#f43f5e');
    maintGradient.addColorStop(1, '#be123c');

    new Chart(ctxDepenses, {
        type: 'bar',
        data: {
            labels: fuelLabels.length ? fuelLabels : ['Jan','Fév','Mar','Avr','Mai','Jun'],
            datasets: [
                {
                    label: 'Carburant',
                    data: fuelData.length ? fuelData : [14200,16800,15400,18900,17200,18450],
                    backgroundColor: fuelGradient,
                    borderRadius: 8,
                    borderSkipped: false,
                    barPercentage: 0.6,
                    categoryPercentage: 0.8
                },
                {
                    label: 'Maintenance',
                    data: maintData.length ? maintData : [3200,4100,2800,5600,4900,6200],
                    backgroundColor: maintGradient,
                    borderRadius: 8,
                    borderSkipped: false,
                    barPercentage: 0.6,
                    categoryPercentage: 0.8
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { 
                    position: 'top',
                    align: 'end',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: { weight: '600' }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleFont: { size: 14, family: "'Outfit', sans-serif" },
                    bodyFont: { size: 14, family: "'Outfit', sans-serif" },
                    padding: 12,
                    cornerRadius: 12,
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('fr-MA').format(context.parsed.y) + ' MAD';
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(226, 232, 240, 0.5)',
                        drawBorder: false,
                    },
                    ticks: {
                        callback: v => new Intl.NumberFormat('fr-MA', { notation: "compact" , compactDisplay: "short" }).format(v) + ' MAD',
                        font: { weight: '500' }
                    },
                    border: { display: false }
                },
                x: {
                    grid: { display: false, drawBorder: false },
                    ticks: { font: { weight: '500' } },
                    border: { display: false }
                }
            },
            interaction: {
                mode: 'index',
                intersect: false,
            },
        }
    });

    // ── Chart 2 : Donut status ──
    const ctxStatus = document.getElementById('chartStatus').getContext('2d');
    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: ['Disponible', 'En route', 'Maintenance'],
            datasets: [{
                data: trucksStatus,
                backgroundColor: ['#10b981', '#0ea5e9', '#f59e0b'],
                borderWidth: 0,
                hoverOffset: 10,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: { 
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    padding: 12,
                    cornerRadius: 12,
                    titleFont: { family: "'Outfit', sans-serif" },
                    bodyFont: { family: "'Outfit', sans-serif" },
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });

    // Animate progress bars on load
    setTimeout(() => {
        document.querySelectorAll('.progress-bar[data-width]').forEach(el => {
            el.style.width = el.dataset.width + '%';
        });
    }, 300);
});
</script>
@endsection