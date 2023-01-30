<?php

declare(strict_types=1);

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\Google;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\GoogleResponsiveAdVariant;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\DescriptionCollection;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\LongHeadline;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Google\ResponsiveAd\ShortHeadlineCollection;
use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use PHPUnit\Framework\TestCase;

class GoogleResponsiveAdVariantTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = GoogleResponsiveAdVariantData::dataWithOverride();

        $variant = GoogleResponsiveAdVariant::fromArray($data);

        $this->assertInstanceOf(ShortHeadlineCollection::class, $variant->shortHeadlines);
        $this->assertInstanceOf(LongHeadline::class, $variant->longHeadline);
        $this->assertInstanceOf(DescriptionCollection::class, $variant->descriptions);
        $this->assertInstanceOf(ImageCollection::class, $variant->images);
    }

    public function testToArray(): void
    {
        $data = GoogleResponsiveAdVariantData::dataWithOverride();

        $variant = GoogleResponsiveAdVariant::fromArray($data);

        $this->assertSame($data, $variant->toArray());
    }
}
