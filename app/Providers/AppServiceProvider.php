<?php

namespace App\Providers;

use App\Models\Vehicle;
use App\Policies\VehiclePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Gate::policy(Vehicle::class, VehiclePolicy::class);
    }
}
