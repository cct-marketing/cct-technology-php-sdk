<?php

namespace CCT\SDK\Tests\Unit\Campaign\Data\AdContent\Image;

use CCT\SDK\Campaign\Data\AdContent\Image\Image;
use CCT\SDK\Campaign\Data\AdContent\Image\ImageId;
use CCT\SDK\Infrastucture\ValueObject\Uri;
use CCT\SDK\Tests\Unit\MediaManagement\ViewModel\MediaImageDataFactory;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = ImageDataFactory::dataWithOverride();

        $image = Image::fromArray($data);

        $this->assertInstanceOf(Uri::class, $image->imageUrl);
        $this->assertEquals($data['image_url'], $image->imageUrl->toString());
        $this->assertInstanceOf(ImageId::class, $image->uuid);
        $this->assertEquals($data['uuid'], $image->uuid->toString());
    }

    public function testFromMediaImage(): void
    {
        $mediaImage = MediaImageDataFactory::createObject(['endpoint' => 'https://example.com/image.jpg']);

        $image = Image::fromMediaImage($mediaImage);

        $this->assertInstanceOf(Uri::class, $image->imageUrl);
        $this->assertEquals('https://example.com/image.jpg', $image->imageUrl->toString());
    }
}
