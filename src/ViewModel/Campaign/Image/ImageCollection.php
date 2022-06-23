<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\Image;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use function array_map;
use function array_pop;
use function json_encode;

final class ImageCollection extends AbstractValueObject
{
    /**
     * @var Image[]
     */
    private $images;

    public static function fromArray(array $images): self
    {
        return new self(...array_map(static function (array $image) {
            return Image::fromArray($image);
        }, $images));
    }

    public static function fromItems(Image ...$images): self
    {
        return new self(...$images);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    private function __construct(Image ...$images)
    {
        $this->images = $images;
    }

    public function push(Image $image): self
    {
        $copy = clone $this;
        $copy->images[] = $image;

        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->images);

        return $copy;
    }

    public function first(): ?Image
    {
        return $this->images[0] ?? null;
    }

    public function last(): ?Image
    {
        if (count($this->images) === 0) {
            return null;
        }

        return $this->images[count($this->images) - 1];
    }

    public function getAt(int $index): ?Image
    {
        return $this->images[$index] ?? null;
    }

    public function contains(Image $image): bool
    {
        foreach ($this->images as $existingImage) {
            if ($existingImage->equals($image)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Image[]
     */
    public function images(): array
    {
        return $this->images;
    }

    public function toArray(): array
    {
        return array_map(static function (Image $image) {
            return $image->toArray();
        }, $this->images);
    }

    public function equals(ValueObjectInterface $other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->toArray() === $other->toArray();
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    public function count(): int
    {
        return count($this->images);
    }
}
