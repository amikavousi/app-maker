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


    private $appName ;
    private $appPath ;
    const ALERT_MESSAGE = 'Please Check your files Before you start And pay attention to TODO: in Example files.
        If there is any issue, please report it to us : amikavousi@gmail.com';

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

        $this->appName = Str::studly(ucfirst($this->argument('name')));

        $validator = Validator::make([$this->appName], ['alpha']);
        if ($validator->fails()) {
            throw new \Exception('Invalid App NAME! try like: "Post, Admin, SuperAdmin"');
        }

        // this is your Modules path.
        $this->appPath = base_path("Modules/" . $this->appName);


        if (file_exists($this->appPath)) {
            throw new \Exception("the $this->appName dir in $this->appPath is already EXIST");
        }

        // make App Dir
        (new Filesystem())->ensureDirectoryExists($this->appPath);

        // provider...
        $this->createProvider();

        // Routes..
        $this->createRoute();

        // Model...
        $this->createModel();

        //migration...
        $this->createMigration();

        // Controller...
        $this->createController();

        // Middleware...
        $this->createMiddleware();

        // views...
        $this->createViews();


        $this->info('** Everything is ready Build Something Amazing **');
        $this->alert(self::ALERT_MESSAGE);
        $bar->finish();
        $this->newLine();
    }

    private function createProvider()
    {
        (new Filesystem())->ensureDirectoryExists($this->appPath . '/Provider');
        (new Filesystem())->copy(__DIR__ . '/../../stubs/app/Provider/ExampleProvider.php',
            $this->appPath  . '/Provider/' . ucfirst($this->appName ) . 'Provider.php');
        (new Filesystem())->replaceInFile('Example', ucfirst($this->appName ), $this->appPath  . '/Provider/' . ucfirst($this->appName ) . 'Provider.php');
        (new Filesystem())->replaceInFile('AppPath', 'Modules/' . ucfirst($this->appName ), $this->appPath  . '/Provider/' . ucfirst($this->appName ) . 'Provider.php');
    }

    private function createRoute()
    {
        (new Filesystem())->ensureDirectoryExists($this->appPath . '/routes');
        (new Filesystem())->copy(__DIR__ . '/../../stubs/app/routes/web.php', $this->appPath  . '/routes/web.php');
        (new Filesystem())->replaceInFile('Example', ucfirst($this->appName ), $this->appPath  . '/routes/web.php');
    }

    private function createModel()
    {
        (new Filesystem())->ensureDirectoryExists($this->appPath  . '/Model');
        (new Filesystem())->copy(__DIR__ . '/../../stubs/app/Model/Example.php', $this->appPath  . '/Model/' . $this->appName  . '.php');
        (new Filesystem())->replaceInFile('Example', $this->appName , $this->appPath  . '/Model/' . $this->appName  . '.php');
    }

    private function createMigration()
    {
        (new Filesystem())->ensureDirectoryExists($this->appPath . '/migrations');
        Artisan::call("make:migration $this->appName --path=/Modules/$this->appName/migrations");
    }

    private function createController()
    {
        (new Filesystem())->ensureDirectoryExists($this->appPath . '/Controller');
        (new Filesystem())->copy(__DIR__ . '/../../stubs/app/Controller/ExampleController.php',
            $this->appPath . '/Controller/' . $this->appName . 'Controller.php');
        (new Filesystem())->replaceInFile('Example', $this->appName, $this->appPath . '/Controller/' . $this->appName . 'Controller.php');
    }

    private function createMiddleware()
    {
        (new Filesystem())->ensureDirectoryExists($this->appPath  . '/Middlewares');
        (new Filesystem())->copy(__DIR__ . '/../../stubs/app/Middlewares/ExampleValidation.php',
            $this->appPath  . '/Middlewares/' . $this->appName  . 'Validation.php');
        (new Filesystem())->replaceInFile('AppName', $this->appName , $this->appPath  . '/Middlewares/' . $this->appName  . 'Validation.php');
        (new Filesystem())->replaceInFile('Example', $this->appName , $this->appPath  . '/Middlewares/' . $this->appName  . 'Validation.php');
    }

    private function createViews()
    {
        (new Filesystem())->ensureDirectoryExists($this->appPath  . '/resources');
        (new Filesystem())->copy(__DIR__ . "/../../stubs/app/resources/Example.blade.php", $this->appPath  . '/resources/' . $this->appName  . '.blade.php');
        (new Filesystem())->replaceInFile('Example', ucfirst($this->appName ), $this->appPath  . '/resources/' . ucfirst($this->appName ) . '.blade.php');
    }
}
