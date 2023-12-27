<?php

namespace App\Http\Controllers;

use App\Models\Automobile;
use App\Models\Driver;
use Illuminate\Http\Request;

class AutomobileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('automobiles.index', [
            'automobiles' => Automobile::with('driver')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//
    }

    /**
     * Display the specified resource.
     */
    public function show(Automobile $automobile)
    {
        return view('automobiles._automobile', [
            'automobile' => $automobile->load('driver')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Automobile $automobile)
    {
        $drivers = Driver::query();

        if (!$automobile->automatic) {
            $drivers->where('can_drive_manual', true);
        }

        return view('automobiles.edit', [
            'automobile' => $automobile->load('driver'),
            'drivers' => $drivers->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Automobile $automobile)
    {
        $validatedData = $request->validate([
            'make'                  => ['required', 'max:255'],
            'model'                 => ['required', 'max:255'],
            'number_of_cylinders'   => ['required', 'integer', 'min:4', 'max:12'],
            'year'                  => ['required', 'integer', 'min:1900', 'max:2023'],
            'automatic'             => ['required', 'boolean'],
            'driver_id'             => ['nullable', 'exists:drivers,id']
        ]);

        $automobile->update($validatedData);

        $driverUnassignedNotice = $automobile->unassignedDriverDueToTransmissionType() ? __('Driver unassigned due to transmission type.') : '';

        return redirect()->route('automobiles.show', [
            'automobile' => $automobile
        ])->with('notice',  __('Driver updated.') . ' ' . $driverUnassignedNotice); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Automobile $automobile)
    {
        //
    }

    public function assignDriver(Request $request, string $automobileId)
    {
        $automobile = Automobile::findOrFail($automobileId);

        $validatedData = $request->validate([
            'driver_id' => ['required', 'exists:drivers,id']
        ]);

        $automobile->driver_id = $validatedData['driver_id'];
        $automobile->save();

        return redirect()->route('automobiles.show', [
            'automobile' => $automobile
        ])->with('notice', __('Driver assigned.'));
    }
}
