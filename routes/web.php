<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\AutomobileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePasswordController;
use App\Http\Controllers\UnsplashController;
use App\Repositories\AutomobileRepository;
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

// Drivers
Route::get('drivers/get_driver_select', [DriverController::class, 'getDriverSelect'])->name('drivers.get-driver-select')->middleware(['auth', 'verified']);
Route::get('drivers._driver', [DriverController::class, 'show'])->name('drivers._driver')->middleware(['auth', 'verified']);
Route::post('drivers/automobiles/assign/{driver}', [DriverController::class, 'assignAutomobile'])->name('drivers.automobiles.assign')->middleware(['auth', 'verified']);

Route::get('drivers/automobiles/assign/{driver}', [DriverController::class, 'getAssignAutomobile'])
    ->name('drivers.automobiles.assign')
    ->middleware(['auth', 'verified']);

Route::resource('drivers', DriverController::class)
    ->middleware(['auth', 'verified']);

// Automobiles
Route::post('automobiles/drivers/assign/{automobile}', [AutomobileController::class, 'assignDriver'])->name('automobiles.drivers.assign')->middleware(['auth', 'verified']);
Route::get('automobiles._automobile', [AutomobileController::class, 'show'])->name('automobiles._automobile')->middleware(['auth', 'verified']);

// I forgot to move this to the controller.  I would normally do that, but I'm leaving it here for now.
// This is a way to do it without a controller, fwiw.
Route::get('automobiles/driver/assign/{automobile}', function(Automobile $automobile) {
    $builder = Driver::query();
    if (!$automobile->automatic) {
        $builder->where('can_drive_manual', true);
    }
    return view('automobiles.partials.assign-driver', ['automobile' => $automobile, 'drivers' => $builder->get()]);
})->name('automobile.drivers.assign')->middleware(['auth', 'verified']);

Route::resource('automobiles', AutomobileController::class)
    ->middleware(['auth', 'verified']);

// Unsplash
Route::get('/unsplash/get-random-image-thumbnail/{type}', [UnsplashController::class, 'getRandomImageThumbnail'])->name('unsplash.get-random-image-thumbnail')->middleware(['auth', 'verified']);
Route::post('/unsplash/assign-random-image-thumbnail', [UnsplashController::class, 'assignRandomImageThumbnail'])->name('unsplash.assign-random-image-thumbnail')->middleware(['auth', 'verified']);

// These came with the Laravel breeze scaffolding. 
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
