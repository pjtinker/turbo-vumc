<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\DriverRepository;
use App\Repositories\AutomobileRepository;
use App\Services\DriverService;
use App\Services\AutomobileService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(AutomobileRepository::class, function ($app) {
            return new AutomobileRepository();
        });

        $this->app->bind(DriverRepository::class, function ($app) {
            return new DriverRepository();
        });

        $this->app->bind(DriverService::class, function ($app) {
            return new DriverService(new DriverRepository());
        });

        $this->app->bind(AutomobileService::class, function ($app) {
            return new AutomobileService(new AutomobileRepository(new AutomobileRepository()));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
