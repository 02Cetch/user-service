<?php

namespace App\Users\Domain\Entity;

use App\Users\Domain\Service\UserPasswordHasherInterface;

class User implements UserInterface
{
    private int $id;
    private string $login;
    private string $password;
    private array $roles;

    public string $virtual_password;
    private string $virtual_role;

    public string $first_name;
    public string $last_name;
    public string $mid_name;
    public string $phone;
    public string $slack_id;

    public function __construct(array $roles = [])
    {
        $this->roles = $roles;
    }

    public function setLogin($login): void
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

    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getVirtualRole()
    {
        return array_values($this->roles)[0] ?? $this->virtual_role;
    }

    public function setVirtualRole($role)
    {
        $this->virtual_role = $role;
        $this->setRoles([$role]);
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserIdentifier(): string
    {
        return $this->id;
    }
}