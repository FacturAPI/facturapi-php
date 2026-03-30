<?php

declare(strict_types=1);

namespace Facturapi\Tests\Support;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

final class FakeHttpClient implements ClientInterface
{
    /** @var list<RequestInterface> */
    private array $requests = [];

    /** @var list<ResponseInterface> */
    private array $responses;

    public function __construct(ResponseInterface ...$responses)
    {
        $this->responses = $responses;
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->requests[] = $request;

        if ($this->responses === []) {
            throw new FakeHttpClientException('No fake response queued.');
        }

        return array_shift($this->responses);
    }

    /** @return list<RequestInterface> */
    public function requests(): array
    {
        return $this->requests;
    }
}

final class FakeHttpClientException extends RuntimeException implements ClientExceptionInterface
{
}
