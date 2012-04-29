RestClient
==========

Rest Client using Symfony Components

This is a heavy development version!


## Configuration

### Basic configuration
    
    # The actual rest client. First argument is the adapter to use second
    # argument is the base url of the rest server
    cac.rest.client:
        class: CAC\Rest\Client
        arguments: [@cac.rest.client.adapter, %api.url%]

    # Rest Client adapter
    cac.rest.client.adapter:
        class: CAC\Rest\Client\CurlAdapter
        
### Add logging of requests and responses
If you want to see what your application is doing with the requests and responses
you can add logging to the rest client. We already provide a solution. You only
have to add the following services to your config file

Add the Symfony EventDispatcher to the Rest Client

    # Rest Client
    cac.rest.client:
        class: CAC\Rest\Client
        arguments: [@cac.rest.client.adapter, %api.url%]
        calls:
            - [setEventDispatcher, [@event_dispatcher]]
            
Now the Rest Client is triggering events before and after the request is done.
Create a Monolog Logger and add it to the RequestResponse Logger

    # Request and Response logger
    cac.rest.client.listener.logger:
        class: CAC\Rest\EventListener\RequestResponseLogger
        arguments: [@cac.rest.client.logger]
        tags:
            - { name: kernel.event_listener, event: "rest.response", method: "onRestResponse" }
        
    # Rest Client Logger
    # The logger service for the rest client
    cac.rest.client.logger:
        class: Monolog\Logger
        arguments: [cac.rest.client]
        calls:
            - [pushHandler, [@cac.rest.client.logger.handler]]

    cac.rest.client.logger.handler:
        class: Monolog\Handler\StreamHandler
        arguments: [%rest.client.log.file%, %rest.client.log.level%]