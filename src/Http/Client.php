<?php

require ‘vendor/autoload.php’;

use GuzzleHttp\Client as GuzzleClient;

use GuzzleHttp\Exception\RequestException;

use GuzzleHttp\Psr7\Request;

Class Client {

    private $client = null;

    const BASE_URL = "https://www.facturapi.io/v1";

    var $api_key;

    public function __construct( $key, $client = null ){

        $this->api_key = isset($key) ? $key : getenv("FACTURAPI_KEY");
        if (empty($this->key)) {
            throw new InvalidArgument("You must provide a Facturapi api key.");
        }

        $this->client = $client ?: new GuzzleClient();

    }

}