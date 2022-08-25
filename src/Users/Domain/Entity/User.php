<?php

namespace App\Users\Domain\Entity;

use App\Shared\Domain\Security\AuthUserInterface;
use App\Users\Domain\Service\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements AuthUserInterface, UserInterface
{
    private int $id;

    private string $first_name;
    private string $last_name;
    private string $mid_name;
    private string $phone;
    private string $slack_id;
    private string $login;

    private string $auth_key;
    private string $password;

    public function __construct($login)
    {
        $this->login = $login;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setPassword($password, UserPasswordHasherInterface $passwordHasher)
    {
        $this->password = $passwordHasher->hash($this, $password);
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->id;
    }
}