<?php

namespace App\Controller;

use App\Service\RoleService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoleController extends ApiController
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    #[Route('/api/roles', methods: ['POST'])]
    public function createInstance(Request $request): Response {
        return $this->json($this->roleService->createRole($request));
    }

    #[Route('/api/roles', methods: ['GET'])]
    public function getCollection(): Response {
        return $this->json($this->roleService->getRoles());
    }

    #[Route('/api/roles/{roleId}', methods: ['GET'])]
    public function getInstance(int $roleId): Response {
        return $this->json($this->roleService->getRole($roleId));
    }

    #[Route('/api/roles/{roleId}', methods: ['PATCH', 'PUT'])]
    public function updateInstance(int $roleId, Request $request): Response {
        return $this->json($this->roleService->updateRole($roleId, $request));
    }

    #[Route('/api/roles/{roleId}', methods: ['DELETE'])]
    public function deleteInstance(int $roleId): Response {
        return $this->json($this->roleService->deleteRole($roleId));
    }
}
