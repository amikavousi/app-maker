<?php

namespace AmiKavousi\AppMaker;

use AmiKavousi\AppMaker\Console\AppMaker;
use Illuminate\Support\ServiceProvider;

class AppMakerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            AppMaker::class
        ]);
    }
}
