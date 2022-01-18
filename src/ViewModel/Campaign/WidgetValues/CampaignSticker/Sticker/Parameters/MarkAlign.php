<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker\Sticker\Parameters;

use CCT\SDK\CampaignWizard\ValueObject\AbstractEnum;

final class MarkAlign extends AbstractEnum
{
    public const CENTER = 'center';
    public const MIDDLE = 'middle';
    public const TOP = 'top';
    public const BOTTOM = 'bottom';
    public const RIGHT = 'right';
    public const LEFT = 'left';
}
