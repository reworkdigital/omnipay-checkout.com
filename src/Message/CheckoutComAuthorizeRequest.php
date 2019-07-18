<?php


namespace Omnipay\CheckoutCom\Message;


use Omnipay\Common\Http\Client;
use Omnipay\Common\Message\MessageInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class CheckoutComAuthorizeRequest implements MessageInterface
{
	private $client;
	private $request;
	private $response;
	private $requestParams;
	private $headers;
	private $parameters;


	public function __construct(Client $client, Request $request)
	{
		$this->client = $client;
		$this->request = $request;
		$this->parameters = new ParameterBag();
		$this->requestParams = new ParameterBag();
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

		$this->parameters->add($parameters);

		$this->requestParams->add($params);

		return $this;

	}

	public function getData()
	{
		return $this->response;
	}

	public function send()
	{
		$response = json_decode($this->client->request('POST', 'https://api.sandbox.checkout.com/payments', [
			'Authorization' => $this->parameters->get('secretKey'),
			'Content-Type' => 'application/json'
		], json_encode($this->requestParams->all()))->getBody()->getContents(), 1);

		return $this->response = new CheckoutComAuthorizeResponse($this, $response);
	}
}
