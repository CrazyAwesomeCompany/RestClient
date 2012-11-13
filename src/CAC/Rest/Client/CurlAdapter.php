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

use CAC\Rest\Request;

use CAC\Rest\Response;

/**
 * cUrl Adapter
 *
 * @author Nick de Groot <nick@crazyawesomecompany.com>
 */
class CurlAdapter extends ClientAdapter
{

    /**
     * cUrl Handle
     *
     * @var resource
     */
    private $ch;

    /**
     * {@inheritDoc}
     *
     * @param string $method  The request method
     * @param string $url     The request url
     * @param string $content The request body
     *
     * @return Response
     *
     * @throws Exception When curl operation fails
     *
     * @see CAC\Rest\Client.ClientAdapter::request()
     */
    public function request(Request $request)
    {
        $ch = $this->getClient();

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request->getMethod());
        curl_setopt($ch, CURLOPT_URL, $request->getUrl());

        if ($request->getParameters()) {
            $params = $request->getParameters();

            if (is_object($params) || is_array($params)) {
                $params = $this->encode($params, $request->getHeader('content-type'));
            }

            if ($request->getMethod() == Request::GET) {
                curl_setopt($ch, CURLOPT_URL, $request->getUrl() . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                $request->setHeader('content-length', strlen($params));
            }
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $request->getHeaders());

        if(($result = curl_exec($ch)) === false) {
            // Some error occured when doing the curl request
            throw new Exception(
                sprintf("cURL error: %s", curl_error($ch)),
                curl_errno($ch)
            );
        }

        $info = curl_getinfo($ch);

        $response = new Response();
        $response->setResponseCode($info['http_code']);

        $headers = substr($result, 0, $info['header_size']);
        $body = substr($result, $info['header_size']);

        $headers = explode("\r\n", $headers);
        foreach ($headers as $header) {
            $headerData = explode(":", $header, 2);
            // make exception for status code and last \r\n's
            if (isset($headerData[1])) {
                $response->setHeader(strtolower(trim($headerData[0])), trim($headerData[1]));
            }
        }

        // @todo Decode the content back
        $response->setContent($this->decode($body), $response->getHeader('content-type'));

        return $response;
    }

    /**
     * Get the cUrl handle
     *
     * @return resource
     */
    protected function getClient()
    {
        if (!$this->ch) {
            $this->ch = curl_init();
        }

        return $this->ch;
    }

}
