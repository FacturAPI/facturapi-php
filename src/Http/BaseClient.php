<?php

namespace Facturapi\Http;

use Facturapi\Exceptions\FacturapiException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

class BaseClient
{
	// BaseClient class to be extended by specific clients
	protected string $FACTURAPI_KEY;
	protected string $ENDPOINT = '';
	protected string $API_VERSION = 'v2';
	protected string $BASE_URL = 'https://www.facturapi.io/';
	protected float $CONNECT_TIMEOUT = 3.0;
	protected float $TIMEOUT = 360.0;
	protected string $USER_AGENT = 'facturapi-php';
	/**
	 * The HTTP status of the most recent request
	 *
	 * @var int|null
	 */
	protected ?int $lastStatus = null;
	/**
	 * @var ClientInterface
	 */
	protected ClientInterface $httpClient;
	/**
	 * The HTTP code for a successful request
	 */
	const STATUS_OK = 200;
	/**
	 * The HTTP code for bad request
	 */
	const STATUS_BAD_REQUEST = 400;
	/**
	 * The HTTP code for unauthorized
	 */
	const STATUS_UNAUTHORIZED = 401;
	/**
	 * The HTTP code for resource not found
	 */
	const STATUS_NOT_FOUND = 404;

	/**
	 * Constructor.
	 *
	 * @param string $apiKey Facturapi API key.
	 * @param array{apiVersion?:string,timeout?:int|float,httpClient?:ClientInterface}|null $config
	 *        Optional SDK config. Supported keys: apiVersion, timeout, httpClient.
	 * @throws FacturapiException
	 */
	public function __construct(string $apiKey, ?array $config = null)
	{
		$this->FACTURAPI_KEY = base64_encode($apiKey . ":");

		$normalized = $this->normalizeConfig($config);
		$this->API_VERSION = $normalized['apiVersion'];
		$httpClient = $normalized['httpClient'];
		$this->applyHttpConfig($normalized['httpConfig']);

		$this->httpClient = $httpClient ?: new Client(array(
			'timeout' => $this->TIMEOUT,
			'connect_timeout' => $this->CONNECT_TIMEOUT,
			'verify' => true,
			'http_errors' => false,
			'allow_redirects' => true,
		));
	}

	/**
	 * Gets the status code from the most recent HTTP request.
	 *
	 * @return int|null
	 */
	public function getLastStatus(): ?int
	{
		return $this->lastStatus;
	}

	/**
	 * Returns ENDPOINT that is set in specific api clients.  All
	 * clients that extend BaseClient should set $ENDPOINT to the
	 * base path for the API (e.g.: the customers api sets the value to
	 * 'customers')
	 *
	 * @throws FacturapiException
	 */
	protected function getEndpoint(): string
	{
		if (empty($this->ENDPOINT)) {
			throw new FacturapiException('ENDPOINT must be defined');
		}

		return $this->ENDPOINT;
	}

	/**
	 * Returns API_VERSION that is set in specific api clients. All
	 * clients that extend BaseClient should set $API_VERSION to the
	 * version that the client is developed for (e.g.: the customers v1
	 * client sets the value to 'v1')
	 *
	 * @throws FacturapiException
	 */
	protected function getApiVersion(): string
	{
		if (empty($this->API_VERSION)) {
			throw new FacturapiException('API_VERSION must be defined');
		}

		return $this->API_VERSION;
	}

	/**
	 * Creates the url to be used for the api request
	 *
	 * @param array|string|null $params Path segment or query parameters.
	 * @param array|null $query Query parameters for nested endpoints.
	 * @return string
	 */
	protected function getRequestUrl($params = null, $query = null): string
	{
		$param_string = $params == null ? "" : (
			is_string($params)
			? ($query == null
				? "/" . $params
				: "/" . $params . $this->arrayToParams($query)
			) : $this->arrayToParams($params)
		);

		return $this->BASE_URL . $this->getApiVersion() . "/" . $this->getEndpoint() . $param_string;
	}

