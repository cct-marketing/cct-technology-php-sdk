<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Metadata\Agent;

use CCT\SDK\Campaign\Data\AdContent\Image\Image;
use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Agent extends AbstractMulti
{
    public function __construct(
        public readonly string $email,
        public readonly ?string $name,
        public readonly ?string $phone,
        public readonly ?Image $image,
        public readonly ?string $type
    ) {
        Assertion::email($email, self::errorPropertyPath());
    }
}
