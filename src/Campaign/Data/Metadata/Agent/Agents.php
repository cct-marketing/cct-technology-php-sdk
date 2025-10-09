<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Metadata\Agent;

use CCT\SDK\Infrastructure\ValueObject\AbstractCollection;

final class Agents extends AbstractCollection
{
    /**
     * @param Agent[] $items
     */
    public function __construct(array $items)
    {
        parent::__construct($items);
    }

    public static function itemClassName(): string
    {
        return Agent::class;
    }
}
