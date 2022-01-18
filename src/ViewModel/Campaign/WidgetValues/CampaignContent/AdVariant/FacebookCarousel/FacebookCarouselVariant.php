<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\FacebookCarousel;

use Assert\Assertion;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;

final class FacebookCarouselVariant extends AbstractValueObject
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var FacebookCarouselCardCollection
     */
    private $cardCollection;

    /**
     * FacebookCarouselVariant constructor.
     *
     * @param string                         $text
     * @param FacebookCarouselCardCollection $cardCollection
     */
    public function __construct(string $text, FacebookCarouselCardCollection $cardCollection)
    {
        $this->guard($text, $cardCollection);
        $this->text = $text;
        $this->cardCollection = $cardCollection;
    }

    /**
     * @return string
     */
    public function text(): string
    {
        return $this->text;
    }

    /**
     * @return FacebookCarouselCardCollection
     */
    public function cardCollection(): FacebookCarouselCardCollection
    {
        return $this->cardCollection;
    }

    /**
     * @param string                         $text
     * @param FacebookCarouselCardCollection $cardCollection
     */
    private function guard(string $text, FacebookCarouselCardCollection $cardCollection)
    {
        Assertion::maxLength($text, 200, null, self::errorPropertyPath());
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'text', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'card_collection', null, self::errorPropertyPath());

        return new self(
            $data['text'],
            FacebookCarouselCardCollection::fromArray($data['card_collection'])
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'card_collection' => $this->cardCollection->toArray(),
        ];
    }

    /**
     * @param ValueObjectInterface $valueObject
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    /**
     * @param ImageCollection $images
     *
     * @return FacebookCarouselVariant
     */
    public function withImages(ImageCollection $images): self
    {
        return new self(
            $this->text,
            $this->cardCollection->withImages($images)
        );
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->text === '' && $this->cardCollection->isEmpty();
    }
}
