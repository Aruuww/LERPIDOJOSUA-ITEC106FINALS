<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = auth()->user()->vehicles()->latest()->get();
        return view('vehicles.index', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'model'        => 'required|string|max:255',
            'year'         => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'color'        => 'required|string|max:100',
            'plate_number' => 'required|string|max:20|unique:vehicles',
            'type'         => 'required|in:Sedan,SUV,Coupe,Convertible,Wagon,Hatchback',
            'price'        => 'nullable|numeric|min:0',
            'notes'        => 'nullable|string',
        ]);

        auth()->user()->vehicles()->create($request->all());
        return back()->with('toast_success', 'Vehicle record added successfully.');
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $this->authorize('update', $vehicle);

        $request->validate([
            'model'        => 'required|string|max:255',
            'year'         => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'color'        => 'required|string|max:100',
            'plate_number' => 'required|string|max:20|unique:vehicles,plate_number,' . $vehicle->id,
            'type'         => 'required|in:Sedan,SUV,Coupe,Convertible,Wagon,Hatchback',
            'price'        => 'nullable|numeric|min:0',
            'notes'        => 'nullable|string',
        ]);

        $vehicle->update($request->all());
        return back()->with('toast_success', 'Vehicle record updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->authorize('delete', $vehicle);
        $vehicle->delete();
        return back()->with('toast_success', 'Vehicle record deleted successfully.');
    }
}
