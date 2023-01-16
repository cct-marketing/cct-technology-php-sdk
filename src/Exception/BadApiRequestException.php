<?php

declare(strict_types=1);

namespace CCT\SDK\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class BadApiRequestException extends ApiRequestException
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface|null
     */
    private $response;

    public function __construct(
        $message,
        RequestInterface $request,
        ResponseInterface $response = null,
        \Exception $previous = null
    ) {
        $statusCode = $response ? $response->getStatusCode() : 500;
        parent::__construct($message, $statusCode, $previous);
        $this->request = $request;
        $this->response = $response;
    }

    public static function create(
        RequestInterface $request,
        ResponseInterface $response = null,
        \Exception $previous = null
    ): self {
        $responseContent = '';
        if (null !== $response) {
            $responseContent = $response->getBody()->getContents();
        }

        return new self(
            sprintf('Failed request "%s" with response: %s', (string) $request->getUri(), $responseContent),
            $request,
            $response,
            $previous
        );
    }

    public function request(): RequestInterface
    {
        return $this->request;
    }

    public function response(): ?ResponseInterface
    {
        return $this->response;
    }
}
