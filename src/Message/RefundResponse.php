<?php

namespace Omnipay\CheckoutCom\Message;

use Omnipay\Common\Message\ResponseInterface;

class RefundResponse implements ResponseInterface
{

	private $data;
	private $request;

	public function __construct(RefundRequest $request, array $data)
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
		return $this->request;
	}

	public function isSuccessful()
	{
		return isset($this->getData()["action_id"]));
	}

	public function isCancelled()
	{
		return !$this->isSuccessful();
	}

}
