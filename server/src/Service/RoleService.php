<?php

namespace App\Service;

use App\DataTransferObject\Outgoing\RoleDto;
use App\Entity\Role;
use App\Entity\User;
use App\Repository\RoleRepository;
use Symfony\Component\HttpFoundation\Request;

class RoleService
{

    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function createRole(Request $request): ?Role
    {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $role = new Role();
        $role->setName($data['name']);
        $this->roleRepository->save($role, true);
        return $role;
    }

    /**
     * @return Role[]
     */
    public function getRoles(): array
    {
        return $this->roleRepository->findAll();
    }

    public function getRole(int $roleId): ?Role
    {
        return $this->roleRepository->find($roleId);
    }

    public function updateRole(int $roleId, Request $request): ?Role
    {

        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $role = $this->roleRepository->find($roleId);
        if (!$role) {
            return null;
        }
        $role->setName($data['name']);
        $this->roleRepository->save($role, true);
        return $role;
    }

    public function deleteRole(int $roleId): bool
    {
        $role = $this->roleRepository->find($roleId);
        if (!$role) {
            return false;
        }
        $this->roleRepository->remove($role, true);
        return true;
    }

    public function transformToDto(Role $role): RoleDto {
        return new RoleDto($role->getId(), $role->getName());
    }
}
