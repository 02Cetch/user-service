<?php

namespace App\Shared\Domain\ValueObject;

class IntValueObject implements ValueObjectInterface
{
    public function __construct(private readonly int $value)
    {
    }

    public function value(): int
    {
        return $this->value;
    }
}