<?php

namespace App\DataTransferObject\Incoming;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class CreateUserDto
{
    #[NotNull]
    #[Type('int')]
    private int $roleId;

    #[NotNull]
    #[Type('string')]
    private string $email;

    #[NotNull]
    #[Type('string')]
    private string $firstName;

    #[NotNull]
    #[Type('string')]
    private string $lastName;

    #[Type('string')]
    private ?string $fgColor;

    #[Type('string')]
    private ?string $bgColor;

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     */
    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string|null
     */
    public function getFgColor(): ?string
    {
        return $this->fgColor;
    }

    /**
     * @param string|null $fgColor
     */
    public function setFgColor(?string $fgColor): void
    {
        $this->fgColor = $fgColor;
    }

    /**
     * @return string|null
     */
    public function getBgColor(): ?string
    {
        return $this->bgColor;
    }

    /**
     * @param string|null $bgColor
     */
    public function setBgColor(?string $bgColor): void
    {
        $this->bgColor = $bgColor;
    }


}
