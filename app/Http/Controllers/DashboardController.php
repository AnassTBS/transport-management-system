<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\Driver;
use App\Models\Delivery;
use App\Models\Maintenance;
use App\Models\Fuel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Metric cards ──────────────────────────────
        $total_trucks      = Truck::count();
        $trucks_disponible = Truck::where('status', 'disponible')->count();
        $trucks_en_route   = Truck::where('status', 'en_route')->count();
        $trucks_maint      = Truck::where('status', 'en_maintenance')->count();

        $livraisons_cours  = Delivery::where('status', 'en_cours')->count();

        $fuel_mois         = Fuel::whereMonth('date', now()->month)
                                  ->whereYear('date', now()->year)
                                  ->sum('cost');

        $maint_mois        = Maintenance::whereMonth('date', now()->month)
                                         ->whereYear('date', now()->year)
                                         ->sum('cost');

        // ── Chart 1 : fuel + maintenance 6 derniers mois ──
        $fuel_chart = Fuel::selectRaw('MONTH(date) as mois, YEAR(date) as annee, SUM(cost) as total')
            ->where('date', '>=', now()->subMonths(6))
            ->groupBy('mois', 'annee')
            ->orderBy('annee')->orderBy('mois')
            ->get();

        $maint_chart = Maintenance::selectRaw('MONTH(date) as mois, YEAR(date) as annee, SUM(cost) as total')
            ->where('date', '>=', now()->subMonths(6))
            ->groupBy('mois', 'annee')
            ->orderBy('annee')->orderBy('mois')
            ->get();

        // ── Chart 2 : status camions ──
        $trucks_status = [
            $trucks_disponible,
            $trucks_en_route,
            $trucks_maint,
        ];

        // ── Dernières activités ──
        $last_deliveries = Delivery::with(['truck', 'driver'])
            ->latest()->take(5)->get();

        return view('dashboard', compact(
            'total_trucks', 'trucks_disponible', 'trucks_en_route', 'trucks_maint',
            'livraisons_cours', 'fuel_mois', 'maint_mois',
            'fuel_chart', 'maint_chart', 'trucks_status',
            'last_deliveries'
        ));
    }
}