	/**
	 * Executes HTTP GET request
	 *
	 * @param string $url URL to call.
	 * @return string Response body.
	 *
	 * @throws FacturapiException
	 */
	protected function executeGetRequest($url): string
	{
		return $this->executeRequest('GET', $url);
	}

	/**
	 * Executes HTTP POST request
	 *
	 * @param string $url URL to call.
	 * @param mixed $body Request body.
	 * @param bool $formenc Whether to send as form-urlencoded.
	 * @return string Response body.
	 *
	 * @throws FacturapiException
	 */
	protected function executePostRequest($url, $body, $formenc = false): string
	{
		$headers = array();
		$payload = null;

		if ($formenc) {
			$headers['Content-Type'] = 'application/x-www-form-urlencoded';
			$payload = is_array($body) ? http_build_query($body) : (string) $body;
		} elseif (is_array($body)) {
			$payload = http_build_query($body);
		} elseif ($body !== null) {
			$payload = (string) $body;
		}

		return $this->executeRequest('POST', $url, $headers, $payload);
	}

	/**
	 * Executes HTTP POST request with JSON as the POST body
	 *
	 * @param string $url URL to call.
	 * @param array|null $body Request body.
	 * @return string Response body.
	 *
	 * @throws FacturapiException
	 */
	protected function executeJsonPostRequest($url, $body = null): string
	{
		$payload = null;
		if ($body !== null) {
			$payload = json_encode($body);
			if ($payload === false) {
				throw new FacturapiException('Unable to encode JSON payload: ' . json_last_error_msg());
			}
		}

		return $this->executeRequest('POST', $url, array('Content-Type' => 'application/json'), $payload);
	}

	/**
	 * Executes HTTP PUT request
	 *
	 * @param string $url URL to call.
	 * @param array|null $body Request body.
	 *
	 * @return string Response body.
	 *
	 * @throws FacturapiException
	 */
	protected function executeJsonPutRequest($url, $body): string
	{
		$payload = null;
		if ($body !== null) {
			$payload = json_encode($body);
			if ($payload === false) {
				throw new FacturapiException('Unable to encode JSON payload: ' . json_last_error_msg());
			}
		}

		return $this->executeRequest('PUT', $url, array('Content-Type' => 'application/json'), $payload);
	}

	/**
	 * Executes HTTP PUT request
	 *
	 * @param string $url URL to call.
	 * @param array|string $body Multipart payload definition.
	 *
	 * @return string Response body.
	 *
	 * @throws FacturapiException
	 */
	protected function executeDataPutRequest($url, $body): string
	{
		$openStreams = array();

		if (is_array($body)) {
			if (!isset($body['cerFile'], $body['keyFile'], $body['password'])) {
				throw new FacturapiException('Invalid certificate payload. Expected cerFile, keyFile and password.');
			}

			$cerStream = $this->openFileStream($body['cerFile']);
			$keyStream = $this->openFileStream($body['keyFile']);
			$openStreams[] = $cerStream;
			$openStreams[] = $keyStream;

			$multipart = new MultipartStream(array(
				array(
					'name' => 'cer',
					'contents' => Utils::streamFor($cerStream),
					'filename' => basename($body['cerFile'])
				),
				array(
					'name' => 'key',
					'contents' => Utils::streamFor($keyStream),
					'filename' => basename($body['keyFile'])
				),
				array(
					'name' => 'password',
					'contents' => (string) $body['password']
				),
			));
		} else {
			$fileStream = $this->openFileStream($body);
			$openStreams[] = $fileStream;
			$multipart = new MultipartStream(array(
				array(
					'name' => 'file',
					'contents' => Utils::streamFor($fileStream),
					'filename' => basename($body)
				),
			));
		}

		$headers = array(
			'Content-Type' => 'multipart/form-data; boundary=' . $multipart->getBoundary(),
		);

		try {
			return $this->executeRequest('PUT', $url, $headers, $multipart, true);
		} finally {
			foreach ($openStreams as $stream) {
				if (is_resource($stream)) {
					fclose($stream);
				}
			}
		}
	}

