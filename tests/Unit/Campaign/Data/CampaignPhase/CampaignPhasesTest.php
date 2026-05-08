<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\CampaignPhase;

use CCT\SDK\Campaign\Data\CampaignPhase\CampaignPhases;
use CCT\SDK\Campaign\Data\CampaignPhase\OpenHouse;
use CCT\SDK\Campaign\Data\CampaignPhase\Phases;
use PHPUnit\Framework\TestCase;

final class CampaignPhasesTest extends TestCase
{
    public function testRoundTripMatchesBackendShape(): void
    {
        $data = [
            'phases' => [
                [
                    '_type' => 'open_house',
                    'start_date' => '2019-02-02T16:00:00+00:00',
                    'end_date' => '2019-02-02T18:00:00+00:00',
                ],
            ],
        ];

        $campaignPhases = CampaignPhases::fromArray($data);

        $this->assertInstanceOf(Phases::class, $campaignPhases->phases);
        $this->assertCount(1, $campaignPhases->phases);
        $this->assertInstanceOf(OpenHouse::class, $campaignPhases->phases->first());

        $serialised = $campaignPhases->toArray();
        $this->assertArrayHasKey('phases', $serialised);
        $this->assertSame('open_house', $serialised['phases'][0]['_type']);
        $this->assertSame('2019-02-02T16:00:00+00:00', $serialised['phases'][0]['start_date']);
        $this->assertSame('2019-02-02T18:00:00+00:00', $serialised['phases'][0]['end_date']);
    }

    public function testFromItems(): void
    {
        $campaignPhases = new CampaignPhases(
            Phases::fromItems(new OpenHouse(
                new \DateTimeImmutable('2026-05-07T10:00:00+00:00'),
                new \DateTimeImmutable('2026-05-07T12:00:00+00:00')
            ))
        );

        $this->assertCount(1, $campaignPhases->phases);
    }
}
