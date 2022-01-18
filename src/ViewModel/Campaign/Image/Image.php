<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\Image;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\Component\ValueObject\Web\Uri;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

/**
 * PSR7 Uri interface compatible value object https://www.php-fig.org/psr/psr-7/
 */
final class Image extends AbstractValueObject
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * @var Uri
     */
    private $imageUrl;

    /**
     * Image constructor
     *
     * @param Uri    $imageUrl
     * @param string $uuid
     *
     * @throws AssertionFailedException
     */
    public function __construct(Uri $imageUrl, string $uuid)
    {
        $this->guard($uuid);
        $this->uuid = $uuid;
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return (string) $this->imageUrl;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
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

        return $valueObject->toArray() === $this->toArray();
    }

    /**
     * @param string $uuid
     *
     * @throws AssertionFailedException
     */
    private function guard($uuid): void
    {
        Assertion::uuid($uuid, null, 'image');
    }

    /**
     * @param array $data
     *
     * @return Image
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'image_url', null, 'image');
        Assertion::keyExists($data, 'uuid', null, 'image');

        return new self(
            new Uri($data['image_url']),
            $data['uuid']
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'image_url' => (string) $this->imageUrl,
            'uuid' => $this->uuid,
        ];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }
}

