<?php

$app = require __DIR__ . '/src/Config/bootstrap.php';
$env = require __DIR__ . '/src/Config/env.php';

$middleware = require __DIR__ . '/src/Config/middleware.php';
$middleware($app, $env);

$errorHandler = require __DIR__ . '/src/Handlers/ErrorHandler.php';
$errorHandler($app);

$routeFiles = glob(__DIR__ . '/src/Routes/*.php');
foreach ($routeFiles as $routeFile) {
    $routes = require $routeFile;
    $routes($app);
}

$app->run();