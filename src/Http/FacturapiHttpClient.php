<?php

declare(strict_types=1);

namespace Facturapi\Http;

use Facturapi\Exceptions\FacturapiException;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class FacturapiHttpClient
{
    private readonly string $apiKey;
    private readonly string $apiVersion;
    private string $baseUrl = 'https://www.facturapi.io/';
    private string $userAgent = 'facturapi-php';
    private ?int $lastStatus = null;

    private readonly ClientInterface $client;
    private readonly RequestFactoryInterface $requestFactory;
    private readonly StreamFactoryInterface $streamFactory;

    /**
     * @param string $apiKey Facturapi API key.
     * @param array{apiVersion?:string,httpClient?:ClientInterface}|null $config Optional config
     */
    public function __construct(string $apiKey, ?array $config = null)
    {
        $this->apiKey = base64_encode($apiKey . ':');
        $this->apiVersion = $config['apiVersion'] ?? 'v2';

        $this->client = $config['httpClient'] ?? Psr18ClientDiscovery::find();
        $this->requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = Psr17FactoryDiscovery::findStreamFactory();
    }

    public function getLastStatus(): ?int
    {
        return $this->lastStatus;
    }

    /**
     * @throws FacturapiException
     */
    public function get(string $endpoint, ?array $params = null): array
    {
        $url = $this->buildUrl($endpoint, $params);
        return $this->executeRequest('GET', $url);
    }

    /**
     * @throws FacturapiException
     */
    public function post(string $endpoint, array $data = [], ?array $query = null): array
    {
        $url = $this->buildUrl($endpoint, $query);
        $body = $data === [] ? '' : json_encode($data, JSON_THROW_ON_ERROR);
        return $this->executeRequest('POST', $url, ['Content-Type' => 'application/json'], $body);
    }

    /**
     * @throws FacturapiException
     */
    public function put(string $endpoint, array $data = [], ?array $query = null): array
    {
        $url = $this->buildUrl($endpoint, $query);
        $body = $data === [] ? '' : json_encode($data, JSON_THROW_ON_ERROR);
        return $this->executeRequest('PUT', $url, ['Content-Type' => 'application/json'], $body);
    }

    /**
     * @throws FacturapiException
     */
    public function delete(string $endpoint, ?array $query = null): array
    {
        $url = $this->buildUrl($endpoint, $query);
        return $this->executeRequest('DELETE', $url);
    }

    /**
     * @throws FacturapiException
     */
    /**
     * @throws FacturapiException
     */
    public function multipartRequest(string $method, string $endpoint, array $files, array $data = []): array
    {
        $url = $this->buildUrl($endpoint);
        $builder = new MultipartStreamBuilder($this->streamFactory);

        foreach ($files as $name => $path) {
            if (!file_exists($path) || !is_readable($path)) {
                throw new FacturapiException('Unable to open file: ' . $path);
            }
            $stream = fopen($path, 'rb');
            if ($stream === false) {
                throw new FacturapiException('Unable to open file: ' . $path);
            }
            $builder->addResource($name, $stream, ['filename' => basename($path)]);
        }

        foreach ($data as $name => $value) {
            $builder->addResource((string)$name, (string)$value);
        }

        $multipartStream = $builder->build();
        $boundary = $builder->getBoundary();

        return $this->executeRequest(
            $method,
            $url,
            ['Content-Type' => 'multipart/form-data; boundary=' . $boundary],
            (string)$multipartStream
        );
    }

    /**
     * @throws FacturapiException
     */
    public function multipartPost(string $endpoint, array $files, array $data = []): array
    {
        return $this->multipartRequest('POST', $endpoint, $files, $data);
    }

    /**
     * @throws FacturapiException
     */
    public function download(string $endpoint, ?array $params = null): string
    {
        $url = $this->buildUrl($endpoint, $params);
        return $this->executeRawRequest('GET', $url);
    }

    /**
     * @throws FacturapiException
     */
    public function postRaw(string $endpoint, array $data = [], ?array $query = null): string
    {
        $url = $this->buildUrl($endpoint, $query);
        $body = $data === [] ? '' : json_encode($data, JSON_THROW_ON_ERROR);
        return $this->executeRawRequest('POST', $url, ['Content-Type' => 'application/json'], $body);
    }

    private function buildUrl(string $endpoint, ?array $params = null): string
    {
        $url = $this->baseUrl . $this->apiVersion . '/' . $endpoint;
        if ($params !== null && $params !== []) {
            foreach ($params as $k => $v) {
                if (is_bool($v)) {
                    $params[$k] = $v ? 'true' : 'false';
                }
            }
            $url .= '?' . preg_replace('/%5B[0-9]+%5D/simU', '', http_build_query($params));
        }
        return $url;
    }

    /**
     * @throws FacturapiException
     * @throws \JsonException
     */
    private function executeRequest(string $method, string $url, array $headers = [], string $body = ''): array
    {
        $rawResponse = $this->executeRawRequest($method, $url, $headers, $body);
        if ($rawResponse === '') {
            return [];
        }
        $decoded = json_decode($rawResponse, true, 512, JSON_THROW_ON_ERROR);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * @throws FacturapiException
     */
    private function executeRawRequest(string $method, string $url, array $headers = [], string $body = ''): string
    {
        $request = $this->requestFactory->createRequest($method, $url);

        $request = $request->withHeader('Authorization', 'Basic ' . $this->apiKey)
                           ->withHeader('User-Agent', $this->userAgent);

        foreach ($headers as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        if ($body !== '') {
            $stream = $this->streamFactory->createStream($body);
            $request = $request->withBody($stream);
        }

        try {
            $response = $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            throw new \Facturapi\Exceptions\NetworkException($e->getMessage(), 0, $e);
        }

        $this->lastStatus = $response->getStatusCode();
        $output = (string) $response->getBody();

        if ($this->lastStatus < 200 || $this->lastStatus > 299) {
            $decoded = json_decode($output, true);
            $errorData = is_array($decoded) ? $decoded : null;
            $message = $this->extractErrorMessage($errorData, $output);

            $normalizedHeaders = [];
            foreach ($response->getHeaders() as $name => $values) {
                $normalizedHeaders[strtolower($name)] = implode(', ', $values);
            }

            $exceptionClass = match (true) {
                $this->lastStatus === 400, $this->lastStatus === 422 => \Facturapi\Exceptions\ValidationException::class,
                $this->lastStatus === 401, $this->lastStatus === 403 => \Facturapi\Exceptions\AuthenticationException::class,
                $this->lastStatus === 404 => \Facturapi\Exceptions\NotFoundException::class,
                $this->lastStatus === 429 => \Facturapi\Exceptions\RateLimitException::class,
                $this->lastStatus >= 500 => \Facturapi\Exceptions\ServerException::class,
                default => FacturapiException::class,
            };

            throw new $exceptionClass(
                $message,
                0,
                null,
                $errorData,
                $this->lastStatus,
                $output,
                $normalizedHeaders
            );
        }

        return $output;
    }

    private function extractErrorMessage(?array $errorData, string $rawBody): string
    {
        if ($errorData === null) {
            return $rawBody;
        }
        if (isset($errorData['message']) && is_string($errorData['message'])) {
            return $errorData['message'];
        }
        if (isset($errorData['error']['message']) && is_string($errorData['error']['message'])) {
            return $errorData['error']['message'];
        }
        if (isset($errorData['errors'][0]['message']) && is_string($errorData['errors'][0]['message'])) {
            return $errorData['errors'][0]['message'];
        }
        $encoded = json_encode($errorData);
        return $encoded === false ? $rawBody : $encoded;
    }
}
