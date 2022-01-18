<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker\Sticker;

use CCT\SDK\CampaignWizard\ValueObject\AbstractEnum;

final class InitialPosition extends AbstractEnum
{
    public const TOP_LEFT = 1;
    public const TOP_CENTER = 2;
    public const TOP_RIGHT = 3;
    public const MIDDLE_LEFT = 4;
    public const MIDDLE_CENTER = 5;
    public const MIDDLE_RIGHT = 6;
    public const BOTTOM_LEFT = 7;
    public const BOTTOM_CENTER = 8;
    public const BOTTOM_RIGHT = 9;
}
