# Waite Tool
Waite is Laravel based self-application updating library. If you want to update your codes from your application, You can simply use Waite.

## Installation
You can install the package via composer:

```sh
composer require kaankilic/kaankilic
```
or require the tool in your **composer.json** file.
```sh
"kaankilic/kaankilic": "^1.0"
```
then run `composer install` command from your command line.

Once **Waite** is installed you need to register the service provider.Open up **config/app.php** and add the provider key of tool.
```php
'providers' => array(
	...
    Kaankilic\Waite\Providers\WaiteServiceProvider::class,
)
```
After that, you need to register the facade in the aliases key of your config/app.php file.
```php
'aliases' => array(
	... aliases
	'Waite'=> Kaankilic\ServerUp\Facades\Waite::class,
)
```

Finally, from the command line again, publish the default configuration file:

```php
php artisan vendor:publish --provider="Kaankilic\ServerUp\Providers\ServerUpServiceProvider"
```

## Usage
**Simple Usage**
```php
	Waite::update();
```