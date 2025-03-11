<?php

namespace App\Service;

use App\Repository\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function createUser($data)
    {
        return $this->userRepository->createUser($data);
    }

    public function updateUser($id, $data)
    {
        return $this->userRepository->updateUser($id, $data);
    }

    public function deleteUser($id)
    {
        if (!$this->userRepository->getUserById($id)) {
            return false;
        }
        return $this->userRepository->deleteUser($id);
    }
}