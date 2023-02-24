<?php

namespace App\DataTransferObject\Outgoing;

class UserDto
{
    private int $userId;
    private RoleDto $role;
    private string $email;
    private string $firstName;
    private string $lastName;
    private ?string $fgColor;
    private ?string $bgColor;

    /**
     * @param int $userId
     * @param RoleDto $role
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     * @param string|null $fgColor
     * @param string|null $bgColor
     */
    public function __construct(int $userId, RoleDto $role, string $email, string $firstName, string $lastName, ?string $fgColor, ?string $bgColor)
    {
        $this->userId = $userId;
        $this->role = $role;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->fgColor = $fgColor;
        $this->bgColor = $bgColor;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return RoleDto
     */
    public function getRole(): RoleDto
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getFgColor(): ?string
    {
        return $this->fgColor;
    }

    /**
     * @return string|null
     */
    public function getBgColor(): ?string
    {
        return $this->bgColor;
    }



}
