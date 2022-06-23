<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\Video;

use Assert\Assertion;
use Assert\AssertionFailedException;
use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\Component\ValueObject\Web\Uri;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;

/**
 * PSR7 Uri interface compatible value object https://www.php-fig.org/psr/psr-7/
 */
final class FacebookVideo extends AbstractValueObject implements VideoInterface
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string Numeric string
     */
    private $videoId;

    /**
     * @var Uri
     */
    private $thumbnail;

    /**
     * @return static
     *
     * @throws AssertionFailedException
     */
    public static function create(string $videoId, Uri $thumbnail, string $uuid): self
    {
        return new self($videoId, $thumbnail, $uuid);
    }

    /**
     * FacebookVideo constructor
     *
     * @throws AssertionFailedException
     */
    private function __construct(string $videoId, Uri $thumbnail, string $uuid)
    {
        $this->guard($videoId, $uuid);
        $this->uuid = $uuid;
        $this->videoId = $videoId;
        $this->thumbnail = $thumbnail;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function videoId(): string
    {
        return $this->videoId;
    }

    public function thumbnail(): Uri
    {
        return $this->thumbnail;
    }

    /**
     * @param ValueObjectInterface|self $valueObject
     */
    public function equals(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof self) {
            return false;
        }

        return $valueObject->toArray() === $this->toArray();
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
     * @throws AssertionFailedException
     */
    public static function deserialize($data): self
    {
        Assertion::isArray($data, null, self::errorPropertyPath());

        return self::fromArray($data);
    }

    /**
     * @throws AssertionFailedException
     */
    private function guard(string $videoId, string $uuid)
    {
        Assertion::uuid($uuid, null, self::errorPropertyPath());
        Assertion::numeric($videoId, null, self::errorPropertyPath());
    }

    /**
     * @return FacebookVideo
     *
     * @throws AssertionFailedException
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'video_id', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'thumbnail', null, self::errorPropertyPath());
        Assertion::keyExists($data, 'uuid', null, self::errorPropertyPath());

        return new self(
            $data['video_id'],
            new Uri($data['thumbnail']),
            $data['uuid']
        );
    }

    public function toArray(): array
    {
        return [
            'video_id' => $this->videoId,
            'thumbnail' => (string) $this->thumbnail,
            'uuid' => $this->uuid,
        ];
    }

    public function __toString(): string
    {
        return (string) json_encode($this->toArray());
    }
}
