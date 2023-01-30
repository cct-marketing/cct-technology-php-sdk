<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Context extends AbstractMulti
{
    public function __construct(public readonly ?string $id, public readonly string $name)
    {
    }
}
