<?php
/*
 * This file is part of the Crazy Awesome Company package.
*
* (c) Nick de Groot <nick@crazyawesomecompany.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace CAC\Rest\Events;

use CAC\Rest\Response;
use CAC\Rest\Request;
use Symfony\Component\EventDispatcher\Event;


class RestResponseEvent extends Event
{

    protected $response;
    protected $request;

    public function __construct(Response $response, Request $request)
    {
        $this->response = $response;
        $this->request = $request;
    }

    /**
     * Get the request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get the response
     *
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

}
