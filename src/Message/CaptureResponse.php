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
		return $this->request;
	}

	public function isSuccessful()
	{
		if (!isset($this->getData()["action_id"])) {
			return false;
		}
	}

	public function isCancelled()
	{
		return !$this->isSuccessful();
	}

}
