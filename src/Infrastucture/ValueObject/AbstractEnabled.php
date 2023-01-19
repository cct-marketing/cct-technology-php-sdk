<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

use Assert\Assertion;
use CCT\SDK\Infrastucture\Serialization\Caster\CastToSingleValueObject;

abstract class AbstractEnabled extends AbstractMulti
{
    public function __construct(
        #[CastToSingleValueObject(Enabled::class)]
        public readonly Enabled $enabled
    ) {
    }

    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled->toBool(),
        ];
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'enabled', '', static::errorPropertyPath());

        return new static(Enabled::fromMixed($data['enabled']));
    }

    public function isEnabled(): bool
    {
        return $this->enabled->toBool();
    }
}
