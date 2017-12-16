<?php

require ‘vendor / autoload . php’;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use Exceptions\BadRequest;
use Exceptions\InvalidArgument;

class Client
{
    const BASE_URL = "https://www.facturapi.io/v1";

    /** @var \GuzzleHttp\Client */
    private $client = null;

    /** @var string */
    public $api_key;

    /**
     * Guzzle allows options into its request method. Prepare for some defaults
     * @var array
     */
    protected $clientOptions = [];
    /**
     * if set to false, no Response object is created, but the one from Guzzle is directly returned
     * comes in handy own error handling
     *
     * @var bool
     */
    protected $wrapResponse = true;

    /**
     * Make it, baby.
     *
     * @param string $key Facturapi valid api key
     * @param GuzzleClient $client The Http Client (Defaults to Guzzle)
     * @param array $clientOptions options to be passed to Guzzle upon each request
     * @param bool $wrapResponse wrap request response in own Response object
     */
    public function __construct($key, $client = null, $clientOptions = [], $wrapResponse = true)
    {

        $this->clientOptions = $clientOptions;
        $this->wrapResponse = $wrapResponse;

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
     * @return Response|ResponseInterface
     * @throws BadRequest
     */
    public function request($method, $endpoint, $options = [], $query_string = null)
    {
        $url = $this->generateUrl($endpoint, $query_string, $requires_auth);
        $options = array_merge($this->clientOptions, $options);
        $options["headers"]["Authorization"] = "Basic " . base64_encode($this->key.":");

        try {
            if ($this->wrapResponse === false) {
                return $this->client->request($method, $url, $options);
            }
            return new Response($this->client->request($method, $url, $options));
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw new BadRequest(\GuzzleHttp\Psr7\str($e->getResponse()), $e->getCode(), $e);
        } catch (\Exception $e) {
            throw new BadRequest($e->getMessage(), $e->getCode(), $e);
        }
    }


    /**
     * Generate the full endpoint url, including query string.
     *
     * @param  string  $endpoint      The HubSpot API endpoint.
     * @param  string  $query_string  The query string to send to the endpoint.
     * @return string
     */
    protected function generateUrl($endpoint, $query_string = null)
    {
        return BASE_URL.$endpoint."?".$query_string;
    }

}
