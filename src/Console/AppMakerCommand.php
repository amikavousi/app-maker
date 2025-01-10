<?php

namespace AmiKavousi\AppMaker\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class AppMakerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add
    {appName : Your App Dir Name}
    {--c|controller : Create Controller for your App}
    {--M|model : Create Model for your App}
    {--m|migration : Create migration for your App}
    {--w|middleware : Create Middleware for your App}
    {--d|validation : Create Validation Middleware for your App}
    {--r|request : Create request for your App Controller}
    {name : Your File name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Models or Controllers or ... to your Laravel app with "php artisan app:add AppName -flag FileName" command.';
    /**
     * @var string
     */
    private $appPath;
    /**
     * @var array|string|null
     */
    private $fileName;
    /**
     * @var array|string|null
     */
    private $appName;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Exception
     */
    public function handle()
    {
        $this->appName = ucfirst($this->argument('appName'));
        $this->appPath = "App\\\../modules/" . $this->appName;
        $this->fileName = $this->argument('name');


        if ($this->option('controller')) {
            $this->addController();
        } elseif ($this->option('model')) {
            $this->addModel();
        } elseif ($this->option('migration')) {
            $this->addMigrations();
        } elseif ($this->option('middleware')) {
            $this->addMiddleware();
        } elseif ($this->option('validation')) {
            $this->addValidation();
        } elseif ($this->option('request')) {
            $this->addRequest();
        } else {
            $this->error('command NotFound');
            return 1;
        }

        return 0;
    }

    private function addController()
    {
        $controller = base_path("modules/$this->appName/Http/Controller/$this->fileName.php");
        if (!file_exists($controller)) {
            Artisan::call("make:controller $this->appPath/Http/Controller/$this->fileName");
            (new Filesystem())->replaceInFile("App\..\modules\\$this->appName\Http\Controller", "Modules\\$this->appName\Http\Controller", $controller);
            $this->info('Successfully Created');
        } else {
            throw new Exception('Controller is Exist on ' . $controller);
        }
    }

    private function addModel()
    {
        $model = base_path("Modules/$this->appName/Model/$this->fileName.php");
        if (!file_exists($model)) {
            Artisan::call("make:model $this->appPath/Model/$this->fileName");
            (new Filesystem())->replaceInFile("App\..\modules\\$this->appName\Model", "Modules\\$this->appName\Model", $model);
            $this->info('Successfully Created');
        } else {
            throw new Exception('Model is Exist on ' . $model);
        }
    }

    private function addMigrations()
    {
        Artisan::call("make:migration $this->fileName --path=/Modules/$this->appName/database/migrations");
        $this->info('Successfully Created');

    }

    private function addMiddleware()
    {
        $middlewares = base_path("Modules/$this->appName/Http/Middlewares/$this->fileName.php");
        if (!file_exists($middlewares)) {
            Artisan::call("make:middleware $this->appPath/Http/Middlewares/$this->fileName");
            (new Filesystem())->replaceInFile("App\..\modules\\$this->appName\Http\Middlewares", "Modules\\$this->appName\Http\Middlewares", $middlewares);
            $this->info('Successfully Created');
        } else {
            throw new Exception('Middleware is Exist on ' . $middlewares);
        }
    }

    private function addValidation()
    {
        $validation = base_path("Modules/$this->appName/Http/Middlewares/");
        if (!file_exists($validation . $this->fileName . 'Validation.php')) {
            (new Filesystem())->ensureDirectoryExists($validation);
            (new Filesystem())->copy(__DIR__ . '/../../stubs/app/Http/Middlewares/ExampleValidation.php',
                $validation . $this->fileName . 'Validation.php');
            (new Filesystem())->replaceInFile('AppName', $this->appName, $validation . $this->fileName . 'Validation.php');
            (new Filesystem())->replaceInFile('Example', $this->fileName, $validation . $this->fileName . 'Validation.php');
            $this->info('Successfully Created');
        } else {
            throw new Exception('Validation is Exist on ' . $validation);
        }
    }

    private function addRequest()
    {
        $request = base_path("Modules/$this->appName/Http/Requests/$this->fileName.php");
        if (!file_exists($request)) {
            Artisan::call("make:request $this->appPath/Http/Requests/$this->fileName");
            (new Filesystem())->replaceInFile("App\..\modules\\$this->appName\Http\Requests", "Modules\\$this->appName\Http\Requests", $request);
            $this->info('Successfully Created');
        } else {
            throw new Exception('Middleware is Exist on ' . $request);
        }
    }
}
