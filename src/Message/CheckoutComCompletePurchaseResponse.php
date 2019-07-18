<?php


namespace Omnipay\CheckoutCom\Message;


use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class CheckoutComCompletePurchaseResponse implements ResponseInterface
{
	private $request;
	private $data;
	private $parameters;

	public function __construct(CheckoutComCompletePurchaseRequest $request, array $data)
	{
		$this->request = $request;
		$this->response = new ParameterBag($data);
	}

	public function getRequest()
	{
		return $this->request;
	}

	public function isSuccessful()
	{
		return $this->response->has('approved') && $this->response->get('approved')=== true && $this->response->get('status') === "Captured";
	}

	public function isRedirect()
	{
		return false;
	}

	public function isCancelled()
	{
		// TODO: Implement isCancelled() method.
	}

	public function getMessage()
	{
		return $this->isSuccessful() ? 'Success' : 'Error';
	}

	public function getCode()
	{
		// TODO: Implement getCode() method.
	}

	public function getTransactionReference()
	{
		return $this->response->get('id');
	}

	public function getData()
	{
		return $this->response->all();
	}


}
