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
 * Rest Events Class
 *
 * @author Nick de Groot <nick@crazyawesomecompany.com>
 */
class RestEvents
{

    /**
     * Rest Request Event
     *
     * The event is triggered just before it's executed. The request can be changed
     *
     * @var string
     */
    const REQUEST = 'rest.request';

    /**
     * Rest Response Event
     *
     * The event is triggered just after a response is recieved from the rest server
     *
     * @var string
     */
    const RESPONSE = 'rest.response';

}
