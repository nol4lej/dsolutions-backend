<?php

namespace App\Config;
use App\Middleware\AuthMiddleware;
use Slim\App;

return function (App $app, array $env) {
    $app->add(new AuthMiddleware($env['TOKEN']));

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response->withHeader('Content-Type', 'application/json');
    });
};