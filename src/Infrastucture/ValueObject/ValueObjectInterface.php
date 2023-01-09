<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

interface ValueObjectInterface
{
    public static function errorPropertyPath(): string;

    public function toString(): string;
}
