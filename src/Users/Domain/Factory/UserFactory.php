<?php

namespace App\Users\Domain\Factory;

use App\Users\Domain\Service\UserPasswordHasherInterface;
use App\Users\Domain\Entity\User;
class UserFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function create($login, $password): User
    {
        $user = new User($login);
        $user->setPassword($password, $this->passwordHasher);
        return $user;
    }
}