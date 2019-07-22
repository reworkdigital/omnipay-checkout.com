<?php

namespace Omnipay\CheckoutCom\Message;

use Omnipay\Common\Http\Client;
use Omnipay\Common\Message\RequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class CaptureRequest implements RequestInterface
{

	private $client;
	private $request;
	private $response;
	private $url = 'https://api.sandbox.checkout.com/payments/%s/captures';
	private $parameters;
	private $requestParams;

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

	public function initialize(array $parameters = array())
	{
		$this->parameters->set('secretKey', $parameters['secretKey']);
		$this->requestParams->add([
			'amount' => $parameters['amount']
		]);
		$this->url = sprintf($this->url, $parameters['id']);

		return $this;
	}

	public function getParameters()
	{
		// TODO: Implement getParameters() method.
	}

	public function getResponse()
	{
		return $this->response;
	}

	public function send()
	{
		$response = $this->client
			->request('POST', $this->url, [
				'Authorization' => $this->parameters->get('secretKey'),
				'Content-Type' => 'application/json'
			], json_encode([
				'amount' => $this->requestParams->get('amount') * 100
			]))
			->getBody()
			->getContents();

		return $this->response = new CaptureResponse($this, json_decode($response, 1));
	}

	public function sendData($data)
	{
		// TODO: Implement sendData() method.
	}


}
