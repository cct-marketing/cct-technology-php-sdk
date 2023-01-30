<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\AdContent\AdVariant\Google;

use CCT\SDK\Campaign\Data\AdContent\Image\ImageCollection;
use CCT\SDK\Infrastructure\Assert\Assertion;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class GoogleAdVariant extends AbstractMulti
{
    public function __construct(public readonly string $textLine1, public readonly string $textLine2, public readonly ?ImageCollection $imageCollection = null)
    {
        $this->guard($textLine1, $textLine2);
    }

    private function guard(string $textLine1, string $textLine2): void
    {
        Assertion::maxLength($textLine1, 45, 'google_ad_variant');
        Assertion::maxLength($textLine2, 45, 'google_ad_variant');
    }
}
