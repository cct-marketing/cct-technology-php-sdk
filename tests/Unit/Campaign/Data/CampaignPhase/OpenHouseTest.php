<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\CampaignPhase;

use CCT\SDK\Campaign\Data\CampaignPhase\OpenHouse;
use PHPUnit\Framework\TestCase;

final class OpenHouseTest extends TestCase
{
    public function testFromArray(): void
    {
        $openHouse = OpenHouse::fromArray([
            'start_date' => '2019-02-02T16:00:00+00:00',
            'end_date' => '2019-02-02T18:00:00+00:00',
        ]);

        $this->assertInstanceOf(\DateTimeInterface::class, $openHouse->startDate);
        $this->assertInstanceOf(\DateTimeInterface::class, $openHouse->endDate);
        $this->assertSame('2019-02-02T16:00:00+00:00', $openHouse->startDate->format(\DateTimeInterface::ATOM));
        $this->assertSame('2019-02-02T18:00:00+00:00', $openHouse->endDate->format(\DateTimeInterface::ATOM));
    }

    public function testToArray(): void
    {
        $openHouse = new OpenHouse(
            new \DateTimeImmutable('2019-02-02T16:00:00+00:00'),
            new \DateTimeImmutable('2019-02-02T18:00:00+00:00')
        );

        $this->assertSame(
            [
                'start_date' => '2019-02-02T16:00:00+00:00',
                'end_date' => '2019-02-02T18:00:00+00:00',
            ],
            $openHouse->toArray()
        );
    }

    public function testLengthInDays(): void
    {
        $openHouse = new OpenHouse(
            new \DateTimeImmutable('2019-02-02T10:00:00+00:00'),
            new \DateTimeImmutable('2019-02-04T10:00:00+00:00')
        );

        $this->assertSame(3, $openHouse->lengthInDays());
    }

    public function testStartAfterEndIsRejected(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new OpenHouse(
            new \DateTimeImmutable('2019-02-02T18:00:00+00:00'),
            new \DateTimeImmutable('2019-02-02T16:00:00+00:00')
        );
    }

    public function testEquals(): void
    {
        $a = new OpenHouse(
            new \DateTimeImmutable('2019-02-02T16:00:00+00:00'),
            new \DateTimeImmutable('2019-02-02T18:00:00+00:00')
        );
        $b = new OpenHouse(
            new \DateTimeImmutable('2019-02-02T16:00:00+00:00'),
            new \DateTimeImmutable('2019-02-02T18:00:00+00:00')
        );
        $c = new OpenHouse(
            new \DateTimeImmutable('2019-03-01T16:00:00+00:00'),
            new \DateTimeImmutable('2019-03-01T18:00:00+00:00')
        );

        $this->assertTrue($a->equals($b));
        $this->assertFalse($a->equals($c));
    }
}
