<?php

namespace Omnipay\CheckoutCom;

use Omnipay\CheckoutCom\Message\CheckoutComAuthorizeRequest;
use Omnipay\CheckoutCom\Message\CheckoutComCaptureRequest;
use Omnipay\CheckoutCom\Message\CheckoutComCompletePurchaseRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\GatewayInterface;

class CheckoutComGateway extends AbstractGateway implements GatewayInterface
{

	private $secretKey;

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
		return [
			'testMode' => true
		];
	}

	public function initialize(array $parameters = array())
	{
		return parent::initialize($parameters);
	}

	public function authorize(array $options = array())
	{
		$options = array_merge($this->getParameters(), $options);
		return $this->createRequest(CheckoutComAuthorizeRequest::class, $options);
	}

	public function capture(array $options = array())
	{
		$options = array_merge($this->getParameters(), $options);
		return $this->createRequest(CheckoutComCaptureRequest::class, $options);
	}

	public function completePurchase(array $options = array())
	{
		$options = array_merge($this->getParameters(), $options);
		return $this->createRequest(CheckoutComCompletePurchaseRequest::class, $options);
	}

	public function setSecretKey($secretKey)
	{
		$this->parameters->set('secretKey',$secretKey);
	}

	public function getSecretKey()
	{
		$this->parameters->get('secretKey');
	}

}
