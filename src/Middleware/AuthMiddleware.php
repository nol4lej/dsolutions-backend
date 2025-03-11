<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;

class AuthMiddleware
{
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function __invoke(Request $request, Handler $handler): Response
    {
        $headerToken = $request->getHeaderLine('Authorization');

        if ($headerToken !== $this->token) {
            $response = new \Slim\Psr7\Response();
            $response->getBody()->write(json_encode(['error' => 'Token inválido']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        return $handler->handle($request);
    }
}