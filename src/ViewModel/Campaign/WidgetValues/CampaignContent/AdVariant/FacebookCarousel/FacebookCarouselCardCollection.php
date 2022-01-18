<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\FacebookCarousel;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;

final class FacebookCarouselCardCollection extends AbstractValueObject
{
    /**
     * @var FacebookCarouselCard[]
     */
    private $facebookCarouselCards;

    /**
     * @param array $facebookCarouselCards
     *
     * @return self
     */
    public static function fromArray(array $facebookCarouselCards): self
    {
        return new self(...array_map(static function (array $facebookCarouselCard) {
            return FacebookCarouselCard::fromArray($facebookCarouselCard);
        }, $facebookCarouselCards));
    }

    /**
     * @param FacebookCarouselCard ...$facebookCarouselCards
     *
     * @return self
     */
    public static function fromItems(FacebookCarouselCard ...$facebookCarouselCards): self
    {
        return new self(...$facebookCarouselCards);
    }

    /**
     * @return self
     */
    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * Constructor.
     *
     * @param FacebookCarouselCard ...$facebookCarouselCards
     */
    private function __construct(FacebookCarouselCard ...$facebookCarouselCards)
    {
        $this->facebookCarouselCards = $facebookCarouselCards;
    }

    /**
     * @param FacebookCarouselCard $facebookCarouselCard
     *
     * @return self
     */
    public function push(FacebookCarouselCard $facebookCarouselCard): self
    {
        $copy = clone $this;
        $copy->facebookCarouselCards[] = $facebookCarouselCard;

        return $copy;
    }

    /**
     * @return self
     */
    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->facebookCarouselCards);

        return $copy;
    }

    /**
     * @return FacebookCarouselCard|null
     */
    public function first(): ?FacebookCarouselCard
    {
        return $this->facebookCarouselCards[0] ?? null;
    }

    /**
     * @return FacebookCarouselCard|null
     */
    public function last(): ?FacebookCarouselCard
    {
        if (count($this->facebookCarouselCards) === 0) {
            return null;
        }

        return $this->facebookCarouselCards[count($this->facebookCarouselCards) - 1];
    }

    /**
     * @param FacebookCarouselCard $facebookCarouselCard
     *
     * @return bool
     */
    public function contains(FacebookCarouselCard $facebookCarouselCard): bool
    {
        foreach ($this->facebookCarouselCards as $existingFacebookCarouselCard) {
            if ($existingFacebookCarouselCard->equals($facebookCarouselCard)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return FacebookCarouselCard[]
     */
    public function facebookCarouselCards(): array
    {
        return $this->facebookCarouselCards;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(static function (FacebookCarouselCard $facebookCarouselCard) {
            return $facebookCarouselCard->toArray();
        }, $this->facebookCarouselCards);
    }

    /**
     * @param ValueObjectInterface $other
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->toArray() === $other->toArray();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->facebookCarouselCards);
    }

    /**
     * @return int
     */
    public function countItems(): int
    {
        return $this->count();
    }

    /**
     * @param ImageCollection $images
     *
     * @return self
     */
    public function withImages(ImageCollection $images): self
    {
        $items = array_map(static function (int $index, FacebookCarouselCard $facebookCarouselCard) use ($images) {
            return $facebookCarouselCard->withImage($images->getAt($index));
        }, array_keys($this->facebookCarouselCards), $this->facebookCarouselCards);

        return self::fromItems(...$items);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        $nonEmptyCards = array_filter($this->facebookCarouselCards, static function (FacebookCarouselCard $facebookCarouselCard) {
            return !$facebookCarouselCard->isEmpty();
        });

        return 0 === count($nonEmptyCards);
    }
}
