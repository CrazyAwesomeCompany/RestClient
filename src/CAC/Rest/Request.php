<?php

namespace CAC\Rest;


class Request
{

    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    private $method;

    private $url;

    private $parameters;

    private $headers = array(
        'content-type' => 'application/json',
        'X-CAC-REQUEST' => 'CAC Rest Client'
    );

	/**
     * @return the $method
     */
    public function getMethod ()
    {
        return $this->method;
    }

	/**
     * @return the $url
     */
    public function getUrl ()
    {
        return $this->url;
    }

	/**
     * @return the $parameters
     */
    public function getParameters ()
    {
        return $this->parameters;
    }

	/**
     * @return the $headers
     */
    public function getHeaders ()
    {
        return $this->headers;
    }

	/**
     * @param field_type $method
     */
    public function setMethod ($method)
    {
        $this->method = $method;
    }

	/**
     * @param field_type $url
     */
    public function setUrl ($url)
    {
        $this->url = $url;
    }

	/**
     * @param field_type $parameters
     */
    public function setParameters ($parameters)
    {
        $this->parameters = $parameters;
    }

	/**
     * @param field_type $headers
     */
    public function setHeaders ($headers)
    {
        $this->headers = $headers;
    }

    public function setHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }


    /**
     * Get the request object as a string
     *
     * @return string
     */
    public function __toString()
    {
        $str = '';
        $str .= sprintf("[%s] %s", $this->method, $this->url);
        $str .= PHP_EOL;

        $headers = array();
        foreach ($this->headers as $key => $value) {
            $headers[] = sprintf("%s: %s", $key, $value);
        }

        $str .= implode(PHP_EOL, $headers);
        $str .= PHP_EOL . PHP_EOL;

        $str .= json_encode($this->parameters);

        return $str;
    }

}