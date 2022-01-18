<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Customer\Logo;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\Image\Image;

final class Logo extends AbstractValueObject
{
    /**
     * @var Image
     */
    private $image;

    /**
     * @var string
     */
    private $logoType;

    private function __construct(Image $image, string $logoType)
    {
        $this->image = $image;
        $this->logoType = $logoType;
    }

    /**
     * @param array $data
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'logo_type', null, 'logo');

        return new self(
            Image::fromArray($data),
            $data['logo_type']
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(
            $this->image->toArray(),
            ['logo_type' => $this->logoType]
        );
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
}
