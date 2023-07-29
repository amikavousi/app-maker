<?php

namespace AmiKavousi\AppMaker\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AppMaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make {name : Enter your App name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'with this command you can create your app for modular laravel projects';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $bar = $this->output->createProgressBar(100);


        $appName = Str::studly(ucfirst($this->argument('name')));
        $validator = Validator::make([$appName], ['alpha']);
        if ($validator->fails()) {
            throw new \Exception('Invalid App NAME! try like: "Post, Admin, SuperAdmin"');
        }

        // this is your Modules path.
        $appPath = base_path("Modules/" . $appName);

        if (file_exists($appPath)) {
            throw new \Exception("the $appName dir in $appPath is already EXIST");
        }

        // make App Dir
        (new Filesystem())->ensureDirectoryExists($appPath);

        // provider...
        (new Filesystem())->ensureDirectoryExists($appPath . '/Provider');
        (new Filesystem())->copy(__DIR__ . '/../../stubs/app/Provider/ExampleProvider.php',
            $appPath . '/Provider/' . ucfirst($appName) . 'Provider.php');
        (new Filesystem())->replaceInFile('Example', ucfirst($appName), $appPath . '/Provider/' . ucfirst($appName) . 'Provider.php');
        (new Filesystem())->replaceInFile('AppPath', 'Modules/' . ucfirst($appName), $appPath . '/Provider/' . ucfirst($appName) . 'Provider.php');



        // rotes..
        (new Filesystem())->ensureDirectoryExists($appPath . '/routes');
        (new Filesystem())->copy(__DIR__ . '/../../stubs/app/routes/web.php', $appPath . '/routes/web.php');
        (new Filesystem())->replaceInFile('Example', ucfirst($appName), $appPath . '/routes/web.php');


        // Model...
        (new Filesystem())->ensureDirectoryExists($appPath . '/Model');
        (new Filesystem())->copy(__DIR__ . '/../../stubs/app/Model/Example.php', $appPath . '/Model/' . $appName . '.php');
        (new Filesystem())->replaceInFile('Example', $appName, $appPath . '/Model/' . $appName . '.php');



        //migration...
        (new Filesystem())->ensureDirectoryExists($appPath . '/migrations');
        Artisan::call("make:migration $appName --path=/Modules/$appName/migrations");


        // Controller...
        (new Filesystem())->ensureDirectoryExists($appPath . '/Controller');
        (new Filesystem())->copy(__DIR__ . '/../../stubs/app/Controller/ExampleController.php',
            $appPath . '/Controller/' . $appName . 'Controller.php');
        (new Filesystem())->replaceInFile('Example', $appName, $appPath . '/Controller/' . $appName . 'Controller.php');



        // Middleware...
        (new Filesystem())->ensureDirectoryExists($appPath . '/Middlewares');
        (new Filesystem())->copy(__DIR__ . '/../../stubs/app/Middlewares/ExampleValidation.php',
            $appPath . '/Middlewares/' . $appName . 'Validation.php');
        (new Filesystem())->replaceInFile('Example', $appName, $appPath . '/Middlewares/' . $appName . 'Validation.php');


        // views...
        (new Filesystem())->ensureDirectoryExists($appPath . '/resources');
        (new Filesystem())->copy(__DIR__  . "/../../stubs/app/resources/Example.blade.php", $appPath . '/resources/' . $appName . '.blade.php');
        (new Filesystem())->replaceInFile('Example', ucfirst($appName), $appPath . '/resources/' . ucfirst($appName) . '.blade.php');



        $this->info('** Everything is ready Build Something Amazing **');
        $this->alert('Please Check your files Before you start And pay attention to TODO: in Example files.
        If there is any issue, please report it to us : amikavousi@gmail.com');
        $bar->finish();
        $this->newLine();
    }
}
