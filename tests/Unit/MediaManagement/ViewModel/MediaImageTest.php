<?php

namespace CCT\SDK\Tests\Unit\MediaManagement\ViewModel;

use CCT\SDK\MediaManagement\ViewModel\MediaImage;
use PHPUnit\Framework\TestCase;

class MediaImageTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = BaseMediaDataFactory::dataWithOverride([
            'content_size' => 100,
            'width' => 200,
            'height' => 300,
        ]);

        $mediaImage = MediaImage::fromArray($data);

        $this->assertInstanceOf(MediaImage::class, $mediaImage);
        $this->assertEquals($data['content_size'], $mediaImage->contentSize);
        $this->assertEquals($data['width'], $mediaImage->width);
        $this->assertEquals($data['height'], $mediaImage->height);
    }

    public function testToArray(): void
    {
        $mediaImage = new MediaImage(
            BaseMediaDataFactory::createObject(),
            100,
            200,
            300
        );

        $data = $mediaImage->toArray();

        $expected = [
            'content_size' => 100,
            'width' => 200,
            'height' => 300,
        ];

        foreach ($expected as $key => $expectedValue) {
            $this->assertEquals($expectedValue, $data[$key]);
        }
    }
}
