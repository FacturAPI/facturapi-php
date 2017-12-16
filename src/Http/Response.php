<?php

use ArrayAccess;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response implements ResponseInterface, ArrayAccess
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $response;
    
    /**
     * @var mixed
     */
    public $data;


    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->data = $this->getDataFromResponse($response);
    }


    /**
     * Get the api data from the response as usual.
     *
     * @param  string  $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data->$name;
    }


    /**
     * @param  ResponseInterface $response
     * @return mixed
     */
    private function getDataFromResponse(ResponseInterface $response)
    {
        $contents = $response->getBody()->getContents();
        return $contents ? json_decode($contents) : null;
    }


    /**
     * Get the underlying data.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * Return an array of the data.
     *
     * @return array
     */
    public function toArray()
    {
        return json_decode(json_encode($this->data), true);
    }


    /**
     * Retrieves all message header values.
     * 
     * While header names are not case-sensitive, getHeaders() will preserve the
     * exact case in which headers were originally specified.
     *
     * @return array Returns an associative array of the message's headers. Each
     *     key MUST be a header name, and each value MUST be an array of strings
     *     for that header.
     */
    public function getHeaders()
    {
        return $this->response->getHeaders();
    }


    /**
     * Checks if a header exists by the given case-insensitive name.
     *
     * @param string $name Case-insensitive header field name.
     * @return bool Returns true if any header names match the given header
     *     name using a case-insensitive string comparison. Returns false if
     *     no matching header name is found in the message.
     */
    public function hasHeader($name)
    {
        return $this->response->hasHeader($name);
    }


    /**
     * Retrieves a message header value by the given case-insensitive name.
     *
     * This method returns an array of all the header values of the given
     * case-insensitive header name.
     *
     * If the header does not appear in the message, this method MUST return an
     * empty array.
     *
     * @param string $name Case-insensitive header field name.
     * @return string[] An array of string values as provided for the given
     *    header. If the header does not appear in the message, this method MUST
     *    return an empty array.
     */
    public function getHeader($name)
    {
        return $this->response->getHeader($name);
    }


    /**
     * Gets the body of the message.
     *
     * @return StreamInterface Returns the body as a stream.
     */
    public function getBody()
    {
        return $this->response->getBody();
    }


    /**
     * Gets the response status code.
     *
     * @return int Status code.
     */
    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }
}
