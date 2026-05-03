{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard')

@section('styles')
<style>
.dashboard-hero {
    position: relative;
    overflow: hidden;
    border-radius: 28px;
    background: radial-gradient(circle at top left, rgba(56, 189, 248, .22), transparent 28%),
                radial-gradient(circle at bottom right, rgba(168, 85, 247, .18), transparent 30%),
                #ffffff;
    border: 1px solid rgba(15, 23, 42, .08);
    box-shadow: 0 32px 70px rgba(15, 23, 42, .08);
}
.dashboard-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(255,255,255,.72), rgba(255,255,255,.16));
    pointer-events: none;
}
.dashboard-hero .hero-content { position: relative; z-index: 1; }
.glass-card {
    background: rgba(255, 255, 255, 0.92);
    border: 1px solid rgba(148, 163, 184, 0.22);
    backdrop-filter: blur(14px);
    box-shadow: 0 22px 50px rgba(15, 23, 42, 0.08);
}
.metric-icon {
    width: 48px;
    height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    background: rgba(56, 189, 248, .12);
    color: #0ea5e9;
}
.chart-card {
    border: none;
    background: #ffffff;
    box-shadow: 0 30px 60px rgba(15, 23, 42, 0.08);
}
.dashboard-table thead th {
    background: rgba(15, 23, 42, 0.04);
    border-bottom: 0;
    color: #6b7280;
    font-size: .78rem;
    letter-spacing: .08em;
}
.dashboard-table tbody tr {
    transition: transform .18s ease, box-shadow .18s ease;
    background: rgba(255,255,255,.96);
}
.dashboard-table tbody tr:hover {
    transform: translateY(-1px);
    box-shadow: 0 16px 30px rgba(15, 23, 42, .07);
}
.status-pill {
    font-size: .75rem;
    letter-spacing: .02em;
    text-transform: uppercase;
    padding: .4rem .75rem;
    border-radius: 999px;
}
.badge-soft {
    background: rgba(56, 189, 248, .12);
    color: #0369a1;
}
.badge-soft-green {
    background: rgba(16, 185, 129, .12);
    color: #047857;
}
.badge-soft-orange {
    background: rgba(251, 146, 60, .12);
    color: #9a3412;
}
</style>
@endsection

@section('content')

@php
    $trucksDisponiblesPct = $total_trucks ? round($trucks_disponible * 100 / $total_trucks) : 0;
    $trucksEnRoutePct = $total_trucks ? round($trucks_en_route * 100 / $total_trucks) : 0;
    $trucksMaintPct = $total_trucks ? round($trucks_maint * 100 / $total_trucks) : 0;
@endphp