	/**
	 * Executes HTTP DELETE request
	 *
	 * @param string $url URL to call.
	 * @param string|null $body Request body.
	 *
	 * @return string Response body.
	 *
	 * @throws FacturapiException
	 */
	protected function executeDeleteRequest($url, $body): string
	{
		$payload = $body === null ? null : (string) $body;
		return $this->executeRequest('DELETE', $url, array('Content-Type' => 'application/json'), $payload, true);
	}

	/**
	 * Converts an array into url friendly list of parameters
	 *
	 * @param array|null $params Parameters (name => value).
	 * @return string URL query string.
	 */
	protected function arrayToParams($params): string
	{
		if ($params == null) {
			return '';
		}

		$parts = array();
		foreach ($params as $parameter => $value) {
			if (is_array($value)) {
				foreach ($value as $key => $sub_param) {
					$parts[] = $parameter . '[' . $key . ']' . '=' . urlencode((string) $sub_param);
				}
			} else {
				$param = is_bool($value) ? ($value ? 'true' : 'false') : urlencode((string) $value);
				$parts[] = $parameter . '=' . $param;
			}
		}

		return empty($parts) ? '' : '?' . implode('&', $parts);
	}

	/**
	 * Executes an HTTP request and optionally validates 2xx status.
	 *
	 * @param string $method HTTP method.
	 * @param string $url URL to call.
	 * @param array $headers Request headers.
	 * @param mixed $body Request body.
	 * @param bool $validateStatus Whether to throw on non-2xx status.
	 * @return string Response body.
	 * @throws FacturapiException
	 */
	protected function executeRequest($method, $url, $headers = array(), $body = null, $validateStatus = true): string
	{
		$request = new Request(
			$method,
			$url,
			$this->buildHeaders($headers),
			$body === null ? '' : $body
		);

		try {
			$response = $this->httpClient->sendRequest($request);
		} catch (ClientExceptionInterface $e) {
			throw new FacturapiException($e->getMessage(), 0, $e);
		}

		$this->lastStatus = $response->getStatusCode();
		$output = (string) $response->getBody();

		if ($validateStatus && ($this->lastStatus < 200 || $this->lastStatus > 299)) {
			$decoded = json_decode($output, true);
			$errorData = is_array($decoded) ? $decoded : null;
			$message = $this->extractErrorMessage($errorData, $output);

			throw new FacturapiException(
				$message,
				0,
				null,
				$errorData,
				$this->lastStatus,
				$output,
				$this->normalizeResponseHeaders($response->getHeaders())
			);
		}

		return $output;
	}

	private function normalizeResponseHeaders(array $headers): array
	{
		$normalized = array();
		foreach ($headers as $name => $values) {
			$normalized[strtolower($name)] = is_array($values) ? implode(', ', $values) : (string) $values;
		}
		return $normalized;
	}

	/**
	 * Extracts a human-readable message from known API error shapes.
	 *
	 * @param array|null $errorData Decoded API error payload.
	 * @param string $rawBody Raw response body.
	 * @return string
	 */
	private function extractErrorMessage(?array $errorData, string $rawBody): string
	{
		if ($errorData === null) {
			return $rawBody;
		}

		if (isset($errorData['message']) && is_string($errorData['message'])) {
			return $errorData['message'];
		}

		if (
			isset($errorData['error']) &&
			is_array($errorData['error']) &&
			isset($errorData['error']['message']) &&
			is_string($errorData['error']['message'])
		) {
			return $errorData['error']['message'];
		}

		if (
			isset($errorData['errors']) &&
			is_array($errorData['errors']) &&
			isset($errorData['errors'][0]) &&
			is_array($errorData['errors'][0]) &&
			isset($errorData['errors'][0]['message']) &&
			is_string($errorData['errors'][0]['message'])
		) {
			return $errorData['errors'][0]['message'];
		}

		$encoded = json_encode($errorData);
		return $encoded === false ? $rawBody : $encoded;
	}

