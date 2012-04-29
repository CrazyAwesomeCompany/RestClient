<?php

namespace CAC\Rest\Events;

use CAC\Rest\Request;

use Symfony\Component\EventDispatcher\Event;


class RestRequestEvent extends Event
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

}
