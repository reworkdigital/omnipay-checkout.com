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
        return isset($this->getData()["action_id"]);
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
        return null;
    }

    public function getCode()
    {
        if( $this->isSuccessful()) {
            return $this->getData()["action_id"];
        }

        if(!$this->isSuccessful()){
            if( isset($this->getData()['error_codes'])) {
                $actions = $this->getData()['error_codes'];
                if(isset($actions[0])){
                    return $actions[0];
                }
            }
        }
    }

    public function getTransactionReference()
    {
        return null;
    }

    public function getRedirectUrl()
    {
        return isset($this->getData()["_links"]["redirect"]) ? $this->getData()["_links"]["redirect"]["href"] : null;
    }

    public function getStatus()
    {
        return "Captured";
    }

    public function getResponseCode()
    {
        return $this->getData()["response_code"] ?? null;
    }
}
