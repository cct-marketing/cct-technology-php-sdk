<?php

namespace CCT\SDK\Tests\Unit\MediaManagement\ViewModel;

use CCT\SDK\MediaManagement\ViewModel\BaseMedia;
use CCT\SDK\MediaManagement\ViewModel\ContextCollection;
use CCT\SDK\MediaManagement\ViewModel\MediaType;
use CCT\SDK\MediaManagement\ViewModel\Status;
use PHPUnit\Framework\TestCase;

class BaseMediaTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = BaseMediaDataFactory::dataWithOverride();

        $baseMedia = BaseMedia::fromArray($data);

        $this->assertEquals($data['id'], $baseMedia->id);
        $this->assertEquals($data['name'], $baseMedia->name);
        $this->assertEquals($data['description'], $baseMedia->description);
        $this->assertEquals($data['private'], $baseMedia->private);
        $this->assertEquals($data['extension'], $baseMedia->extension);
        $this->assertInstanceOf(Status::class, $baseMedia->status);
        $this->assertEquals($data['status'], $baseMedia->status->value);
        $this->assertEquals($data['external'], $baseMedia->external);
        $this->assertInstanceOf(ContextCollection::class, $baseMedia->contexts);
        $this->assertCount(0, $baseMedia->contexts->items());
        $this->assertInstanceOf(MediaType::class, $baseMedia->type);
        $this->assertEquals($data['type'], $baseMedia->type->value);
        $this->assertEquals($data['endpoint'], $baseMedia->endpoint);
        $this->assertEquals($data['file_format'], $baseMedia->fileFormat);
        $this->assertEquals($data['original_uri'], $baseMedia->originalUri);
    }

    public function testToArray(): void
    {
        $data = BaseMediaDataFactory::dataWithOverride();
        $baseMedia = BaseMedia::fromArray($data);

        $this->assertEquals($data, $baseMedia->toArray());
    }
}
