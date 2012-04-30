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
 * Rest Response Class
 *
 * @author Nick de Groot <nick@crazyawesomecompany.com>
 */
class Response
{

    /**
     * The headers
     *
     * @var array
     */
    private $headers = array();

    /**
     * The response code
     *
     * @var integer
     */
    private $responseCode;

    /**
     * The response body
     *
     * @var mixed
     */
    private $content;


    /**
     * Get the response headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Get the response code
     *
     * @return integer
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * Check if the response was successful
     *
     * @return boolean
     */
    public function isSuccess()
    {
        return floor($this->responseCode / 100) >= 4;
    }

    /**
     * Get the response body
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the response headers
     *
     * @param array $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * Set a header
     *
     * @param string $key   The header name
     * @param string $value The header value
     */
    public function setHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * Set the response code
     *
     * @param integer $responseCode
     */
    public function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;
    }

    /**
     * Set the response body
     *
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

}