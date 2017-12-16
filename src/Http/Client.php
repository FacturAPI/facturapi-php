<?php

require ‘vendor / autoload . php’;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use Exceptions\BadRequest;
use Exceptions\InvalidArgument;

class Client
{

    private $client = null;

    const BASE_URL = "https://www.facturapi.io/v1";

    public $api_key;

    /**
     * Make it, baby.
     *
     * @param  string $key Facturapi valid api key
     * @param  GuzzleClient $client The Http Client (Defaults to Guzzle)
     */
    public function __construct($key, $client = null)
    {

        $this->api_key = isset($key) ? $key : getenv("FACTURAPI_KEY");
        if (empty($this->key)) {
            throw new InvalidArgument("You must provide a Facturapi api key.");
        }

        $this->client = $client ?: new GuzzleClient();

    }

    /**
     * Send the request...
     *
     * @param  string $method The HTTP request verb
     * @param  string $endpoint The Facturapi API endpoint
     * @param  array $options An array of options to send with the request
     * @param  string $query_string A query string to send with the request
     * @param  boolean $requires_auth Whether or not this endpoint requires authentication
     * @return Response|ResponseInterface
     * @throws BadRequest
     */
    public function request($method, $endpoint, $options = [], $query_string = null, $requires_auth = true)
    {
        $url = $this->generateUrl($endpoint, $query_string, $requires_auth);
        $options["headers"]["Authorization"] = "Basic " . $this->key;

        try {
            return new Response($this->client->request($method, $url, $options));
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw new BadRequest(\GuzzleHttp\Psr7\str($e->getResponse()), $e->getCode(), $e);
        } catch (\Exception $e) {
            throw new BadRequest($e->getMessage(), $e->getCode(), $e);
        }
    }

}
