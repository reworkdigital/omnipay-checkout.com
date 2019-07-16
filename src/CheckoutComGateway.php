<?php

namespace Omnipay\CheckoutCom;

use Omnipay\CheckoutCom\Message\CheckoutComAuthorizeRequest;
use Omnipay\CheckoutCom\Message\CheckoutComCaptureRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\GatewayInterface;

class CheckoutComGateway extends AbstractGateway implements GatewayInterface
{
	public function getName()
	{
		return 'Checkout Com';
	}

	public function getShortName()
	{
		return 'checkout.com';
	}

	public function getDefaultParameters()
	{
		return [];
	}

	public function initialize(array $parameters = array())
	{
		// TODO: Implement initialize() method.
	}

	public function getParameters()
	{
		return [];
	}

	public function authorize(array $options = array())
	{
		return $this->createRequest(CheckoutComAuthorizeRequest::class, $options);
	}

	public function capture(array $options = array())
	{
		return $this->createRequest(CheckoutComCaptureRequest::class, $options);
	}

}
