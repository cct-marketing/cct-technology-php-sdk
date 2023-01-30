<?php

declare(strict_types=1);

namespace CCT\SDK\Customer;

use CCT\SDK\Client\AbstractServiceClient;
use CCT\SDK\Customer\Response\ListResult;
use CCT\SDK\Infrastructure\ValueObject\AbstractUrlOption;

final class CustomerClient extends AbstractServiceClient
{
    public function list(): ListResult
    {
        $data = $this->listResources('/api-v2/customers');

        return ListResult::fromArray($data);
    }

    public function host(): AbstractUrlOption
    {
        return $this->options->customerHost;
    }
}
