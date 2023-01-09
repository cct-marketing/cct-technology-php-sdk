<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Context extends AbstractMulti
{
    private function __construct(public readonly ?string $id, public readonly string $name)
    {
    }

    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'name', null, '');

        return new self($data['id'] ?? null, $data['name']);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
         ];
    }
}
