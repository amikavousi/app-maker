# AppMaker
With AppMaker You can create the Apps or Modules you want for your Laravel Application.
<br><b>Version: 2.0.0 dev</b>

## Installation
Open your Terminal in your project dir and run:
```bash 
composer require amikavousi/app-maker
```
## Usage
1) Now you can use this command for Create new App or Module :
```bash
php artisan app:make AppName
```
2) You can now see a new directory called 'Module' in your Laravel project where your added apps are located. But before you can access the added apps, you must first add the 'Modules' directory to your composer.json autoload:

![composer](https://raw.githubusercontent.com/amikavousi/images/main/carbon.png)

!!!! Then Run !!! :
```bash
composer dump-autoload
```

3) To access your added app, you must add your <b>Module Service Provider</b> located at ` Modules/ModulesProvider/ModulesServiceProvider.php` class to the `app.php` file in the 'config' directory:

![app.php](https://raw.githubusercontent.com/amikavousi/images/main/app-php-v2.png)
know your Modules service provider add to <b>ModulesServiceProvider.php</b> automatically.
4) To test your app, simply run ` php artisan serve ` in your terminal. Then, open your browser and visit `localhost:8000/AppName/AppName`. You will see:

![test.php](https://raw.githubusercontent.com/amikavousi/images/main/Screen%20Shot%202023-08-04%20at%2012.29.23%20AM.png)


## Comands
after you run `php artisan app:add -h` you will see a good documentation about commands and available **options**:
```bash
Description:
  With this command you can add your Models or Controller or ... to your Apps.
    Command Format: php artisan app:add AppName -flag FileName

Usage:
  app:add [options] [--] <appName> <name>

Arguments:
  appName               Your App Dir Name
  name                  Your File name

Options:
  -c, --controller      Create Controller for your App
  -M, --model           Create Model for your App
  -m, --migration       Create migration for your App
  -w, --middleware      Create Middleware for your App
  -d, --validation      Create Validation Middleware for your App
```
For Example for add a new **Controller** to your **App** you can use this command:
```bash
php artisan app:add AppName -c FileNameForController
-------------------------or--------------------------
php artisan app:add AppName --controller FileName
```
## The last word
We sincerely appreciate your consideration in giving us a **shining star** if you find our efforts valuable. 🫶🏻🌟🤍

Your support and recognition serve as a true inspiration to us. 🤜🏻🤛🏿

We highly value your feedback and encourage you to share any concerns or suggestions you may have. 🙏🏻

Our commitment is to promptly address any issues and create a delightful experience for you.

Your contributions through pull requests are truly cherished as we work together harmoniously to elevate this project to new heights. 👥

So we conclude that it works 🌈 - Kian Pirfalak

Support Email: **AmiKavousi@gmail.com**
