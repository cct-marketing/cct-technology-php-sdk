<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\AdVariant\Facebook;

use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\DescriptionCollection;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\HeadingCollection;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\AiMultiVariantPart\TextCollection;
use CCT\SDK\Campaign\Data\AdContent\AdVariant\Facebook\FacebookAiMultiAdVariant;
use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Campaign\Data\AdContent\Video\VideoCollection;
use CCT\SDK\Exception\SerializationErrorException;
use PHPUnit\Framework\TestCase;

class FacebookAiMultiAdVariantTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = FacebookAiMultiAdVariantData::dataWithOverride();

        $adVariant = FacebookAiMultiAdVariant::fromArray($data);

        $this->assertInstanceOf(TextCollection::class, $adVariant->texts);
        $this->assertInstanceOf(HeadingCollection::class, $adVariant->headings);
        $this->assertInstanceOf(DescriptionCollection::class, $adVariant->descriptions);
        $this->assertInstanceOf(ImageCollection::class, $adVariant->images);
        $this->assertInstanceOf(VideoCollection::class, $adVariant->videos);
    }

    public function testFromArrayWithMissingProperties(): void
    {
        $this->expectException(SerializationErrorException::class);

        $data = [
            'texts' => [
                'text1',
                'text2',
            ],
        ];

        FacebookAiMultiAdVariant::fromArray($data);
    }

    public function testToArray(): void
    {
        $data = FacebookAiMultiAdVariantData::dataWithOverride();

        $adVariant = FacebookAiMultiAdVariant::fromArray($data);

        $this->assertEquals($data, $adVariant->toArray());
    }
}
