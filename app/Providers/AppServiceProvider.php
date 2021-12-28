<?php

namespace App\Providers;

use App\Models\{
    Category,
    plan,
    Product,
    Tenant
};
use App\Observers\{
    PlanObserver,
    TenantObserver,
    CategoryObserver,
    ProductObserver
};
use Illuminate\Support\Facades\Blade;
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
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);

          /**
         * Custom If Statements
         */
        Blade::if('admin', function () {
            $user = auth()->user(); 

            return $user->isAdmin();
            
        });
    }
}
