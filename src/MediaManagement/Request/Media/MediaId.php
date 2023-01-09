<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractUuid;
use Ramsey\Uuid\Uuid;

final class MediaId extends AbstractUuid
{
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'id', self::errorPropertyPath());

        return new self(Uuid::fromString($data['id']));
    }

    public static function create(): self
    {
        return new self(Uuid::uuid4());
    }

    public function toArray(): array
    {
        return [
            'id' => $this->value->toString(),
        ];
    }
}
