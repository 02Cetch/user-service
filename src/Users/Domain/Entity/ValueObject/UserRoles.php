<?php

namespace App\Users\Domain\Entity\ValueObject;

use App\Shared\Domain\ValueObject\ArrayValueObject;

class UserRoles extends ArrayValueObject
{
    public const ALLOWED_ROLES = [
        'admin' => 'ROLE_ADMIN',
        'user' => 'ROLE_USER'
    ];
}