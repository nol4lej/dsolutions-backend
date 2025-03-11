<?php

namespace App\Config;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

return [
    'TOKEN' => $_ENV['API_TOKEN'],
];