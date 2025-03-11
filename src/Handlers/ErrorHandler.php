<?php

namespace App\Handlers;

use Slim\App;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Response;

return function (App $app) {
    $app->add(function ($request, $handler) {
        try {
            return $handler->handle($request);
        } catch (HttpNotFoundException $e) {
            $response = new Response();
            $response->getBody()->write(json_encode(['error' => 'Error interno del servidor']));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    });
};