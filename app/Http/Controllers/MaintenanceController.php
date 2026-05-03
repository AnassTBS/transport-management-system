<?php

// app/Http/Controllers/MaintenanceController.php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Truck;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with('truck')->latest()->paginate(10);
        return view('maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $trucks = Truck::all();
        return view('maintenances.create', compact('trucks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'truck_id'    => 'required|exists:trucks,id',
            'type'        => 'required|in:vidange,pneus,freins,moteur,autre',
            'date'        => 'required|date',
            'cost'        => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Maintenance::create($request->all());

        // Camion en maintenance
        Truck::find($request->truck_id)
             ->update(['status' => 'en_maintenance']);

        return redirect()->route('maintenances.index')
                         ->with('success', 'Maintenance enregistrée');
    }

    public function edit(Maintenance $maintenance)
    {
        $trucks = Truck::all();
        return view('maintenances.edit', compact('maintenance', 'trucks'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'type' => 'required|in:vidange,pneus,freins,moteur,autre',
            'date' => 'required|date',
            'cost' => 'required|numeric|min:0',
        ]);

        $maintenance->update($request->all());
        return redirect()->route('maintenances.index')
                         ->with('success', 'Maintenance mise à jour');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenances.index')
                         ->with('success', 'Maintenance supprimée');
    }
}