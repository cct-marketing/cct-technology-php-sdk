<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\Assert;

use CCT\SDK\Infrastucture\ValueObject\ValueObjectInterface;

final class PropertyPathProxy
{
    private ValueObjectInterface $valueObject;

    public function __construct(ValueObjectInterface $valueObject)
    {
        $this->valueObject = $valueObject;
    }

    public function __toString(): string
    {
        return $this->valueObject->errorPropertyPath();
    }
}
