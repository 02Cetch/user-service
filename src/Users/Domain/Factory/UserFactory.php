<?php

namespace App\Users\Domain\Factory;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Service\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function create($login, $password, array $roles = []): User
    {
        $user = new User($roles);
        $user->setLogin($login);
        $user->setPassword($password, $this->passwordHasher);

        return $user;
    }
}
