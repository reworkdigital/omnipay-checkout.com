<?php

namespace Omnipay\CheckoutCom\Message;

use Omnipay\Common\Message\ResponseInterface;

class CheckoutComAuthorizeResponse implements ResponseInterface
{

	private $request;
	private $data;

	public function __construct(CheckoutComAuthorizeRequest $request, array $data)
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
		return $this->getData()["approved"];
	}

	public function isRedirect()
	{
		return !empty($this->getData()["_links"]["redirect"]);
	}

	public function isCancelled()
	{
		return !$this->isSuccessful();
	}

	public function getMessage()
	{
		return $this->getData()["response_summary"];
	}

	public function getCode()
	{
		return $this->getData()["auth_code"];
	}

	public function getTransactionReference()
	{
		return $this->getData()["id"];
	}

	public function getRedirectUrl()
	{
		return isset($this->getData()["_links"]["redirect"]) ? $this->getData()["_links"]["redirect"]["href"] : null;
	}
}
