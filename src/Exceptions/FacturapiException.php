<?php

declare(strict_types=1);

namespace Facturapi\Exceptions;

use Exception;
use Throwable;

class FacturapiException extends Exception
{
    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null,
        private mixed $errorData = null,
        private readonly ?int $statusCode = null,
        private readonly ?string $rawBody = null,
        private array $headers = []
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getErrorData(): mixed
    {
        return $this->errorData;
    }

    public function getResponseData(): mixed
    {
        return $this->errorData;
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    public function getRawBody(): ?string
    {
        return $this->rawBody;
    }

    public function getErrorCode(): ?string
    {
        if (!is_array($this->errorData) || !array_key_exists('code', $this->errorData)) {
            return null;
        }

        $code = $this->errorData['code'];
        if ($code === null) {
            return null;
        }

        if (is_string($code)) {
            return $code;
        }

        return is_int($code) || is_float($code) ? (string) $code : null;
    }

    public function getErrorPath(): ?string
    {
        return is_array($this->errorData) && is_string($this->errorData['path'] ?? null)
            ? $this->errorData['path']
            : null;
    }

    public function getErrorLocation(): ?string
    {
        return is_array($this->errorData) && is_string($this->errorData['location'] ?? null)
            ? $this->errorData['location']
            : null;
    }

    public function getErrors(): ?array
    {
        return is_array($this->errorData) && is_array($this->errorData['errors'] ?? null)
            ? $this->errorData['errors']
            : null;
    }

    public function getLogId(): ?string
    {
        return is_string($this->headers['x-facturapi-log-id'] ?? null)
            ? $this->headers['x-facturapi-log-id']
            : null;
    }

    public function getResponseHeaders(): array
    {
        return $this->headers;
    }
}
