<?php

namespace Omnipay\CheckoutCom\Message;

use Omnipay\Common\Http\Client;
use Omnipay\Common\Message\MessageInterface;
use Omnipay\Common\Message\RequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class CaptureRequest extends AbstractRequest implements MessageInterface
{

    private $client;
    private $request;
    private $response;
    private $requestParams;
    protected $parameters;


    public function __construct(Client $client, Request $request)
    {
        $this->client = $client;
        $this->request = $request;
        $this->parameters = new ParameterBag();
        $this->requestParams = new ParameterBag();
    }

    public function getData()
    {
        return $this->response;
    }

    public function initialize($parameters = [])
    {
        $this->requestParams->add([
            'id' => $parameters['id']
        ]);

        $this->parameters->add($parameters);

        return $this;
    }

    public function send()
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->parameters->get('secretKey'),
            'Content-Type' => 'application/json'
        ];

        $request = $this->client->request(
            'POST',
            $this->getUrl(sprintf('payments/%s/captures', $this->requestParams->get('id'))),
            $headers
        );

        return $this->response = new CaptureResponse($this, json_decode($request->getBody()->getContents(), 1));
    }


}
