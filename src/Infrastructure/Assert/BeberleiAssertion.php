<?php

declare(strict_types=1);

namespace CCT\SDK\Infrastructure\Assert;

use CCT\SDK\Infrastructure\Assert\Exception\AssertionFailedException;

final class BeberleiAssertion extends \Assert\Assertion
{
    protected static $exceptionClass = AssertionFailedException::class;
}
