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

use CAC\Rest\Request;

use Symfony\Component\EventDispatcher\Event;

/**
 * Rest Request Event Class
 *
 * @author Nick de Groot <nick@crazyawesomecompany.com>
 */
class RestRequestEvent extends Event
{

    /**
     * The Request object
     *
     * @var Request
     */
    protected $request;

    /**
     * Create and set the Request
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Return the request object
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

}
