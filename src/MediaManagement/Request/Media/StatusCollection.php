<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\Request\Media;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;
use CCT\SDK\MediaManagement\ViewModel\Status;

final class StatusCollection extends AbstractCollection
{
    public static function fromArray(array $data): static
    {
        return new self(array_map(static function (string $status) {
            return Status::from($status);
        }, $data));
    }

    public function toArray(): array
    {
        return array_map(
            static function (Status $status) {
                return $status->value;
            },
            $this->items
        );
    }

    protected static function itemClassName(): string
    {
        return Status::class;
    }
}
