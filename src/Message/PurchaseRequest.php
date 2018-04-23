<?php

namespace Omnipay\Paytm\Message;

use Omnipay\Paytm\Common\Signer;

class PurchaseRequest extends AbstractRequest
{
    public function setCallbackUrl($value)
    {
        return $this->setParameter('CALLBACK_URL', $value);
    }

    public function getCallbackUrl()
    {
        return $this->getParameter('CALLBACK_URL');
    }

    public function getData()
    {
        $this->validate('MID', 'KEY', 'ORDER_ID', 'CUST_ID', 'CHANNEL_ID', 'WEBSITE', 'INDUSTRY_TYPE_ID');
        $data = [
            'MID' => $this->getMid(),
            'ORDER_ID' => $this->getOrderId(),
            'TXN_AMOUNT' => $this->getAmount(),
            'CHANNEL_ID' => $this->getChannelId(),
            'CUST_ID' => $this->getCustID(),
            'INDUSTRY_TYPE_ID' => $this->getIndustryTypeId(),
            'WEBSITE' => $this->getWebSite(),
            'CALLBACK_URL' => $this->getCallbackUrl()
        ];
        $data['CHECKSUMHASH'] = $this->generateSign($data);

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
