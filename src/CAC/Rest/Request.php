<?php
/*
 * This file is part of the Crazy Awesome Company package.
*
* (c) Nick de Groot <nick@crazyawesomecompany.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace CAC\Rest;

/**
 * Rest Request Class
 *
 * @author Nick de Groot <nick@crazyawesomecompany.com>
 */
class Request
{

    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    /**
     * Request Method
     *
     * @var string
     */
    private $method;

    /**
     * Request Url
     *
     * @var string
     */
    private $url;

    /**
     * Request payload parameters
     *
     * @var mixed
     */
    private $parameters;

    /**
     * Request headers
     *
     * @var array
     */
    private $headers = array(
        'content-type' => 'application/json',
        'X-CAC-REQUEST' => 'CAC Rest Client'
    );

    /**
     * Get the request method
     *
     * @return string
     */
    public function getMethod ()
    {
        return $this->method;
    }

    /**
     * Get the request url
     *
     * @return string
     */
    public function getUrl ()
    {
        return $this->url;
    }

    /**
     * Get the request payload
     *
     * @return mixed
     */
    public function getParameters ()
    {
        return $this->parameters;
    }

    /**
     * Get the request headers
     *
     * @return array
     */
    public function getHeaders ()
    {
        return $this->headers;
    }

    /**
     * Set the request method
     *
     * @param string $method
     */
    public function setMethod ($method)
    {
        $this->method = $method;
    }

    /**
     * Set the request url
     *
     * @param string $url
     */
    public function setUrl ($url)
    {
        $this->url = $url;
    }

    /**
     * Set the request payload
     *
     * @param mixed $parameters
     */
    public function setParameters ($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Set the request headers
     *
     * @param array $headers
     */
    public function setHeaders ($headers)
    {
        $this->headers = $headers;
    }

    /**
     * Set a request header
     *
     * @param string $key   The header name
     * @param string $value The header value
     */
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
