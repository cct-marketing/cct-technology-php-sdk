<?php

declare(strict_types=1);

namespace CCT\SDK\Campaign\Response;

use CCT\SDK\Campaign\Data\CampaignUuid;
use CCT\SDK\Infrastucture\Assert\Assertion;
use Psr\Http\Message\ResponseInterface;

final class CommonMutateResponse
{
    public function __construct(public readonly CampaignUuid $uuid)
    {
    }

    public static function createFromResponse(ResponseInterface $response): self
    {
        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        Assertion::keyExists($data, 'uuid', 'campaign_creation_response');

        return new self(CampaignUuid::fromString($data['uuid']));
    }
}
