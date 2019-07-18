<?php

namespace Omnipay\CheckoutCom\Message;

use Omnipay\Common\Http\Client;
use Omnipay\Common\Message\RequestInterface;
use Symfony\Component\HttpFoundation\Request;

class CheckoutComCaptureRequest implements RequestInterface
{

	private $client;
	private $request;
	private $response;


	public function __construct(Client $client, Request $request)
	{
		$this->client = $client;
		$this->request = $request;
	}

	public function getData()
	{
		return $this->response;
	}

	public function initialize(array $parameters = array())
	{
		$url = 'https://api.sandbox.checkout.com/payments/'. $parameters['payment_id'] .'/captures';
		$response = $this->client
			->request('POST',$url, [
				'Authorization' => config('payment.checkout.secret_key'),
				'Content-Type' => 'application/json'
			],json_encode([
				'amount' => $parameters['amount'] * 100
			]))
			->getBody()
			->getContents();

		return $this->response = new CheckoutComCaptureResponse($this, json_decode($response));
	}

	public function getParameters()
	{
		// TODO: Implement getParameters() method.
	}

	public function getResponse()
	{
		// TODO: Implement getResponse() method.
	}

	public function send()
	{
		// TODO: Implement send() method.
	}

	public function sendData($data)
	{
		// TODO: Implement sendData() method.
	}


}
