<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastucture\Assert;

use CCT\SDK\Infrastucture\Assert\Exception\AssertionFailedException;

final class BeberleiAssertion extends \Assert\Assertion
{
    protected static $exceptionClass = AssertionFailedException::class;
}
