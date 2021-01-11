<?php

namespace Facturapi\Http;

use Facturapi\Exceptions\Facturapi_Exception;

class BaseClient {
	// BaseClient class to be extended by specific clients
	protected $FACTURAPI_KEY;
	protected $ENDPOINT;
	protected $API_VERSION;
	protected $BASE_URL = 'https://www.facturapi.io/';
	/**
	 * The HTTP status of the most recent request
	 *
	 * @var integer
	 */
	protected $lastStatus;
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
	 * @param $FACTURAPI_KEY : String value of Facturapi API Key for requests
	 */
	public function __construct( $FACTURAPI_KEY ) {
		$this->FACTURAPI_KEY = base64_encode( $FACTURAPI_KEY . ":" );
	}

	/**
	 * Gets the status code from the most recent curl request
	 *
	 * @return integer
	 */
	public function getLastStatus() {
		return (int) $this->lastStatus;
	}

	/**
	 * Returns ENDPOINT that is set in specific api clients.  All
	 * clients that extend BaseClient should set $ENDPOINT to the
	 * base path for the API (e.g.: the customers api sets the value to
	 * 'customers')
	 *
	 * @throws Facturapi_Exception
	 */
	protected function get_endpoint() {
		if ( empty( $this->ENDPOINT ) ) {
			throw new Facturapi_Exception( 'ENDPOINT must be defined' );
		} else {
			return $this->ENDPOINT;
		}
	}

	/**
	 * Returns API_VERSION that is set in specific api clients. All
	 * clients that extend BaseClient should set $API_VERSION to the
	 * version that the client is developed for (e.g.: the customers v1
	 * client sets the value to 'v1')
	 *
	 * @throws Facturapi_Exception
	 */
	protected function get_api_version() {
		if ( empty( $this->API_VERSION ) ) {
			throw new Facturapi_Exception( 'API_VERSION must be defined' );
		} else {
			return $this->API_VERSION;
		}
	}

	/**
	 * Creates the url to be used for the api request
	 *
	 * @param params : Array containing query parameters and values
	 *
	 * @returns String
	 */
	protected function get_request_url( $params = null ) {
		$param_string = is_string( $params ) ? $params : $this->array_to_params( $params );

		return $this->BASE_URL . $this->get_api_version() . "/" . $this->get_endpoint() . "/" . $param_string;
	}

