<?php

namespace App\DataTransferObject\Outgoing;

class RoleDto
{
    private int $roleId;
    private string $name;

    public function __construct(int $roleId, string $name)
    {
        $this->roleId = $roleId;
        $this->name = $name;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
