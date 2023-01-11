<?php

declare(strict_types=1);

namespace CCT\SDK\Examples;

use CCT\SDK\Client\Options\Mode;
use CCT\SDK\Client\Options\Options;

final class OptionsForExamples
{
    public static function create(): Options
    {
        return Options::fromArray(
            [
                'mode' => Mode::SANDBOX->value, // when ready to connect live change to 'live'
                'client_id' => '{YOUR_CLIENT_ID}', // Replace with your client id
                'client_secret' => '{YOUR_CLIENT_SECRET}', // Replace with your client secret
            ]
        );
    }
}
