<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\ValueObject;

use Assert\Assertion;

abstract class AbstractEnabled extends AbstractMulti
{
    public function __construct(public readonly Enabled $enabled)
    {
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
