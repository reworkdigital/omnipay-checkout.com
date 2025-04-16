<?php

namespace Omnipay\CheckoutCom\Message;

use Illuminate\Http\Request;
use Omnipay\Common\Message\ResponseInterface;

class ApprovedWebhookResponse implements ResponseInterface
{

	private $request;
	private $data;

	public function __construct(Request $request, array $data)
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
		if (!isset($this->getData()["response_code"])) {
			return false;
		}

		return !$this->isRedirect() && $this->getData()["response_code"] === "10000" && $this->getData()["response_summary"] === "Approved";
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
		$message = '';
		if (isset($this->getData()["response_summary"])) {
			return $this->getData()["response_summary"];
		}

		if(!$this->isSuccessful()){
			if( isset($this->getData()['actions'])) {
				$actions = $this->getData()['actions'];
				if(isset($actions[0]['response_summary'])){
					$message = $actions[0]['response_summary'];
				}
			}
		}

		return $message;
	}

	public function getCode()
	{
		if( $this->isSuccessful()) {
			return $this->getData()["auth_code"];
		}

		if(!$this->isSuccessful()){
			if( isset($this->getData()['actions'])) {
				$actions = $this->getData()['actions'];
				if(isset($actions[0]['response_code'])){
					return $actions[0]['response_code'];
				}
			}
		}
	}

	public function getTransactionReference()
	{
        return $this->getData()["id"] ?? null;
	}

	public function getRedirectUrl()
	{
		return isset($this->getData()["_links"]["redirect"]) ? $this->getData()["_links"]["redirect"]["href"] : null;
	}

	public function getStatus()
	{
		return $this->isSuccessful() ? 'Authorized' : null;
	}

	public function getResponseCode()
	{
		return $this->getData()["response_code"] ?? null;
	}
}
