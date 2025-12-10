<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\Metadata;

use CCT\SDK\Campaign\Data\Metadata\Agent\Agent;
use CCT\SDK\Campaign\Data\Metadata\Agent\Agents;
use CCT\SDK\Campaign\Data\Metadata\Generic\GenericItem;
use CCT\SDK\Campaign\Data\Metadata\Generic\GenericItems;
use CCT\SDK\Campaign\Data\Metadata\Generic\GenericKey;
use CCT\SDK\Campaign\Data\Metadata\Metadata;
use PHPUnit\Framework\TestCase;

final class MetadataTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = MetadataData::dataWithOverride();

        $metadata = Metadata::fromArray($data);

        $this->assertInstanceOf(Agents::class, $metadata->agents);
        $this->assertCount(1, $metadata->agents);
        $this->assertInstanceOf(GenericItems::class, $metadata->generic);
        $this->assertCount(2, $metadata->generic);
    }

    public function testFromArrayWithOnlyAgents(): void
    {
        $data = [
            'agents' => [
                [
                    'email' => 'agent@example.com',
                    'name' => 'John Doe',
                    'phone' => null,
                    'image' => null,
                    'type' => null,
                ],
            ],
        ];

        $metadata = Metadata::fromArray($data);

        $this->assertInstanceOf(Agents::class, $metadata->agents);
        $this->assertCount(1, $metadata->agents);
        $this->assertNull($metadata->generic);
    }

    public function testFromArrayWithOnlyGeneric(): void
    {
        $data = [
            'agents' => null,
            'generic' => [
                ['key' => 'budget', 'value' => '50000'],
            ],
        ];

        $metadata = Metadata::fromArray($data);

        $this->assertNull($metadata->agents);
        $this->assertInstanceOf(GenericItems::class, $metadata->generic);
        $this->assertCount(1, $metadata->generic);
    }

    public function testToArray(): void
    {
        $agent = new Agent(
            'agent@example.com',
            'John Doe',
            '+1234567890',
            null,
            'principal'
        );
        $agents = Agents::fromItems($agent);

        $genericItem1 = new GenericItem(GenericKey::BUDGET, '50000');
        $genericItem2 = new GenericItem(GenericKey::ADDITIONAL_SPENDING, '10000');
        $genericItems = GenericItems::fromItems($genericItem1, $genericItem2);

        $metadata = new Metadata($agents, $genericItems);

        $result = $metadata->toArray();

        $this->assertArrayHasKey('agents', $result);
        $this->assertArrayHasKey('generic', $result);
        $this->assertCount(1, $result['agents']);
        $this->assertCount(2, $result['generic']);
        $this->assertEquals('budget', $result['generic'][0]['key']);
        $this->assertEquals('50000', $result['generic'][0]['value']);
    }

    public function testToArrayWithNullGeneric(): void
    {
        $agent = new Agent(
            'agent@example.com',
            'John Doe',
            null,
            null,
            null
        );
        $agents = Agents::fromItems($agent);

        $metadata = new Metadata($agents, null);

        $result = $metadata->toArray();

        $this->assertArrayHasKey('agents', $result);
        $this->assertArrayHasKey('generic', $result);
        $this->assertNull($result['generic']);
    }

    public function testEquals(): void
    {
        $metadata1 = MetadataData::createObject();
        $metadata2 = MetadataData::createObject();
        $metadata3 = MetadataData::createObject([
            'generic' => [
                ['key' => 'budget', 'value' => '99999'],
            ],
        ]);

        $this->assertTrue($metadata1->equals($metadata2));
        $this->assertFalse($metadata1->equals($metadata3));
    }
}
