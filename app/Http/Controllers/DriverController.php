<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Traits\HasUnsplashAvatar;
use App\Models\Automobile;
use App\Repositories\AutomobileRepository;
use App\Repositories\DriverRepository;
use App\Services\DriverService;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    
    protected $driverService;

    public function __construct(DriverService $driverService)
    {
        $this->driverService = $driverService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('drivers.index', [
            'drivers' => Driver::with('automobiles')->orderBy('updated_at', 'desc')->get()
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
            'name'                  => ['required', 'max:255'],
            'email'                 => ['required', 'unique:drivers,email', 'max:255'],
            'years_of_experience'   => ['required', 'integer', 'min:0'],
            'can_drive_manual'      => ['required', 'boolean']
        ]);

        $driver = $this->driverService->createDriver($validatedData);

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
            'name'                  => ['required', 'max:255'],
            'email'                 => ['required', 'unique:drivers,email,' . $driver->id . ',id', 'max:255'],
            'years_of_experience'   => ['required', 'integer', 'min:0'],
            'can_drive_manual'      => ['required', 'boolean'],
            'avatar_url'            => ['nullable', 'url', 'max:255']
        ]);

        list('driver' => $driver, 'autoChangeNotice' => $autoChangeNotice) = $this->driverService->updateDriver($driver, $validatedData);

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
        $driver->destroy();

        return redirect()->route('drivers.index')->with('notice', __('Driver deleted.'));
    }

    public function getAssignAutomobile(Driver $driver)
    {
        $automobiles = AutomobileRepository::getAvailableAutomobiles($driver);

        return view('drivers.partials.assign-automobile', [
            'driver' => $driver, 
            'automobiles' => $automobiles
        ]);
    }
    /**
     * Assign an automobile to a driver.
     * @param Request $request
     * @param Driver $driver
     */
    public function assignAutomobile(Request $request, Driver $driver)
    {
        $validatedData = $request->validate([
            'automobiles'   => ['array'],
            'automobiles.*' => ['exists:automobiles,id']
        ]);
        
        if ($driver->automobiles()->exists()) {
            $driver->automobiles()->update(['driver_id' => null]);
        }
        
        $automobiles = $request->get('automobiles', []);
        if (!empty($automobiles)) {
            $driver->automobiles()->saveMany(Automobile::findMany($automobiles));
        }

        return redirect()->route('drivers.show', [
            'driver'        => $driver,
            'automobiles'   => $driver->automobiles
        ])->with('notice', __('Automobile' . (count($automobiles) > 1 ? 's' : '') . ' assigned.'));
    }

    /**
     * Get the driver select partial.  Filter available drivers by transmission type.
     * @param Request $request
     */
    public function getDriverSelect(Request $request)
    {
        ['drivers' => $drivers, 'currentDriverId' => $currentDriverId] = DriverRepository::getDriverSelect($request->all());
        return view('drivers.partials.driver_select', [
            'drivers'           => $drivers,
            'currentDriverId'   => $currentDriverId
        ]);
    }
}
