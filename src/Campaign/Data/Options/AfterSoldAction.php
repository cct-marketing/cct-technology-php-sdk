<?php

namespace CCT\SDK\Campaign\Data\Options;

use CCT\SDK\Infrastucture\ValueObject\AbstractMulti;
use EventSauce\ObjectHydrator\MapperSettings;

#[MapperSettings(serializePublicMethods: false)]
final class AfterSoldAction extends AbstractMulti
{
    private function __construct(public readonly ActionType $actionType)
    {
    }
}
