<?php

namespace App\Users\Domain\Entity\ValueObject;

use App\Shared\Domain\ValueObject\ArrayValueObject;
use Doctrine\DBAL\Exception\InvalidArgumentException;

class UserRoles extends ArrayValueObject
{
    public const ALLOWED_ROLES = [
        'admin' => 'ROLE_ADMIN',
        'developer' => 'ROLE_DEVELOPER',
        'user' => 'ROLE_USER'
    ];

    public function __construct(protected array $value)
    {
        if (!$this->validate()) {
            throw new InvalidArgumentException('Invalid role');
        }
        parent::__construct($this->value);
    }

    private function validate(): bool
    {
        if (empty($this->value)) {
            return true;
        }
        $allowedRoles = array_values(self::ALLOWED_ROLES);
        return in_array($this->value[0], $allowedRoles);
    }

    public function getRole()
    {
        return $this->value[0] ?? '';
    }

}