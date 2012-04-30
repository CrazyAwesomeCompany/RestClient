<?php
/*
 * This file is part of the Crazy Awesome Company package.
*
* (c) Nick de Groot <nick@crazyawesomecompany.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace CAC\Rest\EventListener;

use Monolog\Logger;

use CAC\Rest\Events\RestResponseEvent;

/**
 * Request and Response Logger Event Listener
 *
 * This class logs the requests and responses made by the Rest Client. By changing the log level
 * of the Logger it wil log more/less information about the request and response.
 *
 * @author Nick de Groot <nick@crazyawesomecompany.com>
 */
class RequestResponseLogger
{

    /**
     * The logger
     *
     * @var Logger
     */
    private $logger;

    /**
     * Create the listener with a Logger
     *
     * @param Logger $logger The Logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Handle the Response Event and write the request and response to a log
     *
     * @param RestResponseEvent $event The event
     */
    public function onRestResponse(RestResponseEvent $event)
    {
        $request = $event->getRequest();
        $response = $event->getResponse();

        $this->logger->info(sprintf("[%s] %s", $request->getMethod(), $request->getUrl()));
        $this->logger->info(sprintf("[%d] %s", $response->getResponseCode(), json_encode($response->getContent())));

        // @todo Add debug information with headers
    }

}
