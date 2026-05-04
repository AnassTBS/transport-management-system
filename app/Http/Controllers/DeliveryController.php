<?php

// app/Http/Controllers/DeliveryController.php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Truck;
use App\Models\Driver;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::with(['truck', 'driver'])->latest()->paginate(10);
        return view('deliveries.index', compact('deliveries'));
    }

    public function create()
    {
        $trucks  = Truck::where('status', 'disponible')->get();
        $drivers = Driver::where('status', 'actif')->get();
        return view('deliveries.create', compact('trucks', 'drivers'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
            'truck_id'    => 'required|exists:trucks,id',
            'driver_id'   => 'required|exists:drivers,id',
            'destination' => 'required|string',
            'date_depart' => 'required|date',
            'date_arrivee'=> 'nullable|date|after_or_equal:date_depart',
            'status'      => 'required|in:en_cours,livree,annulee',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        Delivery::create($data);

        // Mettre à jour le status du camion
        Truck::find($request->truck_id)
             ->update(['status' => 'en_route']);

        return redirect()->route('deliveries.index')
                         ->with('success', 'Livraison créée');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de la création de la livraison: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Delivery $delivery)
    {
        $trucks  = Truck::all();
        $drivers = Driver::where('status', 'actif')->get();
        return view('deliveries.edit', compact('delivery', 'trucks', 'drivers'));
    }

    public function update(Request $request, Delivery $delivery)
    {
        $request->validate([
            'destination'  => 'required|string',
            'date_depart'  => 'required|date',
            'date_arrivee' => 'nullable|date|after_or_equal:date_depart',
            'status'       => 'required|in:en_cours,livree,annulee',
        ]);

        $delivery->update($request->all());

        // Si livrée → camion disponible
        if ($request->status === 'livree') {
            $delivery->truck->update(['status' => 'disponible']);
        }

        return redirect()->route('deliveries.index')
                         ->with('success', 'Livraison mise à jour');
    }

    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        return redirect()->route('deliveries.index')
                         ->with('success', 'Livraison supprimée');
    }
}