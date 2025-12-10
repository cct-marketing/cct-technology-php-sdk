<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Metadata\Generic;

use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class GenericItem extends AbstractMulti
{
    public function __construct(
        public readonly GenericKey $key,
        public readonly string $value,
    ) {
    }
}
