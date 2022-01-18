<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\Video;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\Component\ValueObject\Web\Uri;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * PSR7 Uri interface compatible value object https://www.php-fig.org/psr/psr-7/
 */
final class Video extends AbstractValueObject implements VideoInterface
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var Uri
     */
    private $videoUrl;

    /**
     * Video constructor
     *
     * @param Uri           $videoUrl
     * @param UuidInterface $uuid
     *
     * @throws AssertionFailedException
     */
    public function __construct(Uri $videoUrl, UuidInterface $uuid)
    {
        $this->uuid = $uuid;
        $this->videoUrl = $videoUrl;
    }

    /**
     * @return Uri
     */
    public function videoUrl(): Uri
    {
        return $this->videoUrl;
    }

    /**
     * @return string
     */
    public function uuid(): string
    {
        return $this->uuid->toString();
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

        return $valueObject->serialize() === $this->serialize();
    }

    /**
     * Serialize object into an array or string
     *
     * @return array|string
     */
    public function serialize()
    {
        return $this->toArray();
    }

    /**
     * @param mixed $data
     *
     * @return self
     *
     * @throws AssertionFailedException
     */
    public static function deserialize($data): self
    {
        Assertion::isArray($data, null, 'video');

        return self::fromArray($data);
    }

    /**
     * @param array $data
     *
     * @return Video
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'video_url', null, 'video');
        Assertion::keyExists($data, 'uuid', null, 'video');

        return new self(
            new Uri($data['video_url']),
            Uuid::fromString($data['uuid'])
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'video_url' => (string) $this->videoUrl,
            'uuid' => $this->uuid->toString(),
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
