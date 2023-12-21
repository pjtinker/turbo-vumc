<?php

namespace App\Http\Controllers;

use App\Models\Driver;
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
        Driver::create($validatedData);

        return redirect()->route('drivers.index')->with('notice', __('Driver created.'));  
        
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

        return redirect()->route('drivers.index')->with('notice', __('Driver updated.'));  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
