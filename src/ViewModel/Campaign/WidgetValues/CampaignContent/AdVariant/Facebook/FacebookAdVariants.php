<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Facebook;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Video\VideoCollection;

class FacebookAdVariants extends AbstractValueObject
{
    /**
     * @var FacebookAdVariant[]
     */
    private $facebookAdVariants;

    public static function fromArray(array $facebookAdVariants): self
    {
        return new self(...array_map(static function (array $facebookAdVariant) {
            return FacebookAdVariant::fromArray($facebookAdVariant);
        }, $facebookAdVariants));
    }

    /**
     * @param FacebookAdVariant ...$facebookAdVariants
     */
    public static function fromItems(FacebookAdVariant ...$facebookAdVariants): self
    {
        return new self(...$facebookAdVariants);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * Constructor.
     *
     * @param FacebookAdVariant ...$facebookAdVariants
     */
    private function __construct(FacebookAdVariant ...$facebookAdVariants)
    {
        $this->facebookAdVariants = $facebookAdVariants;
    }

    public function push(FacebookAdVariant $facebookAdVariant): self
    {
        $copy = clone $this;
        $copy->facebookAdVariants[] = $facebookAdVariant;

        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->facebookAdVariants);

        return $copy;
    }

    public function first(): ?FacebookAdVariant
    {
        return $this->facebookAdVariants[0] ?? null;
    }

    public function last(): ?FacebookAdVariant
    {
        if (count($this->facebookAdVariants) === 0) {
            return null;
        }

        return $this->facebookAdVariants[count($this->facebookAdVariants) - 1];
    }

    public function contains(FacebookAdVariant $facebookAdVariant): bool
    {
        foreach ($this->facebookAdVariants as $existingFacebookAdVariant) {
            if ($existingFacebookAdVariant->equals($facebookAdVariant)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return FacebookAdVariant[]
     */
    public function facebookAdVariants(): array
    {
        return $this->facebookAdVariants;
    }

    public function toArray(): array
    {
        return array_map(
            static function (FacebookAdVariant $facebookAdVariant) {
                return $facebookAdVariant->toArray();
            },
            $this->facebookAdVariants
        );
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
        return count($this->facebookAdVariants);
    }

    /**
     * @return FacebookAdVariants
     */
    public function withImages(ImageCollection $images): self
    {
        $items = array_map(
            static function (FacebookAdVariant $facebookAdVariant) use ($images) {
                return $facebookAdVariant->withImages($images);
            },
            $this->facebookAdVariants
        );

        return self::fromItems(...$items);
    }

    /**
     * This is a horrible function to remove empty variants. This is need due to the inability to see past the old
     * legacy Salesbooster functionality
     */
    public function removeEmptyVariants(): self
    {
        $items = array_values(
            array_filter(
                $this->facebookAdVariants,
                static function (FacebookAdVariant $facebookAdVariant) {
                    return false === $facebookAdVariant->isEmpty();
                }
            )
        );

        return self::fromItems(...$items);
    }

    public function withVideos(VideoCollection $videos): self
    {
        $items = array_map(
            static function (FacebookAdVariant $facebookAdVariant) use ($videos) {
                return $facebookAdVariant->withVideos($videos);
            },
            $this->facebookAdVariants
        );

        return self::fromItems(...$items);
    }
}
