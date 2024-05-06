<?php

namespace Modules\ModulesProvider;

use Illuminate\Support\ServiceProvider;
use Modules\{
    Example\Provider\ExampleProvider,
};

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // register module providers here
        $this->app->register(ExampleProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