	/**
	 * Builds base headers for API requests.
	 *
	 * @param array $headers Additional request headers.
	 * @return array
	 */
	protected function buildHeaders($headers): array
	{
		$base_headers = array(
			'Authorization' => 'Basic ' . $this->FACTURAPI_KEY,
			'User-Agent' => $this->USER_AGENT,
		);

		foreach ($headers as $name => $value) {
			$base_headers[$name] = $value;
		}

		return $base_headers;
	}

	/**
	 * Opens a file stream for multipart uploads.
	 *
	 * @param string $path File path.
	 * @return resource
	 * @throws FacturapiException
	 */
	protected function openFileStream($path)
	{
		$stream = @fopen($path, 'rb');
		if ($stream === false) {
			throw new FacturapiException('Unable to open file: ' . $path);
		}

		return $stream;
	}

	/**
	 * Applies optional HTTP configuration for the internal client.
	 *
	 * @param array $httpConfig HTTP settings.
	 * @throws FacturapiException
	 */
	protected function applyHttpConfig(array $httpConfig): void
	{
		if (array_key_exists('timeout', $httpConfig)) {
			$this->TIMEOUT = $this->validateTimeoutValue($httpConfig['timeout'], 'timeout');
		}
	}

	/**
	 * Normalizes constructor HTTP config.
	 *
	 * @param array{apiVersion?:string,timeout?:int|float,httpClient?:ClientInterface}|null $config
	 * @return array{apiVersion:string,httpClient:ClientInterface|null,httpConfig:array}
	 * @throws FacturapiException
	 */
	protected function normalizeConfig(?array $config): array
	{
		if ($config === null) {
			return array(
				'apiVersion' => 'v2',
				'httpClient' => null,
				'httpConfig' => array()
			);
		}

		$allowedKeys = array('apiVersion', 'timeout', 'httpClient');
		foreach (array_keys($config) as $configKey) {
			if (!in_array($configKey, $allowedKeys, true)) {
				throw new FacturapiException('SDK config "' . $configKey . '" is not supported. Allowed keys: apiVersion, timeout, httpClient.');
			}
		}

		$apiVersion = 'v2';
		if (array_key_exists('apiVersion', $config)) {
			$version = $config['apiVersion'];
			if (!is_string($version) || trim($version) === '') {
				throw new FacturapiException('Config key "apiVersion" must be a non-empty string.');
			}
			$apiVersion = $version;
		}

		$httpClient = $config['httpClient'] ?? null;

		if ($httpClient !== null && !($httpClient instanceof ClientInterface)) {
			throw new FacturapiException('Config key "httpClient" must implement Psr\\Http\\Client\\ClientInterface.');
		}

		if ($httpClient !== null && array_key_exists('timeout', $config)) {
			throw new FacturapiException('When using "httpClient", configure timeout directly on that client.');
		}

		$httpConfig = array();
		if (array_key_exists('timeout', $config)) {
			$httpConfig['timeout'] = $config['timeout'];
		}

		return array(
			'apiVersion' => $apiVersion,
			'httpClient' => $httpClient,
			'httpConfig' => $httpConfig
		);
	}

	/**
	 * Validates timeout values.
	 *
	 * @param mixed $value Timeout value in seconds.
	 * @param string $name Option name.
	 * @return float
	 * @throws FacturapiException
	 */
	protected function validateTimeoutValue(mixed $value, string $name): float
	{
		if (!is_numeric($value)) {
			throw new FacturapiException('HTTP config "' . $name . '" must be numeric (seconds)');
		}

		$timeout = (float) $value;
		if ($timeout <= 0) {
			throw new FacturapiException('HTTP config "' . $name . '" must be greater than 0');
		}

		return $timeout;
	}
}
