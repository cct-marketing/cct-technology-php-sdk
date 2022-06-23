<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google\ResponsiveAd\DescriptionCollection;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google\ResponsiveAd\LongHeadline;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google\ResponsiveAd\ShortHeadlineCollection;
use CCT\SDK\CampaignWizard\ViewModel\Customer\Business;

final class GoogleResponsiveAdVariant extends AbstractValueObject
{
    /**
     * @var Business
     */
    private $business;

    /**
     * @var ShortHeadlineCollection
     */
    private $shortHeadlineCollection;

    /**
     * @var LongHeadline
     */
    private $longHeadline;

    /**
     * @var DescriptionCollection
     */
    private $descriptionCollection;

    /**
     * @var ImageCollection
     */
    private $imageCollection;

    /**
     * GoogleResponsiveAdVariant constructor.
     */
    private function __construct(
        Business $business,
        ShortHeadlineCollection $shortHeadlineCollection,
        LongHeadline $longHeadline,
        DescriptionCollection $descriptionCollection,
        ImageCollection $imageCollection
    ) {
        $this->business = $business;
        $this->shortHeadlineCollection = $shortHeadlineCollection;
        $this->longHeadline = $longHeadline;
        $this->descriptionCollection = $descriptionCollection;
        $this->imageCollection = $imageCollection;
    }

    /**
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'business', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'short_headlines', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'long_headline', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'descriptions', null, self::errorPropertyPath());

        return new self(
            Business::fromArray($data['business']),
            ShortHeadlineCollection::fromArray($data['short_headlines']),
            LongHeadline::fromString($data['long_headline']),
            DescriptionCollection::fromArray($data['descriptions']),
            isset($data['images']) ? ImageCollection::fromArray($data['images']) : ImageCollection::emptyList()
        );
    }

    public function toArray(): array
    {
        return [
            'business' => $this->business->toArray(),
            'short_headlines' => $this->shortHeadlineCollection->toArray(),
            'long_headline' => $this->longHeadline->toString(),
            'descriptions' => $this->descriptionCollection->toArray(),
            'images' => $this->imageCollection->toArray(),
        ];
    }

    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }

    public function business(): Business
    {
        return $this->business;
    }

    public function shortHeadlineCollection(): ShortHeadlineCollection
    {
        return $this->shortHeadlineCollection;
    }

    public function longHeadline(): LongHeadline
    {
        return $this->longHeadline;
    }

    public function descriptionCollection(): DescriptionCollection
    {
        return $this->descriptionCollection;
    }

    public function imageCollection(): ImageCollection
    {
        return $this->imageCollection;
    }

    /**
     * Removes empty text from short headlines and descriptions
     *
     * @throws AssertionFailedException
     */
    public function removeBlankText(): self
    {
        return new self(
            $this->business,
            $this->shortHeadlineCollection->removeBlankText(),
            $this->longHeadline,
            $this->descriptionCollection->removeBlankText(),
            $this->imageCollection
        );
    }
}
