<?php

namespace App\Users\Domain\Entity;

use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;
use App\Shared\Domain\Security\AuthUserInterface;

interface UserInterface extends BaseUserInterface, AuthUserInterface
{

}