<?php

namespace CAC\Rest;

use CAC\Rest\Events\RestResponseEvent;
use CAC\Rest\Events\RestRequestEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use CAC\Rest\Client\ClientAdapter;

/**
 * Rest Client
 *
 * Connect to an external Rest service with this client. It will return Response classes
 *
 * @author Nick de Groot <nick@crazyawesomecompany.com>
 */
class Client
{

	/**
	 * The base url of the server connection to
	 *
	 * @var string
	 */
	private $baseUrl;

	/**
	 * The Client Adapter
	 *
	 * @var ClientAdapter
	 */
	private $adapter;

	/**
     * The Event Dispatcher
     *
     * @var EventDispatcherInterface
	 */
	private $dispatcher = null;

	/**
	 * Constructor
	 *
	 * @param ClientAdapter $adapter The Rest Client Adapater
	 * @param string        $baseUrl The base url of the server
	 */
	public function __construct(ClientAdapter $adapter, $baseUrl)
	{
		$this->adapter = $adapter;
		$this->baseUrl = $baseUrl;
	}

	/**
	 * Perform a request to the server
	 *
	 * @param Request|string $method The request object or the request method
	 * @param string         $url    The request url
	 * @param array          $params The parameters
	 *
	 * @return Response
	 */
	public function request($method, $url = null, $params = array())
	{
		if (!($method instanceof Request)) {
		    $request = new Request();
		    $request->setMethod($method);

		    $url = $this->baseUrl . $url;
		    $request->setUrl($url);
		    $request->setParameters($params);

		} else {
		    $request = $method;
		}

		// Send request event
		if ($this->dispatcher) {
		    $event = new RestRequestEvent($request);
		    $this->dispatcher->dispatch(RestEvents::REQUEST, $event);
		}

		$response = $this->adapter->request($request);

		// Send response event
        if ($this->dispatcher) {
            $event = new RestResponseEvent($response, $request);
            $this->dispatcher->dispatch(RestEvents::RESPONSE, $event);
        }

		return $response;
	}

	/**
	 * Perform a get request to the server
	 *
	 * @param string $url    The request url
	 * @param array  $params The request parameters
	 *
	 * @return Response
	 */
	public function get($url, $params = array())
	{
		return $this->request(Request::GET, $url, $params);
	}

	/**
	 * Perform a post request to the server
	 *
	 * @param string $url    The request url
	 * @param array  $params The request parameters
	 *
	 * @return Response
	 */
	public function post($url, $params = array())
	{
		return $this->request(Request::POST, $url, $params);
	}

	/**
	 * Perform a put request to the server
	 *
	 * @param string $url    The request url
	 * @param array  $params The request parameters
	 *
	 * @return Response
	 */
	public function put($url, $params = array())
	{
		return $this->request(Request::PUT, $url, $params);
	}

	/**
	 * Perform a delete request to the server
	 *
	 * @param string $url The request url
	 *
	 * @return Response
	 */
	public function delete($url)
	{
		return $this->request(Request::DELETE, $url);
	}

	/**
	 * Set the Event Dispatcher
	 *
	 * @param EventDispatcherInterface $dispatcher The EventDispatcher
	 */
	public function setEventDispatcher(EventDispatcherInterface $dispatcher)
	{
	    $this->dispatcher = $dispatcher;
	}

}