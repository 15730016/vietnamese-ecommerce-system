<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Http\Request as HttpRequest;

// Bootstrap Laravel and handle the request...
/** @var LaravelApplication $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = HttpRequest::capture()
);

$response->send();

$kernel->terminate($request, $response);
