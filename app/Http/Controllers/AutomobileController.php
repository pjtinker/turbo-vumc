<?php

namespace App\Http\Controllers;

use App\Models\Automobile;
use App\Models\Driver;
use App\Repositories\AutomobileRepository;
use App\Services\AutomobileService;
use Illuminate\Http\Request;

class AutomobileController extends Controller
{
    protected $automobileService;

    public function __construct(AutomobileService $automobileService)
    {
        $this->automobileService = $automobileService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('automobiles.index', [
            'automobiles' => Automobile::with('driver')->orderBy('updated_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('automobiles.create', [
            'drivers' => Driver::query()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'make'                  => ['required', 'max:255'],
            'model'                 => ['required', 'max:255'],
            'number_of_cylinders'   => ['required', 'integer', 'min:4', 'max:12'],
            'year'                  => ['required', 'integer', 'min:1900', 'max:2024'],
            'automatic'             => ['required', 'boolean'],
            'driver_id'             => ['nullable', 'exists:drivers,id']
        ]);

        $automobile = $this->automobileService->createAutomobile($validatedData);

        return redirect()->route('automobiles.show', [
            'automobile' => $automobile
        ])->with('notice', __('Automobile created.'));
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
            'automobile'    => $automobile->load('driver'),
            'drivers'       => $drivers->get()
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
            'driver_id'             => ['nullable', 'exists:drivers,id'],
            'avatar_url'            => ['nullable', 'url', 'max:255']
        ]);

        list('automobile' => $automobile, 'driverUnassignedNotice' => $driverUnassignedNotice) = $this->automobileService->updateAutomobile($automobile, $validatedData);

        return redirect()->route('automobiles.show', [
            'automobile' => $automobile
        ])->with('notice',  __('Driver updated.') . ' ' . $driverUnassignedNotice); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Automobile $automobile)
    {
        $automobile->delete();

        return redirect()->route('automobiles.index')->with('notice', __('Automobile deleted.'));
    }

    /**
     * Assign a driver to the specified resource.
     * @param Request $request
     * @param Automobile $automobile
     */
    public function assignDriver(Request $request, Automobile $automobile)
    {
        $validatedData = $request->validate([
            'driver_id' => ['required', 'exists:drivers,id']
        ]);

        AutomobileRepository::assignDriver($automobile, $validatedData['driver_id']);
        
        return redirect()->route('automobiles.show', [
            'automobile' => $automobile
        ])->with('notice', __('Driver assigned.'));
    }
}
