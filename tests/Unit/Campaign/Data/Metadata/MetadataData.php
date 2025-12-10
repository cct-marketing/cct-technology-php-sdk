<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Metadata;

use CCT\SDK\Campaign\Data\Metadata\Metadata;

final class MetadataData
{
    public static function dataWithOverride(array $data = []): array
    {
        return array_merge(
            [
                'agents' => [
                    [
                        'email' => 'agent@example.com',
                        'name' => 'John Doe',
                        'phone' => '+1234567890',
                        'image' => null,
                        'type' => 'principal',
                    ],
                ],
                'generic' => [
                    ['key' => 'budget', 'value' => '50000'],
                    ['key' => 'additional_spending', 'value' => '10000'],
                ],
            ],
            $data
        );
    }

    public static function createObject(array $data = []): Metadata
    {
        return Metadata::fromArray(self::dataWithOverride($data));
    }
}
