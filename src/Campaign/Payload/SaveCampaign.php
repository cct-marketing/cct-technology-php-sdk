<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Payload;

use CCT\SDK\Campaign\Data\AdContent\AdContent;
use CCT\SDK\Campaign\Data\Details\Details;
use CCT\SDK\Campaign\Data\Options\Options;
use CCT\SDK\Campaign\Data\Targeting\Targeting;
use CCT\SDK\Infrastructure\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class SaveCampaign extends AbstractMulti
{
    public function __construct(
        public readonly ?Details $details,
        public readonly ?AdContent $adContent,
        public readonly ?Targeting $targeting,
        public readonly ?Options $options
    ) {
    }
}
