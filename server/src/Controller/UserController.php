<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends ApiController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/api/users', methods: ['POST'])]
    public function createInstance(Request $request): Response {
        return $this->json($this->userService->createUser($request));
    }

    #[Route('/api/users', methods: ['GET'])]
    public function getCollection(): Response {
        return $this->json($this->userService->getUsers());
    }

    #[Route('/api/users/{userId}', methods: ['GET'])]
    public function getInstance(int $userId): Response {
        return $this->json($this->userService->getUser($userId));
    }

    #[Route('/api/users/{userId}', methods: ['PATCH', 'PUT'])]
    public function updateInstance(int $userId, Request $request): Response {
        return $this->json($this->userService->updateUser($userId, $request));
    }

    #[Route('/api/users/{userId}', methods: ['DELETE'])]
    public function deleteInstance(int $userId): Response {
        return $this->json($this->userService->deleteUser($userId));
    }
}
