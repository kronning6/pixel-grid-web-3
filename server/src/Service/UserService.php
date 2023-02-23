<?php

namespace App\Service;

use App\Entity\Role;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class UserService
{

    private RoleService $roleService;
    private UserRepository $userRepository;

    public function __construct(
        RoleService $roleService,
        UserRepository $userRepository
    ) {
        $this->roleService = $roleService;
        $this->userRepository = $userRepository;
    }

    public function createUser(Request $request): ?User
    {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $role = $this->roleService->getRole((int) $data['roleId']);
        if (!$role) {
            return null;
        }
        $user = new User();
        $user->setEmail($data['email']);
        $user->setRole($role);
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);
        $this->userRepository->save($user, true);
        return $user;
    }

    /**
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function getUser(int $userId): ?User
    {
        return $this->userRepository->find($userId);
    }

    public function updateUser(int $userId, Request $request): ?User
    {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $email = $data['email'] ?? null;
        $firstName = $data['firstName'] ?? null;
        $lastName = $data['lastName'] ?? null;
        $backgroundColor = $data['bgColor'] ?? null;
        $foregroundColor = $data['fgColor'] ?? null;


        $user = $this->userRepository->find($userId);
        if (!$user) {
            return null;
        }
        if ($email) {
            $user->setEmail($email);
        }
        if ($firstName) {
            $user->setFirstName($firstName);
        }
        if ($lastName) {
            $user->setLastName($lastName);
        }
        if ($backgroundColor) {
            $user->setBgColor($backgroundColor);
        }
        if ($foregroundColor) {
            $user->setFgColor($foregroundColor);
        }
        $this->userRepository->save($user, true);
        return $user;
    }

    public function deleteUser(int $userId): bool
    {
        $user = $this->userRepository->find($userId);
        if (!$user) {
            return false;
        }
        $this->userRepository->remove($user, true);
        return true;
    }
}
