<?php

namespace AmiKavousi\AppMaker;

use AmiKavousi\AppMaker\Console\AppMaker;
use AmiKavousi\AppMaker\Console\AppMakerCommand;
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
            AppMaker::class,
            AppMakerCommand::class
        ]);
    }
}
