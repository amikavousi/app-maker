# AppMaker
With AppMaker You can create the Apps or Modules you want for your Laravel Application.

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
Then Run :
```bash
composer dump-autoload
```

3) To access your added app, you must add your Service Provider located at ` Modules/YourAppName/Provider ` class to the `app.php` file in the 'config' directory:


![app.php](https://raw.githubusercontent.com/amikavousi/images/main/carbon%20(1).png)

4) To test your app, simply run ` php artisan serve ` in your terminal. Then, open your browser and visit `localhost:8000/AppName/AppName`. You will see:

    ![test](https://raw.githubusercontent.com/amikavousi/images/main/Screen%20Shot%202023-08-04%20at%2012.29.23%20AM.png)

## Comands
It will be completed soon... ;)
