<?php

namespace App\Controller;

use App\Service\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class UserController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index(Request $request, Response $response): Response
    {
        $usuarios = $this->userService->getAllUsers();
        $response->getBody()->write(json_encode($usuarios));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function show(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $usuario = $this->userService->getUserById($id);
        if (!$usuario) {
            $response->getBody()->write(json_encode(['error' => 'Usuario no encontrado']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }
        $response->getBody()->write(json_encode($usuario));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $errors = [];

        if (empty($data['id']) || !is_string($data['id'])) {
            $errors['id'] = 'El ID es requerido y debe ser una cadena.';
        }

        if (empty($data['name']) || !is_string($data['name']) || strlen($data['name']) > 255) {
            $errors['name'] = 'El nombre es requerido y debe ser una cadena de máximo 255 caracteres.';
        }

        if (empty($data['last_name']) || !is_string($data['last_name']) || strlen($data['last_name']) > 255) {
            $errors['last_name'] = 'El apellido es requerido y debe ser una cadena de máximo 255 caracteres.';
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'El email es requerido y debe ser válido.';
        }

        if (empty($data['state']) || !in_array($data['state'], ['ACTIVE', 'INACTIVE'])) {
            $errors['state'] = 'El estado es requerido y debe ser ACTIVE o INACTIVE.';
        }

        if (!empty($errors)) {
            $response->getBody()->write(json_encode(['errors' => $errors]));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        try {
            $usuario = $this->userService->createUser($data);
            $response->getBody()->write(json_encode($usuario));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        } catch (\Exception $exception) {
            $response->getBody()->write(json_encode(['error' => $exception->getMessage()]));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $data = $request->getParsedBody();

        $errors = [];

        if (isset($data['name']) && (!is_string($data['name']) || strlen($data['name']) > 255)) {
            $errors['name'] = 'El nombre debe ser una cadena de máximo 255 caracteres.';
        }

        if (isset($data['last_name']) && (!is_string($data['last_name']) || strlen($data['last_name']) > 255)) {
            $errors['last_name'] = 'El apellido debe ser una cadena de máximo 255 caracteres.';
        }

        if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'El email debe ser válido.';
        }

        if (isset($data['state']) && !in_array($data['state'], ['ACTIVE', 'INACTIVE'])) {
            $errors['state'] = 'El estado debe ser ACTIVE o INACTIVE.';
        }

        if (!empty($errors)) {
            $response->getBody()->write(json_encode(['errors' => $errors]));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        try {
            $usuario = $this->userService->updateUser($id, $data);
            if (!$usuario) {
                $response->getBody()->write(json_encode(['error' => 'Usuario no encontrado']));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }
            $response->getBody()->write(json_encode($usuario));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $exception) {
            $response->getBody()->write(json_encode(['error' => $exception->getMessage()]));
            return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
        }
    }

    public function destroy(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $usuario = $this->userService->getUserById($id);
        if (!$usuario){
            $response->getBody()->write(json_encode(['error' => 'Usuario no encontrado']));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }
        $this->userService->deleteUser($id);
        $response->getBody()->write(json_encode(['message' => 'Usuario eliminado']));
        return $response->withHeader('Content-Type', 'application/json');
    }
}