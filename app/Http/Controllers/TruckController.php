<?php

// app/Http/Controllers/TruckController.php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index()
    {
        $trucks = Truck::latest()->paginate(10);
        return view('trucks.index', compact('trucks'));
    }

    public function create()
    {
        return view('trucks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'matricule' => 'required|unique:trucks',
            'marque'    => 'required',
            'annee'     => 'required|integer|min:2000',
            'status'    => 'required|in:disponible,en_route,en_maintenance',
        ]);

        Truck::create($request->all());
        return redirect()->route('trucks.index')
                         ->with('success', 'Camion ajouté avec succès');
    }

    public function edit(Truck $truck)
    {
        return view('trucks.edit', compact('truck'));
    }

    public function update(Request $request, Truck $truck)
    {
        $request->validate([
            'matricule' => 'required|unique:trucks,matricule,' . $truck->id,
            'marque'    => 'required',
            'annee'     => 'required|integer',
            'status'    => 'required|in:disponible,en_route,en_maintenance',
        ]);

        $truck->update($request->all());
        return redirect()->route('trucks.index')
                         ->with('success', 'Camion modifié');
    }

    public function destroy(Truck $truck)
    {
        $truck->delete();
        return redirect()->route('trucks.index')
                         ->with('success', 'Camion supprimé');
    }
}