<?php

namespace CAC\Rest;


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
	 * @return the $headers
	 */
	public function getHeaders() 
	{
		return $this->headers;
	}

	/**
	 * @return the $responseCode
	 */
	public function getResponseCode() 
	{
		return $this->responseCode;
	}
	
	/**
	 * Check if the response was successful
	 */
	public function isSuccess()
	{
		return floor($this->responseCode / 100) >= 4;
	}

	/**
	 * @return the $content
	 */
	public function getContent() 
	{
		return $this->content;
	}

	/**
	 * @param multitype: $headers
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
	 * @param integer $responseCode
	 */
	public function setResponseCode($responseCode) 
	{
		$this->responseCode = $responseCode;
	}

	/**
	 * @param mixed $content
	 */
	public function setContent($content) 
	{
		$this->content = $content;
	}
	
}