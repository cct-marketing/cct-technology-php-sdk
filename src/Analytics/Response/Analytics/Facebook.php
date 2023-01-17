<?php

declare(strict_types=1);

namespace CCT\SDK\Analytics\Response\Analytics;

use CCT\SDK\Infrastucture\Assert\Assertion;
use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;

final class Facebook extends AbstractMulti
{
    public static function fromArray(array $data): static
    {
        Assertion::keyExists($data, 'likes_shares', self::errorPropertyPath());
        Assertion::keyExists($data, 'fb_likes', self::errorPropertyPath());
        Assertion::keyExists($data, 'fb_shares', self::errorPropertyPath());
        Assertion::keyExists($data, 'fb_comments', self::errorPropertyPath());
        Assertion::keyExists($data, 'fb_gender_age_range', self::errorPropertyPath());

        return new self(
            $data['likes_shares'],
            $data['fb_likes'],
            $data['fb_shares'],
            $data['fb_comments'],
            $data['fb_gender_age_range']
        );
    }

    public function __construct(
        public readonly int $likesShares,
        public readonly int $fbLikes,
        public readonly int $fbShares,
        public readonly int $fbComments,
        public readonly array $fbGenderAgeRange
    ) {
    }

    public function toArray(): array
    {
        return [
            'likes_shares' => $this->likesShares,
            'fb_likes' => $this->fbLikes,
            'fb_shares' => $this->fbShares,
            'fb_comments' => $this->fbComments,
            'fb_gender_age_range' => $this->fbGenderAgeRange,
        ];
    }
}
