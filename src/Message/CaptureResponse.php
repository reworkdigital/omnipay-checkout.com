<?php

namespace Omnipay\CheckoutCom\Message;

use Omnipay\Common\Message\ResponseInterface;

class CaptureResponse implements ResponseInterface
{

	private $data;
	private $request;

	public function __construct(CaptureRequest $request, array $data)
	{
		$this->data = $data;
		$this->request = $request;
	}

	public function getData()
	{
		return $this->data;
	}

	public function getRequest()
	{
		// TODO: Implement getRequest() method.
	}

	public function isSuccessful()
	{
		// TODO: Implement isSuccessful() method.
	}

	public function isRedirect()
	{
		// TODO: Implement isRedirect() method.
	}

	public function isCancelled()
	{
		// TODO: Implement isCancelled() method.
	}

	public function getMessage()
	{
		// TODO: Implement getMessage() method.
	}

	public function getCode()
	{
		// TODO: Implement getCode() method.
	}

	public function getTransactionReference()
	{
		// TODO: Implement getTransactionReference() method.
	}


}
