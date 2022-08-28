<?php

namespace App\Shared\Domain\ValueObject;

class ArrayValueObject implements ValueObjectInterface
{
    public function __construct(protected array $value)
    {
    }

    public function value(): array
    {
        return $this->value;
    }
}
