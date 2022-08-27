<?php

namespace App\Users\Application\ContextAPI;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Entity\ValueObject\UserRoles;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Infrastructure\Service\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersAPI
{
    public function getEntityInstance($roles = []): User
    {
        return new User($roles);
    }

    public function getEntityFactory(UserPasswordHasherInterface $basePasswordHasher): UserFactory
    {
        return new UserFactory((new UserPasswordHasher($basePasswordHasher)));
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public static function getUserAllowedRoles(): array
    {
        return UserRoles::ALLOWED_ROLES;
    }
}