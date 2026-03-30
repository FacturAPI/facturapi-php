<?php

namespace Facturapi\Exceptions;

use Exception;
use Throwable;

class FacturapiException extends Exception
{
	private mixed $errorData;
	private ?int $statusCode;
	private ?string $rawBody;

	public function __construct(
		string $message = '',
		int $code = 0,
		?Throwable $previous = null,
		mixed $errorData = null,
		?int $statusCode = null,
		?string $rawBody = null
	) {
		parent::__construct($message, $code, $previous);
		$this->errorData = $errorData;
		$this->statusCode = $statusCode;
		$this->rawBody = $rawBody;
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
}
