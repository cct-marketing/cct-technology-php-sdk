<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\CampaignPhase;

use CCT\SDK\Campaign\Data\CampaignPhase\OpenHouse;
use CCT\SDK\Campaign\Data\CampaignPhase\Phases;
use PHPUnit\Framework\TestCase;

final class PhasesTest extends TestCase
{
    public function testFromArrayPreservesTypeDiscriminator(): void
    {
        $phases = Phases::fromArray([
            [
                '_type' => 'open_house',
                'start_date' => '2019-02-02T16:00:00+00:00',
                'end_date' => '2019-02-02T18:00:00+00:00',
            ],
        ]);

        $this->assertCount(1, $phases);
        $this->assertInstanceOf(OpenHouse::class, $phases->first());
    }

    public function testToArrayReinjectsTypeDiscriminator(): void
    {
        $phases = Phases::fromItems(new OpenHouse(
            new \DateTimeImmutable('2019-02-02T16:00:00+00:00'),
            new \DateTimeImmutable('2019-02-02T18:00:00+00:00')
        ));

        $this->assertSame(
            [
                [
                    'start_date' => '2019-02-02T16:00:00+00:00',
                    'end_date' => '2019-02-02T18:00:00+00:00',
                    '_type' => 'open_house',
                ],
            ],
            $phases->toArray()
        );
    }

    public function testEmptyList(): void
    {
        $this->assertCount(0, Phases::emptyList());
    }
}
