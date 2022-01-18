<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignContent\AdVariant\Google;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\ImageCollection;

final class GoogleAdVariant extends AbstractValueObject
{
    /**
     * @var string
     */
    private $textLine1;

    /**
     * @var string
     */
    private $textLine2;

    /**
     * @var ImageCollection|null
     */
    private $imageCollection;

    /**
     * GoogleAdVariant constructor.
     *
     * @param string               $textLine1
     * @param string               $textLine2
     * @param ImageCollection|null $imageCollection
     */
    public function __construct(string $textLine1, string $textLine2, ?ImageCollection $imageCollection = null)
    {
        $this->guard($textLine1, $textLine2);
        $this->textLine1 = $textLine1;
        $this->textLine2 = $textLine2;
        $this->imageCollection = $imageCollection;
    }

    /**
     * @return string
     */
    public function getTextLine1(): string
    {
        return $this->textLine1;
    }

    /**
     * @return string
     */
    public function getTextLine2(): string
    {
        return $this->textLine2;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'text_line_1' => $this->textLine1,
            'text_line_2' => $this->textLine2,
            'images' => $this->imageCollection ? $this->imageCollection->toArray() : null,
        ];
    }

    /**
     * @param array $data
     *
     * @return GoogleAdVariant
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'text_line_1', null, 'google_ad_variant');
        Assertion::keyExists($data, 'text_line_2', null, 'google_ad_variant');

        return new self(
            $data['text_line_1'],
            $data['text_line_2'],
            isset($data['images']) ? ImageCollection::fromArray($data['images']) : null
        );
    }

    /**
     * @param string $textLine1
     * @param string $textLine2
     */
    private function guard(string $textLine1, string $textLine2)
    {
        Assertion::maxLength($textLine1, 45, null, 'google_ad_variant');
        Assertion::maxLength($textLine2, 45, null, 'google_ad_variant');
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
     * @param ImageCollection $images
     *
     * @return self
     */
    public static function withOnlyImages(ImageCollection $images): self
    {
        return new self(
            '',
            '',
            $images
        );
    }

    /**
     * @return self
     */
    public static function withNoContent(): self
    {
        return new self(
            '',
            '',
            null
        );
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->textLine1 === '' && $this->textLine2 === '';
    }
}
