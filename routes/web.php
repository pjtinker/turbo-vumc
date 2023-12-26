<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\AutomobileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePasswordController;
use Illuminate\Support\Facades\Route;
use App\Models\Automobile;
use App\Models\Driver;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('drivers._driver', [DriverController::class, 'show'])->name('drivers._driver')->middleware(['auth', 'verified']);
Route::post('drivers/automobiles/assign/{driver_id}', [DriverController::class, 'assignAutomobile'])->name('drivers.automobiles.assign')->middleware(['auth', 'verified']);

Route::get('drivers/automobiles/assign/{driver_id}', function(string $driver_id) {
    $driver = Driver::findOrFail($driver_id);
    $builder = Automobile::where('driver_id', $driver_id)->orWhereNull('driver_id');
    if (!$driver->can_drive_manual) {
        $builder->where('automatic', true);
    }
    return view('drivers.partials.assign-automobile', ['driver' => $driver, 'automobiles' => $builder->get()]);
})->name('drivers.automobiles.assign')->middleware(['auth', 'verified']);

Route::resource('drivers', DriverController::class)
    ->middleware(['auth', 'verified']);

Route::get('automobiles._automobile', [AutomobileController::class, 'show'])->name('automobiles._automobile')->middleware(['auth', 'verified']);
Route::get('automobiles/driver/assign/{automobile_id}', function(string $automobile_id) {

    $automobile = Automobile::findOrFail($automobile_id);

    $builder = Driver::query();
    if (!$automobile->automatic) {
        $builder->where('can_drive_manual', true);
    }

    return view('automobiles.partials.assign-driver', ['automobile' => $automobile, 'drivers' => $builder->get()]);
})->name('automobile.drivers.assign')->middleware(['auth', 'verified']);

Route::resource('automobiles', AutomobileController::class)
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile/password/edit', [ProfilePasswordController::class, 'edit'])->name('profile.password.edit');
    Route::patch('/profile/password', [ProfilePasswordController::class, 'update'])->name('profile.password.update');

    Route::get('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
