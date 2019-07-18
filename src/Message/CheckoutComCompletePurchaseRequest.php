<?php


namespace Omnipay\CheckoutCom\Message;


use Omnipay\Common\Http\Client;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class CheckoutComCompletePurchaseRequest implements RequestInterface
{

	private $response;

	public function __construct(Client $client, Request $request)
	{
		$this->client = $client;
		$this->request = $request;
		$this->parameters = new ParameterBag();
		$this->requestParams = new ParameterBag();
	}

	public function getData()
	{
		return array_merge($this->parameters->all(), $this->requestParams->all());
	}

	public function initialize(array $parameters = array())
	{
		$this->requestParams->add(['id' => $parameters['id']]);
		$this->parameters->add($parameters);
		return $this;
	}

	public function getParameters()
	{
		return $this->parameters->all();
	}

	public function getResponse()
	{
		return $this->response;
	}

	public function send()
	{
		$response = json_decode($this->client->request('GET', 'https://api.sandbox.checkout.com/payments/' . $this->requestParams->get('id'), [
			'Authorization' => $this->parameters->get('secretKey'),
			'Content-Type' => 'application/json'
		])->getBody()->getContents(), 1);


		return $this->response = new CheckoutComCompletePurchaseResponse($this, $response);
	}

	public function sendData($data)
	{

	}
}
