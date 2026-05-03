<?php

// app/Http/Controllers/DriverController.php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::latest()->paginate(10);
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'    => 'required|string|max:100',
            'tel'    => 'required|string|max:15',
            'permis' => 'required|unique:drivers',
            'status' => 'required|in:actif,inactif',
        ]);

        Driver::create($request->all());
        return redirect()->route('drivers.index')
                         ->with('success', 'Chauffeur ajouté');
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'nom'    => 'required|string|max:100',
            'tel'    => 'required|string|max:15',
            'permis' => 'required|unique:drivers,permis,' . $driver->id,
            'status' => 'required|in:actif,inactif',
        ]);

        $driver->update($request->all());
        return redirect()->route('drivers.index')
                         ->with('success', 'Chauffeur modifié');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')
                         ->with('success', 'Chauffeur supprimé');
 
                         }
}