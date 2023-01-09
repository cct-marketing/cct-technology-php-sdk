<?php

declare(strict_types=1);

namespace CCT\SDK\MediaManagement\ViewModel;

use CCT\SDK\Infrastucture\ValueObject\AbstractCollection;

final class ContextCollection extends AbstractCollection
{
    public function toFormParams(): array
    {
        return array_map(static function (Context $context) {
            return ['name' => $context->name];
        }, $this->items);
    }

    public function containsName(string $name): bool
    {
        foreach ($this->items as $existingContext) {
            if ($existingContext->name === $name) {
                return true;
            }
        }

        return false;
    }

    protected static function itemClassName(): string
    {
        return Context::class;
    }
}
