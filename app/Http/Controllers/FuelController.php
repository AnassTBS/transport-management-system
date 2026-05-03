<?php

// app/Http/Controllers/FuelController.php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Models\Truck;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function index()
    {
        $fuels = Fuel::with('truck')->latest()->paginate(10);
        return view('fuels.index', compact('fuels'));
    }

    public function create()
    {
        $trucks = Truck::all();
        return view('fuels.create', compact('trucks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'truck_id'       => 'required|exists:trucks,id',
            'quantity'       => 'required|numeric|min:0',
            'cost'           => 'required|numeric|min:0',
            'date'           => 'required|date',
            'station'        => 'nullable|string|max:100',
        ]);

        // Auto-calcul prix/litre
        $data = $request->all();
        $data['price_per_litre'] = round($request->cost / $request->quantity, 2);

        Fuel::create($data);
        return redirect()->route('fuels.index')
                         ->with('success', 'Consommation enregistrée');
    }

    public function edit(Fuel $fuel)
    {
        $trucks = Truck::all();
        return view('fuels.edit', compact('fuel', 'trucks'));
    }

    public function update(Request $request, Fuel $fuel)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0',
            'cost'     => 'required|numeric|min:0',
            'date'     => 'required|date',
        ]);

        $data = $request->all();
        $data['price_per_litre'] = round($request->cost / $request->quantity, 2);

        $fuel->update($data);
        return redirect()->route('fuels.index')
                         ->with('success', 'Consommation mise à jour');
    }

    public function destroy(Fuel $fuel)
    {
        $fuel->delete();
        return redirect()->route('fuels.index')
                         ->with('success', 'Supprimé');
    }
}