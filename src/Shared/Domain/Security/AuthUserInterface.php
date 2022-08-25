<?php

namespace App\Shared\Domain\Security;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

interface AuthUserInterface extends PasswordAuthenticatedUserInterface
{
    public function getLogin(): string;
}