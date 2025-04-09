<?php

namespace Omnipay\CheckoutCom\Message;

use Omnipay\CheckoutCom\Exceptions\InvalidAmountException;
use Omnipay\Common\Http\Client;
use Omnipay\Common\Message\MessageInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class AuthorizeRequest extends AbstractRequest implements MessageInterface
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

	public function initialize($parameters = [])
	{
		$source = [];

		if (isset($parameters['card_id'])) {
			$source = [
				'type' => 'id',
				'id' => $parameters['card_id']
			];
		} else if (isset($parameters['token'])) {
			$source = [
				'type' => 'token',
				'token' => $parameters['token'],
			];
		} else {
			throw new NoPaymentSourceProvidedException('No payment source provided');
		}

		$params = [
			'source' => $source,
			'amount' => intval(strval($parameters['amount'] * 100)),
			'currency' => strtoupper($parameters['currency']),
			'processing_channel_id' => $parameters['processing_channel_id'],
			'success_url' => $parameters['returnUrl'] ?? null,
			'failure_url' => $parameters['cancelUrl'] ?? null,
			'description' => $parameters['description'] ?? '',
			'payment_type' => $parameters['payment_type'] ?? 'Regular',
		];

		if (isset($parameters['reference'])) {
			$params['reference'] = $parameters['reference'];
		}

		if (isset($parameters["3ds"]) && $parameters["3ds"]) {
			$params["3ds"] = ["enabled" => true];
		}

		if (isset($parameters["capture"])) {
			$params["capture"] = $parameters["capture"];
		}

		if (isset($parameters["customer"]) && $parameters["customer"]) {
			$params["customer"] = $parameters["customer"];
		}

		if (isset($parameters["meta"]) && $parameters["meta"]) {
			$params["metadata"] = $parameters["meta"];
		}

		if (isset($parameters["previous_payment_id"]) && $parameters["previous_payment_id"]) {
			$params["previous_payment_id"] = $parameters["previous_payment_id"];
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
		$headers = [
			'Authorization' => 'Bearer ' . $this->parameters->get('secretKey'),
			'Content-Type' => 'application/json'
		];

		if ($this->parameters->has('idempotency-key')) {
			$headers['Cko-Idempotency-Key'] = $this->parameters->get('idempotency-key');
		}

        $request = $this->client->request(
            'POST',
            $this->getUrl('payments'),
            $headers,
            json_encode($this->requestParams->all())
        );

		$response = json_decode($request->getBody()->getContents(), 1);

		return $this->response = new AuthorizeResponse($this, $response);
	}
}
