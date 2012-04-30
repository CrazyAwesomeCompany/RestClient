<?php
/*
 * This file is part of the Crazy Awesome Company package.
*
* (c) Nick de Groot <nick@crazyawesomecompany.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace CAC\Rest\Client;

use CAC\Rest\Response;
use CAC\Rest\Request;

/**
 * Base Rest Client Adapter class
 *
 *
 * @author Nick de Groot <nick@crazyawesomecompany.com>
 */
abstract class ClientAdapter
{

    /**
     * Execute the Rest Request and return the Response
     *
     * @param Request $request The Request
     *
     * @return Response
     */
    abstract public function request(Request $request);

    /**
     * Encode the request body data
     *
     * @param array|object $data The data
     *
     * @return string
     *
     * @todo Move this to a Encoder
     */
    private function encode($data)
    {
        return json_encode($data);
    }

    /**
     * Decode the content
     *
     * @param string $data The encoded string
     *
     * @return object The decoded object
     *
     * @todo Move this to a Decoder
     */
    protected function decode($data)
    {
        return json_decode($data);
    }

}
