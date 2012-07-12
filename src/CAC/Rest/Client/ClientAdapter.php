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
    protected function encode($data, $contentType = 'json')
    {
        switch ($contentType) {
            case 'json':
            case 'application/json':
                $data = json_encode($data);
                break;

            case 'application/x-www-form-urlencoded':
            default:
                $data = http_build_query($data);
                break;
        }

        return $data;
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
    protected function decode($data, $contentType = 'json')
    {
        switch ($contentType) {
            case 'json':
            case 'application/json':
            case 'application/json;charset=utf-8':
                $data = json_decode($data, true);
                break;
        }

        return $data;
    }

}
