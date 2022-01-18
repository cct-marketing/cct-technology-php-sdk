<?php

declare(strict_types=1);

namespace CCT\SDK\CampaignWizard\ViewModel\Campaign\WidgetValues\CampaignSticker\Sticker;

use CCT\SDK\CampaignWizard\ValueObject\AbstractEnum;

final class StickerType extends AbstractEnum
{
    public const SOLD = 'sold';
    public const OPEN_HOUSE = 'open_house';
    public const NEW_PRICE = 'new_price';
    public const BRAND = 'brand';
    public const LET = 'let';
    public const LEASED = 'leased';
}
