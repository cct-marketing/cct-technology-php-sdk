<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\Video;

use CCT\Component\ValueObject\ValueObjectInterface;
use CCT\SDK\CampaignWizard\ViewModel\Campaign\AbstractValueObject;
use RuntimeException;

final class VideoCollection extends AbstractValueObject
{
    /**
     * @var array
     */
    private static $types = [
        'facebook_video' => FacebookVideo::class,
        'video' => Video::class,
    ];

    /**
     * @var VideoInterface[]
     */
    private $videos;

    public static function fromArray(array $videos): self
    {
        return new self(...array_map(static function (array $video) {
            if (!isset($video['_type'], self::$types[$video['_type']])) {
                throw new RuntimeException(
                    sprintf(
                        'You must have a _type key with one of the following values "%s"',
                        implode(', ', array_keys(self::$types))
                    )
                );
            }

            $className = self::$types[$video['_type']];

            return $className::fromArray($video);
        }, $videos));
    }

    /**
     * @param VideoInterface ...$videos
     */
    public static function fromItems(VideoInterface ...$videos): self
    {
        return new self(...$videos);
    }

    public static function emptyList(): self
    {
        return new self();
    }

    /**
     * Constructor.
     *
     * @param VideoInterface ...$videos
     */
    private function __construct(VideoInterface ...$videos)
    {
        $this->videos = $videos;
    }

    public function push(VideoInterface $video): self
    {
        $copy = clone $this;
        $copy->videos[] = $video;

        return $copy;
    }

    public function pop(): self
    {
        $copy = clone $this;
        array_pop($copy->videos);

        return $copy;
    }

    public function first(): ?VideoInterface
    {
        return $this->videos[0] ?? null;
    }

    public function last(): ?VideoInterface
    {
        if (count($this->videos) === 0) {
            return null;
        }

        return $this->videos[count($this->videos) - 1];
    }

    public function contains(VideoInterface $video): bool
    {
        foreach ($this->videos as $existingVideo) {
            if ($existingVideo->equals($video)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return VideoInterface[]
     */
    public function videos(): array
    {
        return $this->videos;
    }

    public function toArray(): array
    {
        return array_map(
            static function (VideoInterface $video) {
                $data = $video->toArray();
                $className = get_class($video);

                if (!in_array($className, self::$types, true)) {
                    throw new RuntimeException(
                        sprintf(
                            'Class type "%s" is not supported. Allowed classes "%s"',
                            $className,
                            implode(', ', self::$types)
                        )
                    );
                }

                $data['_type'] = array_search($className, self::$types, true);

                return $data;
            },
            $this->videos
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
        return count($this->videos);
    }
}
