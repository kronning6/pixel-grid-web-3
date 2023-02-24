<?php

namespace App\Controller;

use App\DataTransferObject\Incoming\CreateUserDto;
use App\Exception\InvalidRequestDataException;
use JsonException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Serialization\SerializationService;
use App\Service\UserService;

class UserController extends ApiController
{
    private UserService $userService;

    public function __construct(
        SerializationService $serializationService,
        UserService $userService
    ) {
        parent::__construct($serializationService);
        $this->userService = $userService;
    }

    /**
     * @throws JsonException
     * @throws InvalidRequestDataException
     */
    #[Route('/api/users', methods: ['POST'])]
    public function createInstance(Request $request, LoggerInterface $logger): Response {
        /** @var CreateUserDto $dto */
        $dto = $this->getValidatedDto($request, CreateUserDto::class);
        return $this->json($this->userService->createUser($dto));
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
