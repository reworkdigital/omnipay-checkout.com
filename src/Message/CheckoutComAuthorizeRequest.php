<?php


namespace Omnipay\CheckoutCom\Message;


use Omnipay\Common\Http\Client;
use Omnipay\Common\Message\MessageInterface;
use Symfony\Component\HttpFoundation\Request;

class CheckoutComAuthorizeRequest implements MessageInterface
{
	private $client;
	private $request;
	private $response;


	public function __construct(Client $client, Request $request)
	{
		$this->client = $client;
		$this->request = $request;
	}

	public function initialize($parameters = [])
	{
		$params = [
			'source' => [
				'type' => 'token',
				'token' => $parameters['token'],
			],
			'amount' => $parameters['amount'] * 100,
			'currency' => $parameters['currency'],
			'success_url' => $parameters['returnUrl'],
			'failure_url' => $parameters['failureUrl'],
			'description' => $parameters['description']
		];

		if(isset($parameters["3ds"]) && $parameters["3ds"]){
			$params["3ds"] = ["enabled" => true];
		}

		$response = json_decode($this->client->request('POST', 'https://api.sandbox.checkout.com/payments', [
			'Authorization' => $parameters['secretKey'],
			'Content-Type' => 'application/json'
		], json_encode($params))->getBody()->getContents(), 1);


		return $this->response = new CheckoutComAuthorizeResponse($this, $response);

	}

	public function getData()
	{
		return $this->response;
	}
}
