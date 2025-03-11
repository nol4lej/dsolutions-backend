<?php

namespace App\Config;

use PDO;

class Database
{
    private static ?PDO $pdo = null;

    public static function getPDO(): PDO
    {
        if (self::$pdo === null) {
            try {
                $databasePath = __DIR__ . '/../../db/sqlite.db';
                self::$pdo = new PDO("sqlite:" . $databasePath);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                error_log("Error de conexión a SQLite: " . $e->getMessage());
                throw $e;
            }
        }
        return self::$pdo;
    }
}