<div class="dashboard-hero p-4 p-md-5 mb-4">
    <div class="hero-content d-flex flex-column flex-md-row align-items-start justify-content-between gap-4">
        <div>
            <small class="text-uppercase text-primary fw-semibold">État de la flotte</small>
            <h1 class="display-6 fw-bold mb-2">Vue globale des opérations</h1>
            <p class="text-muted mb-0">Surveillance fluide de la flotte, maintenance intelligente et performances optimisées.</p>
        </div>
        <div class="d-flex flex-wrap gap-2 align-items-center">
            <span class="badge badge-soft">Mise à jour continue</span>
            <span class="badge badge-soft-green">Performance boostée</span>
            <span class="badge badge-soft-orange">Analyse 24/7</span>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <article class="card p-4 h-100 glass-card">
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div>
                    <small class="text-secondary">Camions total</small>
                    <h3 class="fw-semibold mb-0">{{ $total_trucks }}</h3>
                </div>
                <span class="metric-icon"><i class="bi bi-truck"></i></span>
            </div>
            <p class="text-success mb-0">{{ $trucks_disponible }} disponibles</p>
        </article>
    </div>
    <div class="col-md-3">
        <div class="card p-3 h-100">
            <small class="text-muted">Livraisons en cours</small>
            <h3 class="fw-semibold mb-0">{{ $livraisons_cours }}</h3>
            <small class="text-primary">{{ $trucks_en_route }} camions en route</small>
        </div>
    </div>
    <div class="col-md-3">
        <article class="card p-4 h-100 glass-card">
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div>
                    <small class="text-secondary">Livraisons en cours</small>
                    <h3 class="fw-semibold mb-0">{{ $livraisons_cours }}</h3>
                </div>
                <span class="metric-icon"><i class="bi bi-box-seam"></i></span>
            </div>
            <p class="text-primary mb-0">{{ $trucks_en_route }} camions en route</p>
        </article>
    </div>
    <div class="col-md-3">
        <article class="card p-4 h-100 glass-card">
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div>
                    <small class="text-secondary">Carburant ce mois</small>
                    <h3 class="fw-semibold mb-0">{{ number_format($fuel_mois, 0, ',', ' ') }}</h3>
                </div>
                <span class="metric-icon"><i class="bi bi-fuel-pump"></i></span>
            </div>
            <p class="text-danger mb-0">MAD</p>
        </article>
    </div>
    <div class="col-md-3">
        <article class="card p-4 h-100 glass-card">
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div>
                    <small class="text-secondary">Maintenance ce mois</small>
                    <h3 class="fw-semibold mb-0">{{ number_format($maint_mois, 0, ',', ' ') }}</h3>
                </div>
                <span class="metric-icon"><i class="bi bi-tools"></i></span>
            </div>
            <p class="text-warning mb-0">MAD</p>
        </article>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card p-4 h-100 chart-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h6 class="fw-semibold mb-1">Dépenses — 6 derniers mois</h6>
                    <small class="text-muted">MAD</small>
                </div>
                <span class="badge badge-soft">Tendance stable</span>
            </div>
            <div class="position-relative">
                <canvas id="chartDepenses" height="120"></canvas>
            </div>
            <div class="mt-4 d-flex gap-4 flex-wrap text-secondary">
                <div>
                    <div class="fw-semibold">{{ number_format($fuel_mois, 0, ',', ' ') }} MAD</div>
                    Carburant
                </div>
                <div>
                    <div class="fw-semibold">{{ number_format($maint_mois, 0, ',', ' ') }} MAD</div>
                    Maintenance
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 h-100 chart-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h6 class="fw-semibold mb-1">Status des camions</h6>
                    <small class="text-muted">Répartition actuelle</small>
                </div>
                <span class="badge badge-soft-green">En direct</span>
            </div>
            <canvas id="chartStatus" height="220"></canvas>
            <div class="mt-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="status-pill badge-soft-green">Disponible</span>
                    <strong>{{ $trucks_disponible }}</strong>
                </div>
                <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar bg-success" role="progressbar" data-width="{{ $trucksDisponiblesPct }}" aria-valuenow="{{ $trucks_disponible }}" aria-valuemin="0" aria-valuemax="{{ $total_trucks }}"></div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="status-pill badge-soft">En route</span>
                    <strong>{{ $trucks_en_route }}</strong>
                </div>
                <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar bg-info" role="progressbar" data-width="{{ $trucksEnRoutePct }}" aria-valuenow="{{ $trucks_en_route }}" aria-valuemin="0" aria-valuemax="{{ $total_trucks }}"></div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="status-pill badge-soft-orange">Maintenance</span>
                    <strong>{{ $trucks_maint }}</strong>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-warning" role="progressbar" data-width="{{ $trucksMaintPct }}" aria-valuenow="{{ $trucks_maint }}" aria-valuemin="0" aria-valuemax="{{ $total_trucks }}"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card glass-card overflow-hidden">
    <div class="card-body p-0">
        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-1 fw-semibold">Dernières livraisons</h5>
                <small class="text-muted">Suivi des trajets récents de la flotte.</small>
            </div>
            <span class="badge badge-soft">Actualisé maintenant</span>
        </div>
        <div class="table-responsive">
            <table class="table dashboard-table mb-0 align-middle">
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
                        <td class="fw-semibold">{{ $d->truck->matricule }}</td>
                        <td>{{ $d->driver->nom }}</td>
                        <td>{{ $d->destination }}</td>
                        <td>{{ \Carbon\Carbon::parse($d->date_depart)->format('d/m/Y') }}</td>
                        <td>
                            @php
                                $cls = match($d->status) {
                                    'en_cours' => 'bg-primary text-white',
                                    'livree'   => 'bg-success text-white',
                                    'annulee'  => 'bg-danger text-white',
                                    default    => 'bg-secondary text-white'
                                };
                            @endphp
                            <span class="badge rounded-pill {{ $cls }}">
                                {{ ucfirst(str_replace('_', ' ', $d->status)) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Aucune livraison
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
const fuelData  = JSON.parse(document.getElementById('chart-data-fuel').textContent);
const maintData = JSON.parse(document.getElementById('chart-data-maint').textContent);
const fuelLabels = JSON.parse(document.getElementById('chart-data-labels').textContent);
const trucksStatus = JSON.parse(document.getElementById('chart-data-status').textContent);

// ── Chart 1 : Barres groupées ──
new Chart(document.getElementById('chartDepenses'), {
    type: 'bar',
    data: {
        labels: fuelLabels.length ? fuelLabels : ['Jan','Fév','Mar','Avr','Mai','Jun'],
        datasets: [
            {
                label: 'Carburant',
                data: fuelData.length ? fuelData : [14200,16800,15400,18900,17200,18450],
                backgroundColor: '#378ADD',
                borderRadius: 4,
            },
            {
                label: 'Maintenance',
                data: maintData.length ? maintData : [3200,4100,2800,5600,4900,6200],
                backgroundColor: '#D85A30',
                borderRadius: 4,
            }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } },
        scales: {
            y: {
                ticks: {
                    callback: v => v.toLocaleString('fr-MA') + ' MAD'
                }
            }
        }
    }
});

// ── Chart 2 : Donut status ──
new Chart(document.getElementById('chartStatus'), {
    type: 'doughnut',
    data: {
        labels: ['Disponible', 'En route', 'Maintenance'],
        datasets: [{
            data: trucksStatus,
            backgroundColor: ['#1D9E75', '#378ADD', '#BA7517'],
            borderWidth: 0,
            hoverOffset: 6,
        }]
    },
    options: {
        responsive: true,
        cutout: '65%',
        plugins: { legend: { display: false } }
    }
});

// Apply progress width values from Blade data attributes.
document.querySelectorAll('.progress-bar[data-width]').forEach(el => {
    el.style.width = el.dataset.width + '%';
});
</script>
@endsection