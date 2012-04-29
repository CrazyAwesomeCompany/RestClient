<?php

namespace CAC\Rest\Client;


use CAC\Rest\Request;

abstract class ClientAdapter
{

	abstract protected function doRequest(Request $request);




	public function request(Request $request)
	{

// 		if (is_object($content) || is_array($content)) {
// 			$content = $this->encode($content);
// 		}


		return $this->doRequest($request);
	}

	private function encode($data)
	{
		return json_encode($data);
	}

	protected function decode($data)
	{
		return json_decode($data);
	}


}