<?php

namespace Omnipay\Paytm\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\Paytm\Common\Signer;

abstract class AbstractRequest extends BaseAbstractRequest
{
    protected $stagingEndpoint = 'https://pguat.paytm.com';
    protected $productionEndpoint = 'https://secure.paytm.in';

    protected $methods = [
        'Purchase' => '/oltp-web/processTransaction',
        'OrderQuery' => '/oltp/HANDLER_INTERNAL/getTxnStatus',
    ];

    public function getEndPoint($type = null)
    {
        $endpoint = $this->getEnvironment() === 'production' ? $this->productionEndpoint : $this->stagingEndpoint;

        return  $type ? $endpoint . $this->methods[$type] : $endpoint;
    }

    public function setEnvironment($value)
    {
        return $this->setParameter('environment', $value);
    }

    public function getEnvironment()
    {
        return $this->getParameter('environment');
    }

    public function setMid($value)
    {
        return $this->setParameter('MID', $value);
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

    public function setOrderId($value)
    {
        return $this->setParameter('ORDER_ID', $value);
    }

    public function getOrderId()
    {
        return $this->getParameter('ORDER_ID');
    }

    public function setAmount($value)
    {
        return $this->setParameter('TXN_AMOUNT', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('TXN_AMOUNT');
    }

    public function setCustID($value)
    {
        return $this->setParameter('CUST_ID', $value);
    }

    public function getCustID()
    {
        return $this->getParameter('CUST_ID');
    }

    protected function generateSign($data)
    {
        $signer = new Signer($this->getKey());
        return $signer->make($data);
    }
}
