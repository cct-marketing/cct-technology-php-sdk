<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastructure\ValueObject\ValueObjectInterface;

interface CreateMediaInterface extends ValueObjectInterface
{
    public function toArray(): array;

    public function equals(ValueObjectInterface $valueObject): bool;
}
