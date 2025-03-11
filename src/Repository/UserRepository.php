<?php

namespace App\Repository;

use App\Config\Database;
use PDO;

class UserRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPDO();
    }

    public function getAllUsers()
    {
        $stmt = $this->pdo->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (id, name, last_name, email, state) VALUES (:id, :name, :last_name, :email, :state)');
        $stmt->execute([
            'id' => $data['id'],
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'state' => $data['state']
        ]);
        return $this->getUserById($data['id']);
    }

    public function updateUser($id, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE users SET name = :name, last_name = :last_name, email = :email, state = :state WHERE id = :id');
        $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'state' => $data['state']
        ]);
        return $this->getUserById($id);
    }

    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}