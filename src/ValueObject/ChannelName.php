<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ValueObject;

final class ChannelName extends AbstractEnum
{
    public const FACEBOOK = 'facebook';
    public const GOOGLE = 'google';
    public const LINKEDIN = 'linked_in';
    public const TWITTER = 'twitter';
    public const GENERAL = 'general';

    /**
     * @return self
     */
    public static function facebook(): self
    {
        return new self(self::FACEBOOK);
    }

    /**
     * @return self
     */
    public static function google(): self
    {
        return new self(self::GOOGLE);
    }

    /**
     * @return self
     */
    public static function linkedIn(): self
    {
        return new self(self::LINKEDIN);
    }

    /**
     * @return self
     */
    public static function twitter(): self
    {
        return new self(self::TWITTER);
    }

    /**
     * @return self
     */
    public static function general(): self
    {
        return new self(self::GENERAL);
    }
}
