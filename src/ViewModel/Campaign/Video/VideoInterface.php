<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\Video;

use CCT\Component\ValueObject\ValueObjectInterface;

interface VideoInterface extends ValueObjectInterface
{
    /**
     * @return string
     */
    public function uuid(): string;

    /**
     * @return array
     */
    public function toArray(): array;
}
