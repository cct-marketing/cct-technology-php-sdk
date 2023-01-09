<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\Image;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\MediaManagement\ViewModel\MediaCollection;
use CCT\SDK\Tests\Unit\MediaManagement\ViewModel\MediaImageDataFactory;
use PHPUnit\Framework\TestCase;

class ImageCollectionTest extends TestCase
{
    public function testFromMediaCollection()
    {
        $mediaCollection = new MediaCollection(
            [
                MediaImageDataFactory::createObject(['id' => '7b9c043c-acd1-40e3-8c9f-bfa84462aacc', 'endpoint' => 'https://example.com/images/1']),
                MediaImageDataFactory::createObject(['id' => '95ab0dba-f0b9-4411-b234-8c0eceee0f02', 'endpoint' => 'https://example.com/images/2']),
                MediaImageDataFactory::createObject(['id' => 'c0ea3f67-3817-48e4-8f54-c55ef4045f2c', 'endpoint' => 'https://example.com/images/3']),
            ]
        );

        $imageCollection = ImageCollection::fromMediaCollection($mediaCollection);

        $this->assertInstanceOf(ImageCollection::class, $imageCollection);
        $this->assertEquals(3, $imageCollection->count());
    }
}
