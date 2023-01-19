<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Data\Targeting\LocationTargeting;

use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
enum MeasurementUnit: string
{
    case MILE = 'mi';
    case KILOMETER = 'km';
}
