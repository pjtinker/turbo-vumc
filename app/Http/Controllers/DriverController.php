<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Traits\HasUnsplashAvatar;
use App\Models\Automobile;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('drivers.index', [
            'drivers' => Driver::with('automobiles')->latest()->get()
        ]);
    }

    public function getDriverSelect(Request $request, Automobile $automobile)
    {
        $builder = Driver::query();
        $isManual = $request->query('isManual') === 'true';
        $selectedDriverId = $request->query('selectedDriverId', '');
        if ($isManual == true) {
            $builder->where('can_drive_manual', true);
        }

        return view('drivers.partials.driver_select', [
            'drivers' => $builder->get(),
            'currentDriverId' => $selectedDriverId
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'unique:drivers,email', 'max:255'],
            'years_of_experience' => ['required', 'integer', 'min:0'],
            'can_drive_manual' => ['required', 'boolean']
        ]);

        $driver = Driver::create($validatedData);
        $driver->setRandomUnsplashAvatar();

        $html = view('drivers.partials.details', compact('driver'))->render();

        return redirect()->route('drivers.show', [
            'driver' => $driver,
            'automobiles' => $driver->automobile
        ])->with('notice', __('Driver created.')); 
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        return view('drivers._driver', [
            'driver' => $driver->load('automobiles')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        return view('drivers.edit', [
            'driver' => $driver->load('automobiles')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'unique:drivers,email,' . $driver->id . ',id', 'max:255'],
            'years_of_experience' => ['required', 'integer', 'min:0'],
            'can_drive_manual' => ['required', 'boolean']
        ]);

        $driver->update($validatedData);
        $count = $driver->unassignManualAutomobiles();

        $autoChangeNotice = $count > 0
            ? __('Driver can no longer drive manual - :count manual :vehicle unassigned.', [
                'count' => $count,
                'vehicle' => $count > 1 ? 'vehicles were' : 'vehicle was'
            ])
            : '';

        return redirect()->route('drivers.show', [
            'driver' => $driver,
            'automobiles' => $driver->automobile
        ])->with('notice', __('Driver updated.') . ' ' . $autoChangeNotice);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        $driver->automobiles()->update(['driver_id' => null]);
        $driver->delete();

        return redirect()->route('drivers.index')->with('notice', __('Driver deleted.'));
    }

    public function assignAutomobile(Request $request, string $driverId)
    {

        $driver = Driver::findOrFail($driverId);

        if ($driver->automobiles()->count() > 0) {
            $driver->automobiles()->update(['driver_id' => null]);
        }

        $validatedData = $request->validate([
            'automobiles' => ['array'],
            'automobiles.*' => ['exists:automobiles,id']
        ]);
        
        $automobiles = $request->get('automobiles', []);
        if (count($automobiles)) {
            $driver->automobiles()->saveMany(Automobile::findMany($automobiles));
        }

        return redirect()->route('drivers.show', [
            'driver' => $driver,
            'automobiles' => $driver->automobiles
        ])->with('notice', __('Automobile assigned.'));
    }
}
