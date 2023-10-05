# Access the ControlD API in your Laravel application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rapkis/laravel-controld.svg?style=flat-square)](https://packagist.org/packages/rapkis/laravel-controld)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/rapkis/laravel-controld/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/rapkis/laravel-controld/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/rapkis/laravel-controld/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/rapkis/laravel-controld/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/rapkis/laravel-controld.svg?style=flat-square)](https://packagist.org/packages/rapkis/laravel-controld)

Access the ControlD API in your Laravel application.

This is **not** an official package and is purely a third-party API client.
Any service-related issues should be directed towards the service provider itself.

## Installation

You can install the package via composer:

```bash
composer require rapkis/laravel-controld
```

You should publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-controld-config"
```

This is the contents of the published config file:

```php
return [
    'url' => env('CONTROL_D_API_URL'),
    'secret' => env('CONTROL_D_API_SECRET'),
    'middleware' => [
        'request' => [],
        'response' => [ControlDErrorHandlerMiddleware::class],
    ],
];
```
Make sure to define the ControlD endpoint and your API token in the .env file.
You can also set up middleware classes that will be applied to your HTTP requests and responses (see [Middleware](#middleware)).

## Usage

To access the ControlD API you first need to have an account created. Visit [controld.com](https://controld.com/).
Make sure you're familiar with their 
[documentation](https://docs.controld.com/) and [API reference](https://docs.controld.com/reference).
The package assumes you understand with how the service and the API work.

## Quick Start

The main class you'll be working with is `\Rapkis\Controld\ControlD`.
You can access all ControlD endpoints by using its methods. 
Endpoints are organized according to the documentation for ease of use.

Start by instantiating it:
```php
$controlD = app(\Rapkis\Controld\ControlD::class); // or use DI
```

`\Rapkis\Controld\ControlD` depends on Laravel's HTTP client, 
which is configured automatically via `\Rapkis\Controld\ControlDFactory`.
To make things simple, it is recommended to resolve it via 
Laravel's [Service Container](https://laravel.com/docs/10.x/container) (a.k.a. `app()`, Dependency Injection, etc.) 
to instantiate the `\Rapkis\Controld\ControlD` class. 
It's already pre-configured in `\Rapkis\Controld\ControldServiceProvider`.

Now, you can make API requests

```php
// Lists all profiles of your account: https://docs.controld.com/reference/get_profiles
$controlD->profiles()->list();

// Create a new profile: https://docs.controld.com/reference/post_profiles
$profile = $controlD->profiles()->create('My Profile Name'); // returns \Rapkis\Controld\Responses\Profile

// Create a new device that uses your new profile: https://docs.controld.com/reference/post_devices
$device = $controlD->devices()->create(
    'Device Name', // the name of your device
    $profile->pk, // the profile it will use
    'router', // the icon (type) of your device. Purely visual.
); // returns \Rapkis\Controld\Responses\Device
```

## General structure

In a nutshell, the package is made up of "Resources" and "Responses".
Resource classes are used to make HTTP requests and then JSON responses are mapped to Response classes. 
These classes are basic DTOs (data transfer objects) which are easier to work with than basic arrays: 
you don't have to guess array keys and can immediately understand the response structure.

Each method in the `\Rapkis\Controld\ControlD` class corresponds to the appropriate Resource class (`\Rapkis\Controld\Resources`).
Resource classes make the requests and map the responses to the response classes. Usually with the help of factory classes.

## Middleware

Just like with the Laravel's HTTP client (or Guzzle), you can add middlware to interact with your requests and responses.
You can check how they work in the [Laravel documentation](https://laravel.com/docs/10.x/http-client#guzzle-middleware)

For example, this package handles ControlD specific errors with `\Rapkis\Controld\Middleware\ControlDErrorHandlerMiddleware`.
Instead of parsing the JSON response somewhere in your code, 
you can parse it in the middleware class and handle your errors **before** returning a response.

Feel free to modify the middleware or add your own! For example, you can have middleware which 
renders error-specific exceptions instead of the generic one.
Alternatively, if you're running [an organization](https://docs.controld.com/docs/organizations), 
you can add the impersonation header (`X-Force-Org-Id: org_id_goes_here`) directly via middleware.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Rapolas Gruzdys](https://github.com/rapkis)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