	/**
	 * Executes HTTP GET request
	 *
	 * @param URL : String value for the URL to GET
	 *
	 * @return Body of request result
	 *
	 * @throws Facturapi_Exception
	 */
	protected function execute_get_request( $url ) {
		$headers[] = 'Authorization: Basic ' . $this->FACTURAPI_KEY;

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_ENCODING, "gzip" );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );

		$output = curl_exec( $ch );
		$errno  = curl_errno( $ch );
		$error  = curl_error( $ch );
		$this->setLastStatusFromCurl( $ch );
		curl_close( $ch );
		if ( $errno > 0 ) {
			throw new Facturapi_Exception( 'cURL error: ' . $error );
		} else {
			return $output;
		}
	}

	/**
	 * Executes HTTP POST request
	 *
	 * @param URL : String value for the URL to POST to
	 * @param fields : Array containing names and values for fields to post
	 *
	 * @return Body of request result
	 *
	 * @throws Facturapi_Exception
	 */
	protected function execute_post_request( $url, $body, $formenc = false ) {
		$headers[] = 'Authorization: Basic ' . $this->FACTURAPI_KEY;
		if ( $formenc ) {
			$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		}
		// initialize cURL and send POST data
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $body );
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );


		$output = curl_exec( $ch );
		$errno  = curl_errno( $ch );
		$error  = curl_error( $ch );
		$this->setLastStatusFromCurl( $ch );
		curl_close( $ch );
		if ( $errno > 0 ) {
			throw new Facturapi_Exception( 'cURL error: ' . $error );
		} else {
			return $output;
		}
	}

	/**
	 * Executes HTTP POST request with JSON as the POST body
	 *
	 * @param URL String value for the URL to POST to
	 * @param fields array containing names and values for fields to post
	 *
	 * @return Body of request result
	 *
	 * @throws Facturapi_Exception
	 */
	protected function execute_JSON_post_request( $url, $body ) {
		$headers[] = 'Authorization: Basic ' . $this->FACTURAPI_KEY;
		$headers[] = 'Content-Type: application/json';

		// initialize cURL and send POST data
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $body ) );
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

		$output = curl_exec( $ch );
		$errno  = curl_errno( $ch );
		$error  = curl_error( $ch );
		$this->setLastStatusFromCurl( $ch );
		curl_close( $ch );
		if ( $errno > 0 ) {
			throw new Facturapi_Exception( 'cURL error: ' . $error );
		} else {
			return $output;
		}
	}

	/**
	 * Executes HTTP PUT request
	 *
	 * @param URL String value for the URL to PUT to
	 * @param array $body
	 *
	 * @return Body of request result
	 *
	 * @throws Facturapi_Exception
	 */
	protected function execute_JSON_put_request( $url, $body ) {
		$headers[] = 'Authorization: Basic ' . $this->FACTURAPI_KEY;
		$headers[] = 'Content-Type: application/json';

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "PUT" );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $body ) );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );

		$result = curl_exec( $ch );
		$errno  = curl_errno( $ch );
		$error  = curl_error( $ch );
		$this->setLastStatusFromCurl( $ch );
		curl_close( $ch );
		if ( $errno > 0 ) {
			throw new Facturapi_Exception( 'cURL error: ' . $error );
		} else {
			return $result;
		}
	}

	/**
	 * Executes HTTP PUT request
	 *
	 * @param URL String value for the URL to PUT to
	 * @param array $body
	 *
	 * @return Body of request result
	 *
	 * @throws Facturapi_Exception
	 */
	protected function execute_data_put_request( $url, $body ) {
		$headers[] = 'Authorization: Basic ' . $this->FACTURAPI_KEY;
		$headers[] = 'Content-Type: multipart/form-data';

		$data = is_array( $body ) ? array(
			'cer' => new \CURLFile($body['cerFile']),
			'key' => new \CURLFile($body['keyFile']),
			'password' => $body['password']
		) : array(
			'file' => new \CURLFile($body)
		);

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "PUT" );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );

		$result = curl_exec( $ch );
		$errno  = curl_errno( $ch );
		$error  = curl_error( $ch );
		$this->setLastStatusFromCurl( $ch );
		curl_close( $ch );
		if ( $errno > 0 ) {
			throw new Facturapi_Exception( 'cURL error: ' . $error );
		} else {
			return $result;
		}
	}
	
	/**
	 * Executes HTTP DELETE request
	 *
	 * @param URL String value for the URL to DELETE to
	 * @param String $body
	 *
	 * @return Body of request result
	 *
	 * @throws Facturapi_Exception
	 */
	protected function execute_delete_request( $url, $body ) {
		$headers[] = 'Authorization: Basic ' . $this->FACTURAPI_KEY;
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Content-Length: ' . strlen( $body );

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "DELETE" );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $body );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );

		$result = curl_exec( $ch );
		$errno  = curl_errno( $ch );
		$error  = curl_error( $ch );
		$this->setLastStatusFromCurl( $ch );
		curl_close( $ch );
		if ( $errno > 0 ) {
			throw new Facturapi_Exception( 'cURL error: ' . $error );
		} else {
			return $result;
		}
	}

	/**
	 * Converts an array into url friendly list of parameters
	 *
	 * @param array params Multidimensional array of parameters (name=>value)
	 *
	 * @return String of url friendly parameters (&name=value&foo=bar)
	 */
	protected function array_to_params( $params ) {
		$param_string = '?';
		if ( $params != null ) {
			foreach ( $params as $parameter => $value ) {
				if ( is_array( $value ) ) {
					foreach ( $value as $sub_param ) {
						$param_string = $param_string . '&' . $parameter . '=' . urlencode( $sub_param );
					}
				} else {
					$param_string = $param_string . '&' . $parameter . '=' . urlencode( $value );
				}
			}
		}

		return $param_string;
	}

	/**
	 * Sets the status code from a curl request
	 *
	 * @param resource $ch
	 */
	protected function setLastStatusFromCurl( $ch ) {
		$info             = curl_getinfo( $ch );
		$this->lastStatus = ( isset( $info['http_code'] ) ) ? $info['http_code'] : null;
	}
}
