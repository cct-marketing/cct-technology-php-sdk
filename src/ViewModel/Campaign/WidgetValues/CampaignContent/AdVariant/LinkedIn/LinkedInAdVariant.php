<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\LinkedIn;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;

final class LinkedInAdVariant extends AbstractValueObject
{
    /**
     * Body text of the creative.
     *
     * @var string
     */
    private $text;

    /**
     * @var ImageCollection|null
     */
    private $imageCollection;

    /**
     * LinkedInAdVariant constructor.
     *
     * @throws AssertionFailedException
     */
    public function __construct(string $text, ?ImageCollection $imageCollection = null)
    {
        $this->guard($text);
        $this->text = $text;
        $this->imageCollection = $imageCollection;
    }

    public function text(): string
    {
        return $this->text;
    }

    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'images' => $this->imageCollection ? $this->imageCollection->toArray() : null,
        ];
    }

    /**
     * @return LinkedInAdVariant
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'text', null, 'linked_in_ad_variant');

        return new self(
            $data['text'],
            isset($data['images']) ? ImageCollection::fromArray($data['images']) : null
        );
    }

    /**
     * @throws AssertionFailedException
     */
    private function guard(string $text)
    {
        Assertion::maxLength($text, 200, null, 'linked_in_ad_variant');
    }

    /**
     * @param ValueObjectInterface|self $valueObject
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $this->toArray() === $valueObject->toArray();
    }

    /**
     * @throws AssertionFailedException
     */
    public static function withOnlyImages(ImageCollection $images): self
    {
        return new self(
            '',
            $images
        );
    }

    /**
     * @throws AssertionFailedException
     */
    public static function withNoContent(): self
    {
        return new self(
            '',
            null
        );
    }

    public function isEmpty(): bool
    {
        return $this->text === '';
    }
}
