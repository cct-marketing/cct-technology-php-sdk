<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Options;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class Options extends AbstractMulti
{
    public function __construct(
        public readonly ?AdvancedSlideshow $advancedSlideshow,
        public readonly ?FacebookSlideshow $facebookSlideshow,
        public readonly ?LocalBoost $localBoost,
        public readonly ?PostFirstVariantToFacebook $postFirstVariantToFacebook,
        public readonly ?AfterSoldAction $afterSoldAction
    ) {
    }
}
