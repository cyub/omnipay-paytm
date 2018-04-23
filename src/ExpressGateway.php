<?php

namespace Omnipay\Paytm;

use Omnipay\Common\AbstractGateway;

class ExpressGateway extends AbstractGateway
{
    public function setMid($value)
    {
        return $this->setParameter('MID', $value);;
    }

    public function getMid()
    {
        return $this->getParameter('MID');
    }

    public function setKey($value)
    {
        return $this->setParameter('KEY', $value);
    }

    public function getKey()
    {
        return $this->getParameter('KEY');
    }

    public function setIndustryTypeId($value)
    {
        return $this->setParameter('INDUSTRY_TYPE_ID', $value);
    }

    public function getIndustryTypeId()
    {
        return $this->getParameter('INDUSTRY_TYPE_ID');
    }

    public function setChannelId($value)
    {
        return $this->setParameter('CHANNEL_ID', $value);
    }

    public function getChannelId()
    {
        return $this->getParameter('CHANNEL_ID');
    }

    public function setWebSite($value)
    {
        return $this->setParameter('WEBSITE', $value);
    }

    public function getWebSite()
    {
        return $this->getParameter('WEBSITE');
    }

    public function purchase(array $parameters = [])
    {
        return $this->createRequest("\\Omnipay\\Paytm\\Message\\PurchaseRequest", $parameters);
    }

    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest("\\Omnipay\\Paytm\\Message\\CompletePurchaseRequest", $parameters);
    }

    public function queryOrder(array $parameters = [])
    {
        return $this->createRequest("\\Omnipay\\Paytm\\Message\\QueryOrderRequest", $parameters);
    }

    public function setEnvironment($value)
    {
        return $this->setParameter('environment', $value);
    }

    public function getEnvironment()
    {
        return $this->getParameter('environment');
    }

    public function getName()
    {
        return 'Paytm_Pay';
    }
}
