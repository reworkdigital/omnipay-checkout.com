<?php

namespace Omnipay\CheckoutCom\Message;

use Omnipay\Common\Message\ResponseInterface;

class VoidResponse implements ResponseInterface
{

	private $data;
	private $request;

	public function __construct(VoidRequest $request, ?array $data = [])
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
		return isset($this->getData()["action_id"]);
	}

	public function isCancelled()
	{
		return !$this->isSuccessful();
	}

    public function isRedirect()
    {
        return !empty($this->getData()["_links"]["redirect"]);
    }

    public function getMessage()
    {
        return '';
    }

    public function getCode()
    {
        if( $this->isSuccessful()) {
            return $this->getData()["action_id"];
        }

        if(!$this->isSuccessful()){
            if( isset($this->getData()['request_id'])) {
                return $this->getData()['request_id'];
            }
        }
    }
    public function getTransactionReference()
    {
        return null;
    }

    public function getStatus()
    {
        return $this->isSuccessful() ? 'Voided' : 'Void Error';
    }

}
