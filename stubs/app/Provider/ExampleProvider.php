<?php

namespace Modules\Example\Provider;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ExampleProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->routeMap();
        $this->loadMigrationsFrom(base_path('AppPath/migrations'));
        $this->loadViewsFrom(base_path('AppPath/resources'),'Example');
    }

    private function routeMap()
    {
        Route::prefix('ROUTE-NAME')
            ->middleware('web')
            ->name('ROUTE-NAME.')
            ->group(base_path('AppPath/routes/web.php'));
    }
}