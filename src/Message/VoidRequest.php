<?php

namespace Omnipay\CheckoutCom\Message;

use Omnipay\Common\Http\Client;
use Omnipay\Common\Message\RequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class VoidRequest extends AbstractRequest implements RequestInterface
{

	private $client;
	private $request;
	private $response;
	protected $parameters;
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
			'amount' => $parameters['amount'],
			'id' => $parameters['id']
		]);

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
			->request('POST', $this->getUrl(sprintf('/payments/%s/voids', $this->requestParams->get('id'))), [
				'Authorization' => 'Bearer ' . $this->parameters->get('secretKey'),
				'Content-Type' => 'application/json'
			], json_encode([
				'reference' => $this->requestParams->get('id')
			]))
			->getBody()
			->getContents();

		return $this->response = new VoidResponse($this, json_decode($response, 1));
	}

	public function sendData($data)
	{
		// TODO: Implement sendData() method.
	}


}
