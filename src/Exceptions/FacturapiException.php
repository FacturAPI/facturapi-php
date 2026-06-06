<?php

namespace Facturapi\Exceptions;

use Exception;
use Throwable;

class FacturapiException extends Exception
{
	private mixed $errorData;
	private ?int $statusCode;
	private ?string $rawBody;
	private array $headers;

	public function __construct(
		string $message = '',
		int $code = 0,
		?Throwable $previous = null,
		mixed $errorData = null,
		?int $statusCode = null,
		?string $rawBody = null,
		array $headers = array()
	) {
		parent::__construct($message, $code, $previous);
		$this->errorData = $errorData;
		$this->statusCode = $statusCode;
		$this->rawBody = $rawBody;
		$this->headers = $headers;
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

	public function getErrorCode(): mixed
	{
		return is_array($this->errorData) ? ($this->errorData['code'] ?? null) : null;
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
