<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

interface ValueObjectInterface
{
    /**
     * Verifies whether the specific object equals this one.
     */
    public function equals(ValueObjectInterface $valueObject): bool;
}
