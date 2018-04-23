<?php

namespace Omnipay\Paytm\Message;

use Omnipay\Paytm\Common\Signer;

class CompletePurchaseRequest extends AbstractRequest
{
    public function setRequestParams($value)
    {
        return $this->setParameter('request_params', $value);
    }

    public function getRequestParams()
    {
        return $this->getParameter('request_params');
    }

    public function getData()
    {
        return $this->getRequestParams();
    }

    public function sendData($data)
    {
        $signer = new Signer($this->getKey());
        $data['verify_success'] = isset($data['CHECKSUMHASH']) ? $signer->verify($data, $data['CHECKSUMHASH']) : false;
        $data['is_paid'] = $data['verify_success'] && $data['STATUS'] == 'TXN_SUCCESS';
        $data['is_failure'] = $data['STATUS'] == 'TXN_FAILURE';
        $data['is_pending'] = $data['STATUS'] == 'PENDING';

        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
