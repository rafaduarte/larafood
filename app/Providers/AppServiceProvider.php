<?php

namespace App\Providers;

use App\Models\{
    plan,
    Tenant
};
use App\Observers\{
    PlanObserver,
    TenantObserver
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);

    }
}
